<?php

?>

<head>
    <title>Login</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <!-- Include jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center">
        <div class="mt-2 card" style="width: 20rem;">
            <div class="card-header  text-success ">
                <h4 id="card_header">Login Form</h4>
            </div>
            <div class="card-body">
                <form>
                    <div class="form-group  mt-1">
                        <label for="loginEmail">Email:</label>
                        <input name="email" type="email" class="form-control" id="loginEmail" placeholder="Enter email">
                        <span id="email_err" class="text-danger"></span>
                    </div>
                    <div class="form-group  mt-1">
                        <label for="loginPassword">Password:</label>
                        <input name="password" type="password" class="form-control" id="loginPassword"
                            placeholder="Enter password">
                        <span id="password_err" class="text-danger"></span>
                    </div>
                    <div id="status"></div>
                    <button type="submit" class="btn mt-1 btn-success">Login</button>
                    <a href="register.php" class="btn mt-1 btn-success">Register</a>
                </form>
            </div>
        </div>
    </div>
</body>
<script>
    $(document).ready(function () {
        $("form").submit(function (event) {
            event.preventDefault();
            var email_val = $('#loginEmail').val();
            var password_val = $('#loginPassword').val();
            if (!password_val || !email_val) {
                alert('please enter all fields');
                return;
            }
            $.ajax({
                url: 'ajax/login.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    email: email_val,
                    password: password_val,
                },
                success: function (res) {
                    if (res['status']) {
                        $('#status').html(`<p class="alert alert-danger">${res['message']}</p>`);
                        setTimeout(function () {
                            $('#status').html('');
                        }, 2000);
                    } else {
                        window.location.href = 'home.php';
                    }
                },
            });
        });
    });
</script>

</html>