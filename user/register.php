<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <?php require_once('../includes/head_links.php'); ?></head>

<body>
    <div class="container d-flex justify-content-center align-items-center">
        <div class="mt-2 card" style="width: 20rem;">
            <div class="card-header  text-success ">
                <h4>Register Form</h4>
            </div>
            <div class="card-body">
                <form>
                    <div class="form-group mt-1">
                        <label for="registerName">Name:</label>
                        <input type="text" class="form-control" maxlength="15" id="registerName" placeholder="Enter name">
                    </div>
                    <div class="form-group  mt-1">
                        <label for="registerEmail">Email:</label>
                        <input type="email" class="form-control" id="registerEmail" placeholder="Enter email">
                    </div>
                    <div class="form-group  mt-1">
                        <label for="registerPassword">Password:</label>
                        <input type="password" class="form-control" id="registerPassword" placeholder="Enter password">
                    </div>
                    <div class="form-group  mt-1">
                        <label for="cpassword">Confirm Password:</label>
                        <input type="password" class="form-control" id="cpassword" placeholder="Confirm password">
                    </div>
                    <div id="status"></div>
                    <button type="submit" class="btn mt-1 btn-success">Register</button>
                    <a href="login.php" class="btn mt-1 btn-success">login</a>
                </form>
            </div>
        </div>
    </div>
</body>
<script>
    $(document).ready(function() {
        $("form").submit(function(event) {
            event.preventDefault();
            let name = $('#registerName').val();
            let email = $('#registerEmail').val();
            let password = $('#registerPassword').val();
            let cpassword = $('#cpassword').val();
            console.log(name, email, password, cpassword);
            if (!name || !email || !password || !cpassword) {
                alert('Please fill all fields');
                return;
            } else if (password !== cpassword) {
                alert('Passwords and Confirm password is different!');
                return;
            } else {
                $.ajax({
                    url: 'ajax/register.php',
                    type: 'post',
                    dataType: "json",
                    data: {
                        name,
                        email,
                        password,
                        cpassword,
                    },
                    success: function(res) {
                        if (!res['status']) {
                            $('#status').html(`<p class=
                            
                            
                            "alert alert-danger">${res['message']}</p>`);
                            refreshErrors()
                        } else {
                            $('#status').html(`<p class="alert alert-success">${res['message']}</p>`);
                            refreshErrors()
                            // window.location.href = 'home.php';
                        }
                    }
                });

                function refreshErrors() {
                    setTimeout(function() {
                        $("#status").html('');
                    }, 3000);
                }
            }
        });
    });
</script>

</html>