<?php
session_start();
// print_r($_SESSION['admin']);
// exit();
require_once('../database/Connection.php');
$obj = new Connection();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $gender = $_POST['gender'];
    if ($current_password != $_SESSION['admin']['password']) {
        echo "Wrong Current Password!";
        return;
    }
    $_SESSION['admin']['password']=$new_password;
    if (!isset($_FILES['img'])) {
        $img = $_SESSION['img'];
        $obj->update($name, $email, $new_password, $gender, $img, $id);
        return;
    }
    $img = $_FILES['img'];
    $target_dir = "../assets/img/";
    $img_name = basename($img["name"]);
    $target_file = $target_dir . $img_name;
    if ($_SESSION['img'] != 'default.jpg') {
        $img_to_delete = $target_dir . $_SESSION['img'];
        unlink($img_to_delete);
        $_SESSION['img'] = $img_name;
    }
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $check = getimagesize($img["tmp_name"]);
    if ($check == false) {
        echo "File is not an image.";
        return;
    }
    if (!move_uploaded_file($img["tmp_name"], $target_file)) {
        echo "Error while uploading the image";
        return;
    }
    $obj->update($name, $email, $new_password, $gender, $img_name, $id);
}
?>