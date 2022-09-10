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
}