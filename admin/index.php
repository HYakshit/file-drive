<?php
@session_start();
if (!isset($_SESSION["admin"])) {
  header("location:../");
}
require("../database/connection.php");
$obj = new connection();
?>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin Dashboard</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="robots" content="all,follow">
  <!-- head links -->
  <?php require_once('../includes/head_links.php'); ?>
</head>

<body>
  <div class="page">
    <!-- header -->
    <?php require_once('../includes/header.php'); ?>
    <div class="page-content d-flex align-items-stretch">
      <!-- sidebar -->
      <?php require_once('../includes/sidebar.php'); ?>
      <div class="content-inner w-100">
        <!-- Page Header-->
        <header class="bg-white shadow-sm px-4 py-3 z-index-20">
          <div class="container-fluid px-0">
            <h2 class="mb-0 p-1">Home</h2>
          </div>
        </header>
        <!-- Main Section-->
        <section>
          <div class="row text-center brand-text mb-4">
            <h1>Welcome
              <?php print_r( $_SESSION['admin']['name']) ?>
            </h1>
          </div>
          <div class="row justify-content-center">
            <div class="col-md-4">
            </div>
          </div>
        </section>
        <!-- Page Footer-->
        <?php require_once('../includes/footer.php'); ?>
      </div>
    </div>
  </div>
  <!-- footer links -->
  <?php require_once('../includes/footer_links.php'); ?>
</body>

</html>