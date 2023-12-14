<?php
// session_destroy();
require_once('../../database/User.php');
$obj = new User();
$res = ['status' => true, 'message' => 'Successfully Registered'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //get values
    $email = $_POST['email'];
    $password=$_POST['password'];
    $name = $_POST['name'];
    $cpassword=$_POST['cpassword'];
    // validations
    if($password !== $cpassword){
       echo json_encode(['status' => false, 'message' => 'Passwords not matching']);
       return;
    }
    $result=$obj->checkUser($email,$password);
    if($result !== null){
        echo json_encode(['status' => false, 'message' => 'Already exists']);
       return;
    }
    $result=$obj->store($name,$email,$password);
    if($result){
        echo json_encode($res);
    }
}  
?>