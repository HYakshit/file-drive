<?php 

require_once('../database/Connection.php');
if($_SERVER["REQUEST_METHOD"] == "POST"){
$name=$_POST['name'];
$email=$_POST['email'];
$password=$_POST['password'];
$gender=$_POST['gender'];
$img=$_FILES['img'];

$obj=new Connection();
$img_url="kk";
$obj->update($name, $email,$password,$gender,$img_url);
}
?>