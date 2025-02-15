<?php
class Connection
{
  protected $servername;
  private $tablename;
  protected $username;
  protected $password;
  protected $conn;
  protected $connection_warning;
  function __construct()
  {
    $this->tablename = "admin";
    $this->servername = "localhost";
    $this->username = "root";
    $this->password = "1111";
    try {
      $this->conn = new PDO("mysql:host=$this->servername;dbname=akshit", $this->username, $this->password);
      // set the PDO error mode to exception
      // $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      echo "Server connection failed with error --" . $e->getMessage();
      $this->connection_warning = "Server connection failed";
    }
  }
  public function update($name, $email, $gender,$img,$id)
  { // to store user who have permission
    $query = $this->conn->prepare("update admin set name = ?, email= ? , gender= ? , img_url = ? where id = ?");
    $query->execute([$name, $email, $gender,$img,$id]);
    if ($query) {
      echo "success";
    } else {
      echo "Error While Updating";
    }
  } 
  
  public function checkUser($email, $password)
  {
    $query = $this->conn->prepare("select * from  $this->tablename where email = ? and password = ?");
    $query->execute([$email, $password]);
    $result = $query->fetch(PDO::FETCH_ASSOC);
    // print_r($result);
    // exit();
    if($result != null) {
      return $result;
    }
    return null;
  }
  public function getdata($id)
  {
    $query = $this->conn->prepare("select * from admin where id = ?");
    $query->execute([$id]);
    $result = $query->fetch(PDO::FETCH_ASSOC);
    return $result;
  }
  public function updatePassword($id, $new_password){
    try{

      $query = $this->conn->prepare("update admin set password = ? where id = ?");
      $query->execute([$new_password,$id]);
    }catch(Exception $e){
      return false;
    }
   return true;
  }
  
  public function deleteImage($id){
    try{
      $query = $this->conn->prepare("update admin set img_url = 'default.jpg' where id = ?");
      $query->execute([$id]);
    }catch(Exception $e){
      return false;
    }
  }
}
?>