<?php 

class Plan {
  private $db;
  

  public function __construct(){
    $this->db = new Database;
  }

  public function getPlans(){

    $this->db->query('SELECT * FROM plans');
    $this->db->resultSet();
    
    while($row = $this->db->resultSet()){
      return $plans = $row;
    }
  }
}