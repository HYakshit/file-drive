<?php
session_start();
// print_r($_SESSION['admin']);
// exit();
require_once('../../database/Connection.php');
$status = ['status'=>true,'message'=>'Passsword Successfully Updated'];
$obj = new Connection();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // print_r($status);
    // exit();
    $update_current_password = $_POST['update_current_password'];
    $new_password = $_POST['new_password'];
    if ($update_current_password !== $_SESSION['admin']['password']) {
        $status['status']=false;
        $status['message']= "Wrong Current Password!";
        echo json_encode($status);
        return;
    }
    $id= $_SESSION['admin']['id'];
    $result=$obj->updatePassword($id,$new_password);
    if($result){
        echo json_encode($status);
        $_SESSION['admin']['password']=$new_password;
   }else{
    $status['status']=false;
    $status['message']= "Error in updating password";
    echo json_encode($status);
   }
}
?>
