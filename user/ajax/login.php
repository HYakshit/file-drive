<?php
require_once("../../database/User.php");
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    print_r($_POST);
    exit();
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (!$email || $password) {
        echo "empty";
        return;
    }
    $obj = new User();
    $result = $obj->checkUser($email, $password);
   return $result;
}
?>