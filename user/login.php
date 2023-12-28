<?php
@session_start();
?>

<head>
    <title>Login</title>
    <?php require_once('../includes/head_links.php'); ?></head>

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
                        <input name="password" type="password" class="form-control" id="loginPassword" placeholder="Enter password">
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
    $(document).ready(function() {
        $("form").submit(function(event) {
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
                success: function(res) {
                    console.log(res);
                    if (res['status']) {
                        window.location.href = 'home.php';
                    } else {
                        $('#status').html(`<p class="alert alert-danger">${res['message']}</p>`);
                        refreshErrors();
                    }
                },
            });

            function refreshErrors() {
                setTimeout(function() {
                    $("#status").html('');
                }, 3000);
            }
        });
    });
</script>

</html>