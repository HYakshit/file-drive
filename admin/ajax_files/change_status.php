<?php 
require("../../database/User.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $obj=new User();
    $status=$_POST['status'];
    $id=$_POST['id'];
    if($status == 'Approved'){
        $obj->changeStatus($id, 'Rejected');
        
    }else{
        // echo($status);
        $obj->changeStatus($id, 'Approved');
    }
   echo 1;
}
?>