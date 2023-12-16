<?php
require_once('../../database/User.php');

$obj = new User();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];
    switch ($action) {
        case 'add':

            $status = ['status' => true, 'message' => 'Category Added'];
            $category = $_POST['category'];
            $result = $obj->addCategory($category);
            if (!$result) {
                echo json_encode(['status' => false, 'message' => 'Error Occured']);
                return;
            }
            echo json_encode($status);
            break;
        case 'edit':
            $index = $_POST['index'];
            $category = $_POST['category'];
            $result = $obj->editCategory($index, $category);
            if (!$result) {
                echo json_encode(['status' => false, 'message' => 'Error While Editing']);
                return;
            }
            echo json_encode(['status' => true, 'message' => 'Edited']);
            break;
        case 'delete':
            $index = $_POST['index'];
            $result = $obj->deleteCategory($index);
            if (!$result) {
                echo json_encode(['status' => false, 'message' => 'Error While Deleting']);
                return;
            }
            echo json_encode(['status' => true, 'message' => 'Deleted']);
            break;
    }
}
