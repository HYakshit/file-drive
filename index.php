<?php
session_start();
require("database/Connection.php");
$obj = new Connection();
$warrning = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['submit'])) {
    $email = $_POST['loginUsername'];
    $password = $_POST['loginPassword'];
    $result = $obj->checkUser($email, $password);
    
    if ($result != null) {
      $_SESSION['admin'] = $result;
      // print_r( $_SESSION['admin']);
      // exit();
      header('location:admin/index.php');
    } else {
      $warrning = 'Admin does not exists';
    }
  }
}
?>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>login</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="robots" content="all,follow">
  <!-- Google fonts - Poppins -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">
  <!-- Choices CSS-->
  <link rel="stylesheet" href="assets/vendor/styles/choices.min.css">
  <!-- theme stylesheet-->
  <link rel="stylesheet" href="assets/css/style.default.css" id="theme-stylesheet">
  <!-- Custom stylesheet - for your changes-->
  <link rel="stylesheet" href="assets/css/custom.css">
  <!-- Favicon-->
  <link rel="shortcut icon" href="assets/img/favicon.ico">
  <!-- jquery -->
  <script src="assets/js/jquery-3.7.1.min.js"></script>
</head>

<body>
  <div class="login-page">
    <div class="container d-flex align-items-center position-relative py-5">
      <div class="card shadow-sm w-100 rounded overflow-hidden bg-none">
        <div class="card-body p-0">
          <div class="row gx-0 align-items-stretch">
            <!-- Logo & Information Panel-->
            <div class="col-lg-6">
              <div class="info d-flex justify-content-center flex-column p-4 h-100">
                <div class="py-5">
                  <h1 class="display-6 fw-bold">Admin login</h1>
                  <p class="fw-light mb-0">please login to add categories and change permissions</p>
                </div>
              </div>
            </div>
            <!-- Form Panel    -->
            <div class="col-lg-6 bg-white">
              <div class="d-flex align-items-center px-4 px-lg-5 h-100">
                <form class=" py-5 w-100" method="post" action="index.php">
                  <div class="input-material-group mb-3">
                    <input class="input-material" id="login-name" type="text" name="loginUsername" autocomplete="off"
                      required>
                    <label class="label-material" for="login-name">User</label>
                  </div>
                  <div class="input-material-group mb-4">
                    <input class="input-material" id="login-password" type="password" name="loginPassword" required
                      data-validate-field="loginPassword">
                    <label class="label-material" for="login-password">Password</label>
                  </div>
                  <div class="text-danger">
                    <?php echo $warrning; ?>
                  </div>
                  <button class="btn btn-primary mb-3" id="login" type="submit" name="submit">Login</button>
                  <!-- <br><a class="text-sm text-paleBlue" href="#">Forgot Password?</a><br><small class="text-gray-500">Do not have an account? </small><a class="text-sm text-paleBlue" href="register.html">Signup</a> -->
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- JavaScript files-->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- <script src="../assets/vendor/chart.js/Chart.min.js"></script> -->
  <script src="assets/vendor/just-validate/js/just-validate.min.js"></script>
  <script src="assets/vendor/scripts/choices.min.js"></script>
  <!-- <script src="../assets/js/charts-home.js"></script> -->
  <!-- Main File-->
  <script src="assets/js/front.js"></script>
  <!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css"
    integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</body>

</html>