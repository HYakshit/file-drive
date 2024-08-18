<?php
session_start();
require_once('../../database/Connection.php');
$obj = new Connection();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    if (!isset($_FILES['img'])) {//if there is no image
        $img = $_SESSION['img'];
        $obj->update($name, $email, $gender, $img, $id);
        return;
    }
    $img = $_FILES['img'];// get image
    $check = getimagesize($img["tmp_name"]);
    if ($check == false) {// chech if it is img
        echo "File is not an image.";
        return;
    }
// delete previous img localy
    $target_dir = "../../assets/img/";
    $img_name = basename($img["name"]);
    $target_file = $target_dir . $img_name;
    if ($_SESSION['img'] !== 'default.jpg') {
        $img_to_delete = $target_dir . $_SESSION['img'];
        unlink($img_to_delete);

    }
    // upload new img
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if (!move_uploaded_file($img["tmp_name"], $target_file)) {
        echo "Error while uploading the image";
        return;
    }
    // update database
    $obj->update($name, $email, $gender, $img_name, $id);
    $_SESSION['img'] = $img_name;
}
?>