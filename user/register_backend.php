<?php
session_start();
// session_destroy();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    //get values
    $sender = $_POST['sender'];
    $email = $_POST['email'];
    $password=$_POST['password'];
    $res = ['status' => 'false'];
    if ($sender == 'register') {
        $name = $_POST['name'];
        $cpassword=$_POST['cpassword'];
        $gender = $_POST['gender'];
        $res = ['status' => true, 'message' => 'Successfully Registered'];
    }
    // validations
    $field_Errors=[];
    // if ($password !== $cpassword) {
    //     array_push($field_Errors,['password_mismatch' => 'Password And Confirm Password Not Matching']);
    //     // echo json_encode($field_Errors);
    //     // exit;

    // }
    if (isset($_SESSION['user'])) {
        //if user already exist rediret to home page;
        foreach ($_SESSION['user'] as $index => $storedarray) {
            // array_search();
            if (in_array($email, $storedarray)) {
                if (in_array($password, $storedarray)) {
                    // if user exist
                    if ($sender == 'register') { //if data is of register file
                        $res = ['status' => false, 'message' => 'User Already Exist'];

                    } else { //if user exists during login
                        echo json_encode($storedarray);
                        $_SESSION['login_index'] = $index;
                        exit;
                    }
                }
            }
        }
    }
    if ($sender == 'register') {
        if ($res['status']) { //if user successfully registered
            $entry = array(
                'name' => $name,
                'email' => $email,
                'pssword' => $password,
                'gender' => $gender,
            );
            $_SESSION['user'][] = $entry;
            $_SESSION['login_index'] = count($_SESSION['user']) - 1;
            echo json_encode($res);
        } else {
            echo json_encode($res);
        }
    } else {

        echo json_encode($res);
    }
}
?>