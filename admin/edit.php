<?php  
session_start();
require_once('../database/Connection.php');
$obj = new Connection();
$data = $obj->getdata($_SESSION['admin']['id']);
$_SESSION['img']=$data['img_url'];
// echo"<pre>";
// print_r($_SESSION['img']);
// exit();
$male = false;
if ($data['gender'] == 'male') {
    $male = true;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <?php require_once('../includes/head_links.php'); ?>
</head>

<body>
    <div class="row d-flex justify-content-center">
        <div class="content mt-2 bg-light col-5 col-md-3 p-3">
            <form id="formid"  method="post"  enctype="multipart/form-data">
                <!-- show img -->
                <div class="d-flex mb-2 justify-content-center">
                    <img id="img" class="img-fluid img-thumbnail rounded-circle" src="../assets/img/<?=$_SESSION['img']?>" alt="...">
                </div>
                <!-- get img -->
                    <div class="form-group  mb-2">
                        <input  class="form-control" type="file" name="file">
                    </div>
                    <!-- id -->
                    <input class="d-none" value="<?= $data['id'] ?>" id="id" >
                    <!-- name -->
                    <div>
                        <label for="name">Enter name</label>
                        <input class="form-control" value="<?= $data['name'] ?>" name="name" type="text" id="name">
                        <span class="text-danger  fw-bold" id="name_err"></span>
                    </div>
                    <!-- email -->
                    <div>
                        <label for="email">Enter Email</label>
                        <input class="form-control" value="<?= $data['email'] ?>" name="email" type="email" id="email">
                        <span class="text-danger  fw-bold" id="email_err"></span>
                    </div>
                    <!--current password -->
                    <div>
                        <label for="current_password">Current Password</label>
                        <input class="form-control" name="current_password" type="password"
                            id="current_password">
                        <span class="text-danger  fw-bold" id="cupassword_err"></span>
                    </div>
                    <!-- new Password -->
                    <div>
                        <label for="new_password">New Password</label>
                        <input class="form-control" name="new_password" type="password"
                            id="new_password">
                        <span class="text-danger  fw-bold" id="password_err"></span>
                    </div>
                    <!-- confirm password -->
                    <div>
                        <label for="confirm_password">Confirm Password</label>
                        <input class="form-control" name="confirm_password" type="password"
                            id="confirm_password">
                        <span class="text-danger  fw-bold" id="password_err"></span>
                    </div>
                    <!-- gender -->
                    <div class="form-group">
                        <label>Select Gender</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" <?php if ($male) { echo "checked"; } ?>
                                value="male" id="male">
                            <label class="form-check-label" for="male">
                                male
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" <?php if (!$male) {
                                echo "checked";
                            } ?>
                                name="gender" value="female" id="female">
                            <label class="form-check-label" for="female">
                                Female
                            </label>
                        </div>
                        <span class="text-danger  fw-bold" id="gender_err"></span>
                    </div>
                    <!-- status -->
                    <div id="status"></div>
                    <!-- submit -->
                    <input type="submit" id="submit" value="submit" class=" btn btn-primary btn-sm">
            </form>
        </div>
    </div>
</body>
<script>
    $(document).ready(function(){
        $('#formid').submit(function (event){
        event.preventDefault(); // Prevent the default form submission
        // Get values from form inputs
        var id = $('#id').val();
        var name = $('input[name="name"]').val();
        var email = $('input[name="email"]').val();
        var current_password = $('input[name="current_password"]').val();
        var new_password = $('input[name="new_password"]').val();
        var confirm_password = $('input[name="confirm_password"]').val();
        if(new_password != confirm_password){
            $("#status").html(`<p class="alert alert-danger">New password and confirm Password not matching</p>`);
            refreshErrors();
            return;
        }
        var gender = $('input[name="gender"]:checked').val();
        var fileInput = $('input[name="file"]')[0]; 
        var file = fileInput.files[0]; 
        // console.log(name, email, password, gender,id);

        // Create a FormData object and append form data
        var formData = new FormData();
        formData.append('id', id);
        formData.append('name', name);
        formData.append('email', email);
        formData.append('current_password', current_password);
        formData.append('new_password', new_password);
        formData.append('gender', gender);
        formData.append('img', file);

        $.ajax({
            url: 'operation.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                console.log(response);
                if (response == 'success') {
                    // $("#status").html(`<p class="alert alert-success">Successfully uploaded</p>`);
                    location.reload();
                } else {
                    $("#status").html(`<p class="alert alert-danger">${response}</p>`);
                    refreshErrors();
                }
            },
        });
        function refreshErrors() {
            setTimeout(function () {
                $("#status").html('');
            },3000);
        }
        // if (name.trim() === '' || email.trim() === '' || password.trim() === '',gender.trim() === '' || file === null) {
        //     $("#status").html('<p class="alert alert-danger">Please fill all fields</p>');
        //     refreshErrors();
        //     return;
        // }
    });
    });
   
</script>

</html>