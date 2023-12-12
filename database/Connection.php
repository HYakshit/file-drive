<?php
class Connection
{
  protected $servername;
  protected $username;
  protected $password;
  protected $conn;
  protected $connection_warning;
  function __construct()
  {
    $this->servername = "localhost";
    $this->username = "root";
    $this->password = "";
    try {
      $this->conn = new PDO("mysql:host=$this->servername;dbname=files_project", $this->username, $this->password);
      // set the PDO error mode to exception
      // $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      echo "Connection failed" . $e->getMessage();
      $this->connection_warning = "Connection failed";
    }
  }
  public function update($name, $email, $password, $gender, $img_name,$id)
  { // to store user who have permission
    $query = $this->conn->prepare("update admin set name = ?, email= ? , password= ?, gender= ? , img_url = ? where id = ?");
    $query->execute([$name, $email, $password, $gender, $img_name,$id]);
    if ($query) {
      echo "success";
    } else {
      echo "Error While Updating";
    }
  }
  
  public function checkUser($email, $password)
  {
    $query = $this->conn->prepare("select * from admin where email = ? and password = ?");
    $query->execute([$email, $password]);
    $result = $query->fetch(PDO::FETCH_ASSOC);
    if ($result != 0) {
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
}
?>