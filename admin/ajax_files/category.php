<?php
require_once('../../database/User.php');
$status = ['status' => true, 'message' => 'Category Added'];
$obj = new User();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category = $_POST['category'];
    $result = $obj->addCategory($category);
    if (!$result) {
        echo json_encode(['status' => false, 'message' => 'Error Occured']);
        return;
    }
    echo json_encode($status);
}
?>