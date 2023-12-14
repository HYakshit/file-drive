<?php
require("../database/User.php");
if (!isset($_SESSION["admin"])) {
    header("location:../");
}
$obj = new User();
$users = $obj->getUsers();
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['approve'])) {
        $id = $_GET['approve'];
        $status = 'Approved';
        $obj->changeStatus($id, $status);
    }
    if (isset($_GET['reject'])) {
        $id = $_GET['reject'];
        $status = 'Rejected';
        $obj->changeStatus($id, $status);
    }
    $users = $obj->getUsers();
}
// echo ('<pre>');
// print_r($users);
// exit();
?>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Permissions</title>
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
                <section class="pt-2">
                    <div class="container ">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <form method="post" enctype="multipart/form-data">

                                            <!-- categories -->
                                            <div class="form-group  mb-2">
                                                <label class="Hedvig Letters Sans sans-serif">Enter Max File
                                                    Size</label>
                                                <input required placeholder="In Bytes" class="form-control"
                                                    type="number" name="size">
                                            </div>
                                            <!-- file -->
                                            <div class="form-group  mb-2">
                                                <label class="Hedvig Letters Sans sans-serif">Select File to
                                                    Upload</label>
                                                <input required class="form-control" type="file" name="file">
                                            </div>
                                            <p id="status"></p>
                                            <!-- submit -->
                                            <button type="button" id="submit" name="submit"
                                                class="btn mb-2 btn-success">Upload</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Change Password</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="password">
                                
                                    <!-- confirm password -->
                                    <div>
                                        <label for="category">Confirm Password</label>
                                        <input class="form-control" name="category" type="text"
                                            id="category">
                                        <span class="text-danger  fw-bold" id="password_err"></span>
                                    </div>
                                    <div id="category_status"></div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" id="close_modal" class="btn  btn-secondary"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Page Footer-->
                <?php require_once('../includes/footer.php'); ?>
            </div>
        </div>
    </div>
    <!-- footer links -->
    <?php require_once('../includes/footer_links.php'); ?>
</body>
<script>
    // $(document).ready(function (){
    //     $('#approve').click(function(){
    //         $id=$(this).val();
    //      $.ajax

    //     })

    // });

    function refreshErrors() {
        setTimeout(function () {
            $("#status").html('');
            $("#password_status").html('')
        }, 3000);
    }

</script>

</html>