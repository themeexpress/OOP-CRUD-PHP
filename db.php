<?php
//Database connection initialize

define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "oopcrud");

Class Database{
  public $host   = DB_HOST;
  public $user   = DB_USER;
  public $pass   = DB_PASS;
  public $dbname = DB_NAME;
  
  
  public $link;
  public $error;
  
  public function __construct(){
    $this->connectDB();
  }
  
  private function connectDB(){
  $this->link = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
  if(!$this->link){
    $this->error ="Connection fail".$this->link->connect_error;
    return false;
  }
 }
 //insert data
  public function insert_record($query){
    $result = $this->link->query($query) or die($this->link->error.__LINE__);
    if (!$result) {
      die($this->link->error);
    }
  }
  //Select data
  public function select_record($query){
    $result = $this->link->query($query) or die($this->link->error.__LINE__);
    if ($result->num_rows>0) {
      return $result;
    }else{
    return false;
    }
  }
  //Update data
  public function update_record($query){
    $result = $this->link->query($query) or die($this->link->error.__LINE__);
    if ($result=== FALSE) {
      die($this->link->error);
    }else{
      return $result;
    }
  }
  public function delete_record($query){
    $result = $this->link->query($query) or die($this->link->error.__LINE__);
     if ($result=== FALSE) {
      die($this->link->error);
    }else{
      return $result;
    }
  }
}
//data fron Index file
?>