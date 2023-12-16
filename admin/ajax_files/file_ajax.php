<?php
require_once('../../database/User.php');
$obj = new User();
$status = ['status' => true, 'message' => 'File Uploaded'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category_array = $_POST['category'];

    if (empty($_FILES['file']['name'])) {
        echo json_encode(['status' => false, 'message' => 'Please select a file to upload.']);
        return;
    } else {
        $target_dir = "../files/";
        $extension = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));

        $newDir = $target_dir . $extension;

        if (!file_exists($newDir)) {
            mkdir($newDir);
        }
        $file = $newDir . '/' . $_FILES['file']['name'];
        if (file_exists($file)) {
            echo json_encode(['status' => false, 'message' => 'File Already exist']);
            return;
        } else {
            $check = move_uploaded_file($_FILES['file']["tmp_name"], $file);
            if ($check) {
                $id = $obj->storeFile($_FILES['file']['name']);
                if ($id) {
                    foreach ($category_array as $val) {
                        $obj->storeCategory($id, $val);
                    }
                    echo json_encode($status);
                    return;
                }
            } else {
                echo json_encode(['status' => false, 'message' => 'Error Occured']);
                return;
            }
        }
    }
}
?>