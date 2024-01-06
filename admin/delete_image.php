<?php 
session_start();
require("../database/Connection.php");
$obj = new Connection();
if ($_SESSION['img'] !== 'default.jpg') {
    $target_dir = "../assets/img/";
    $img_to_delete = $target_dir . $_SESSION['img'];
    unlink($img_to_delete);
    $obj->deleteImage($_SESSION['admin']['id']);
}
header("Location:edit_user.php");
?>