<?php
require("../database/User.php");
$obj = new User();
$approved_users = $obj->getApprovedUsers();
$files_array = [];
// echo"<pre>";
$rr;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Share Files</title>
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
                        <h2 class="mb-0 p-1">Share Files</h2>
                    </div>
                </header>
                <!-- Main Section-->
                <section class="pt-2">
                    <div class="container ">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-10">
                                        <table class="table mt-3" border="1">
                                            <thead class="">
                                                <th>No.</th>
                                                <th>file Name</th>
                                                <th>category ID </th>
                                                <th>Action</th>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $num = 1;
                                                foreach ($files_array as $index => $row) {
                                                    echo
                                                    "<tr>
                                                    <td>" . $num . "</td>
                                                    <td>" . $row['name'] . "</td> 
                                                    <td>" . $row['category_id'] . "</td> 
                                     <td>  <button type='button' class='btn mt-2 btn-primary w-100' data-bs-toggle='modal' data-bs-target='#exampleModal'>
                                     share
                                 </button></td></tr>
                                    ";
                                                    $num++;
                                                } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-2">
                                    <!-- Button trigger modal -->
                                    <button type='button' class='btn mt-2 btn-primary w-100' data-bs-toggle='modal' data-bs-target='#exampleModal'>
                                        share
                                    </button>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        </section>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Select Users</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="users_form">
                        <!-- <label class='me-3 form-check-label' >Select Users</label> -->
                            <?php foreach ($approved_users as $index => $user) {
                                echo "<input class='p-2 form-check-input' type='checkbox' name='users[]' id='$user[id]' value='$user[id]'
                                                  class='custom'/>
                                              <label class='me-3 form-check-label' for='$user[id]'>$user[name]</label><br>";
                            }
                            ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="close_modal" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Share</button>
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
    
</script>
</html>