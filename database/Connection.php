<?php
  $target_dir = "uploads/";
  /*
  if (empty($_FILES["fileToUpload"]["name"])) {
      echo "<script>alert('Please select a file to upload.')</script>";
  } else {
      $temp_target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
      $newDir = $target_dir . strtolower(pathinfo($temp_target_file, PATHINFO_EXTENSION));
     $extension_name=strtolower(pathinfo($temp_target_file, PATHINFO_EXTENSION));
  //    echo $extension_name;
      if($extension_name=='jpg' ||$extension_name=='img' || $extension_name=='heic' ||  $extension_name=='png'){

          $_SESSION['showable'] = true;
          // echo  $_SESSION['showable'];
      }
      if (!file_exists($newDir)) {
          mkdir($newDir);
      }
      $_SESSION['image_path'] = $newDir . '/' . basename($_FILES["fileToUpload"]["name"]);
      // $_SESSION['image_path'] = $target_file;
      // check if file already exists
      if (file_exists($_SESSION['image_path'])) {
          echo "<script>alert('File Already exist')</script>";
          // unset($_SESSION['image_path']);
      } else {
          $check = move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $_SESSION['image_path']);
          if ($check) {
              echo "<script>alert('File Uploaded')</script>";
          } else {
              echo "<script>alert('Some error occoured')</script>";
          }
      }
  } */
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
  public function update($name, $email,$password,$gender,$img_url,$id)
  { // to store user who have permission

    $query = $this->conn->prepare("update admin set name = ?, email= ? , password= ?, gender= ? , img_url = ? where id = ?");
    $query->execute([$name, $email,$password,$gender,$img_url,$id]);

    if ($query) {
      echo "inserted";
    } else {
      echo "not inserted";
    }
  }
  public function checkUser($email, $password)
  {
    $query = $this->conn->prepare("select * from admin where email = ? and password = ?");
    $query->execute([$email, $password]);
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    if (count($result) > 0) {
      return true;
    }
    return false;
  }
  public function getdata(){
    $query = $this->conn->prepare("select * from admin");
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);
    return $result;
  }
}
?>