<?php
require_once("../../database/User.php");
$res = ['status' => true, 'message' => ''];
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    // print_r($_POST);
    // exit();
    $email = $_POST['email'];
    $password = $_POST['password'];
    $obj = new User();
    $result = $obj->checkUser($email, $password);
    if($result === null){
        echo json_encode(['status' => false, 'message' => 'User not found']);
        return;
    }else{
        echo json_encode($res);
        return;
    }
 
}
?>