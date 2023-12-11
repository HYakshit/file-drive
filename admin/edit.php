<?php
require_once('../database/Connection.php');
$obj = new Connection();
$data = $obj->getdata();
// echo"<pre>";
// print_r($data);
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
        <div class="content col-5 col-md-6 p-3">
            <form id="formid" method="post"  enctype="multipart/form-data">
                <span class="text-danger  fw-bold" id="repeat_err"></span>
                <span class="text-danger  fw-bold" id="status"></span>
                <!-- img -->
                <div class="d-flex justify-content-center">
                    <img id="img" class="img-fluid img-thumbnail rounded-circle" src="../assets/img/avatar-1.jpg" alt="...">
                </div>
                <div class="form-group  mb-2">
                    <input  required class="form-control" type="file" name="file">
                </div>
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
                <!--password -->
                <div>
                    <label for="password">Password</label>
                    <input class="form-control" value="<?= $data['password'] ?>" name="password" type="password"
                        id="password">
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
                <!-- submit -->
                <input type="submit" id="submit" value="submit" class=" btn mt-1 btn-primary btn-sm">
            </form>
        </div>
    </div>
</body>
<script>
    $(document).ready(function(){
        $('#formid').submit(function (event){
        event.preventDefault(); // Prevent the default form submission
        // Get values from form inputs
        var name = $('input[name="name"]').val();
        var email = $('input[name="email"]').val();
        var password = $('input[name="password"]').val();
        var gender = $('input[name="gender"]:checked').val();
        var fileInput = $('input[name="file"]')[0]; 
        var file = fileInput.files[0]; 
        console.log(name, email, password, gender);

        // Create a FormData object and append form data
        var formData = new FormData();
        formData.append('name', name);
        formData.append('email', email);
        formData.append('password', password);
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
                    $("#status").html(`<p class="alert alert-success">Successfully uploaded</p>`);
                    refreshErrors();
                } else {

                    $("#status").html(`<p class="alert alert-danger">${response}</p>`);
                    refreshErrors();
                }
            },
        });

        // if (name.trim() === '' || email.trim() === '' || password.trim() === '',gender.trim() === '' || file === null) {
        //     $("#status").html('<p class="alert alert-danger">Please fill all fields</p>');
        //     refreshErrors();
        //     return;
        // }
        return false;



        function refreshErrors() {
            setTimeout(function () {
                $("#status").html('');
            }, 3000);
        }
    });
    });
   
</script>

</html>