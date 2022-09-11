<?php

class Users extends Controller{

  public function __construct(){
    $this->userModel= $this->model('User');
  }

public function register(){
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    $data = [
      'name' => trim($_POST['name']),
      'email' => trim($_POST['email']),
      'password'=> trim($_POST['password']),
      'confirm_password' => trim($_POST['confirm_password']),
      'name_error'=>'',
      'email_error'=>'',
      'password_error'=>'',
      'confirm_password_error' =>'',
    ];



    if(empty($data['name'])){
      $data['name_error'] ='Please enter your name!';
    }

    if(empty($data['email'])){
      $data['email_error'] ='Please enter your email!';
    }else{
      if($this->userModel->findUserByEmail($data['email'])){  
        $data['email_error'] = "This email is already registered!";
      }
    }
    
    if(empty($data['password'])){
      $data['password_error'] ='Please enter a password that  contains uppercase letter, lowercase letter, number and is 8 characters long.';
    }else{
      $uppercase = preg_match('@[A-Z]@', $data['password']);
      $lowercase = preg_match('@[a-z]@', $data['password']);
      $number = preg_match('@[0-9]@', $data['password']);

      if(!$uppercase || !$lowercase || !$number || $data['password'] < 8){
        $data['password_error'] = "Please enter a password that  contains uppercase letter, lowercase letter, number and it's 8 characters long.";
      }
    }
    $this->view('users/register', $data);
    
    if($data['password'] !== $data['confirm_password']){
      $data['confirm_password_error'] = "Passwords doesn't match!";
    }

    if(empty($data['name_error']) && empty($data['email_error']) && empty($data['password_error']) && empty($data['confirm_password_error'])){

      $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

      if($this->userModel->register($data)){
        flash('register_success', 'Registered! You can now login.');
        redirect('users/login');
      }else{
        die('Something went wrong');
      }
      
      $this->view('users/register', $data);

    }


    

  }else {
    $data = [
      'name' =>'',
      'email' =>'',
      'password' =>'',
      'confirm_password'=>'',
      'phone' =>'',
      'name_error' =>'',
      'email_error' =>'',
      'password_error' =>'',
      'confirm_password_error'=>'',
      'birth_date_error' =>'',
    ];

    $this->view('users/register', $data);
  }
}


public function login(){
  if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    $data = [
      'email' => trim($_POST['email']),
      'password' => trim($_POST['password']),
      'email_error' => '',
      'password_error' =>''
    ];

    if(empty($data['email'])){
      $data['email_error'] ='Please enter your email!';
    }else{
      if(!$this->userModel->findUserByEmail($data['email'])){  
        $data['email_error'] = "This email is not registered!";
      }
    }
    
    if(empty($data['password'])){
      $data['password_error'] ='Please enter your password!';
    }

    if(empty($data['password_error']) && empty($data['email_error'])){
     $loggedInUser =  $this->userModel->login($data['email'], $data['password']);
     if($loggedInUser){

      $this->createUserSession($loggedInUser);
      redirect('users/profile');
     }else{
        $data['password_error'] = 'Wrong password!';
        $this->view('users/login', $data);
     }
     
    }

    $this->view('users/login', $data);
  }else{
    $data = [
      'email'=> '',
      'password'=>'',
      'email_error'=>'',
      'password_error' =>''
    ];
    $this->view('users/login', $data);
    }

  }


  public function profile(){
    if(isLoggedIn()){
      $this->view('users/profile');
    }else{
      redirect('pages/index');
    }
  }

  public function createUserSession($user){
    $_SESSION['user_id'] = $user->id;
    $_SESSION['user_email'] = $user->email;
    $_SESSION['user_name'] = $user->name;
    $_SESSION['user_sub'] = $user->subscription;
  }


  public function logout(){
    unset($_SESSION['user_id']);
    unset($_SESSION['user_email']);
    unset($_SESSION['user_name']);
    unset($_SESSION['user_sub']);
    session_destroy();
    redirect('users/login');
  }

  public function deleteSub(){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      unset($_SESSION['user_sub']);
      $this->userModel->deletePlan($_SESSION['user_email']);
      $_SESSION['user_sub'] = "";
      $this->view('users/profile');
    }
  }
}