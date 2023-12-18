<?php 
require_once('../../database/User.php');
$obj = new User();
$status = ['status' => true, 'message' => 'File Shared'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $users_array = $_POST['users'];
    $file_id = $_POST['file_id'];
    foreach($users_array as $user_id){
        $result=$obj->alreadyShared($file_id,$user_id);
        if($result != null){
            echo json_encode(['status' => false, 'message' => 'Already Shared']);
            return;
        }
        $result=$obj->storeFiles($file_id,$user_id);
        if($result == false){
            $status['status']=false;
            $status['message']='Error Occured';
            break;
        }
    }
     echo json_encode($status);

}
?>