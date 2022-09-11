<?php

class Pages extends Controller{
  public function __construct(){
    $this->planModel = $this->model('Plan');
    $this->userModel = $this->model('User');
  }
  public function index(){

    $data = [
      'title' => 'Internet Service Provider',
    ];
    $this->view('pages/index', $data);
  }
  public function about(){
    $data = ['title' => 'About Us'];
   $this->view('pages/about', $data);
  }

  public function plans(){
   
   $this->plans = $this->planModel->getPlans();
   $data =[
    'selected_plan' => "",
    'error'=> '',
  ];

    if($_SERVER["REQUEST_METHOD"] == "POST"){
      
      $data =[
        'selected_plan' => $_POST['plan_name'],
        'error'=> '',
      ];

      if($data["selected_plan"] == 'Basic Tier Plan' || $data["selected_plan"] == 'Medium Tier Plan' || $data["selected_plan"] == 'Premium Tier Plan'){
        $this->userModel->planSelected($data['selected_plan'],$_SESSION['user_email']);
        flash('plan_success', 'You have successfully selected a plan!');
        unset($_SESSION['user_sub']);
        $_SESSION['user_sub'] = $data['selected_plan'];
        redirect('users/profile');
      }else{
        die('something went wrong');
      }

      
    }else{
      $this->view('pages/plans', $data);
    }
    
    
  }

  public function faqs(){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $data = [
        "email"=> trim($_POST['email']),
        "message"=>$_POST['message'],
        "email_error"=>"",
        "message_error"=>""
      ];

      if(empty($data['email'])){
        $data['email_error'] = 'Please enter your email!';
      }

      if(empty($data['message'])){
        $data['message_error'] = 'Please enter your question!';
      }

      if(empty($data['email_error']) && empty($data['message_error'])){
        $this->userModel->sendMessage($data['email'], $data['message']);
        flash('message_success', 'Thank you for your question! We will reply to the given email address.');
      }

      $this->view('pages/faqs',$data);
    }else{
      $data = [
        "email"=>"",
        "message"=>"",
        "email_error"=>"",
        "message_error"=>"",
      ];
      $this->view('pages/faqs',$data);
    }
    
  }
}