<?php

class User {
  private $db;

  public function __construct(){
    $this->db = new Database;
  }

public function register($data){
$this->db->query("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
$this->db->bind(':name', $data['name']);
$this->db->bind(':email', $data['email']);
$this->db->bind(':password', $data['password']);

  if($this->db->execute()){
    return true;
  }else{
    return false;
  }

}

public function login($email, $password){
  $this->db->query('SELECT * FROM users WHERE email = :email');
  $this->db->bind(':email', $email);

  $row = $this->db->single();

  $hashed_password = $row->password;

  if(password_verify($password,$hashed_password)){
    return $row;
  }else{
    return false;
  }
}


  public function findUserByEmail($email){
    $this->db->query("SELECT * FROM users WHERE email = :email");
    $this->db->bind(':email', $email);

    $row = $this->db->single();

    if($this->db->rowCount() > 0){
      return true;
    }else{
      return false;
    }
  }


  public function planSelected($selectedPlan, $email){
    $this->db->query('UPDATE users SET subscription = :subscription WHERE email = :email');
    $this->db->bind(':subscription', $selectedPlan);
    $this->db->bind(':email',$email);

    $this->db->execute();
  }

  public function deletePlan($email){
    $this->db->query('UPDATE users SET subscription = " " WHERE email = :email');
    $this->db->bind(':email', $email);
    $this->db->execute();
  }

public function sendMessage($email,$message){
$this->db->query('INSERT INTO messages (email,message) VALUES (:email, :message)');
$this->db->bind(':email', $email);
$this->db->bind(':message', $message);

  if($this->db->execute()){
    return true;
  }else{
    return false;
  }
}

}