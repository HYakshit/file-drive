<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("location:index.php");
}
$logedUser=$_SESSION['user'];
$id = $logedUser['id'];//session is geting data from ajax file
require("../database/User.php");
$obj = new User();
$users = $obj->getUsers();
$approvedIdArray = array_column($users, 'id');
$files_array = $obj->getSharedFiles($id);
// echo"<pre>";
// print_r($files_array);
// exit();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>files</title>
    <?php require_once('../includes/head_links.php'); ?>
</head>

<body>
    <div class="page">
        <!-- header -->
        <?php require_once('includes/header.php'); ?>
        <div class="page-content d-flex align-items-stretch">
            <!-- sidebar -->
            <?php require_once('includes/sidebar.php'); ?>
            <div class="content-inner w-100">
                 <!-- Page Header-->
                 <header class="bg-white shadow-sm px-4 py-3 z-index-20">
                    <div class="container-fluid px-0">
                        <h2 class="mb-0 p-1">Files Shared</h2>
                    </div>
                </header>
                <!-- Main Section-->
                <section class="pt-2">
                    <div class="container ">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-10">
                                        <?php
                                        if (!(in_array($id, $approvedIdArray))) {//user not approved
                                            echo "You are not approved";
                                            return;
                                        } 
                                        if (empty($files_array)) {//files not shared
                                            echo "No files shared";
                                            return;
                                        }?>
                                        <table class="table mt-3" border="1">
                                            <thead class="text-white bg-primary">
                                                <th>No.</th>
                                                <th>File Name</th>
                                                <th>Date Shared</th>
                                                <th>view</th>
                                                <th>Download</th>
                                            </thead>
                                            <tbody>
                                                <?php

                                                $num = 1;
                                                foreach ($files_array as $index => $row) {
                                                    if(!isset($row['date'])){
                                                        $date="No data";
                                                    }
                                                    echo
                                                    "<tr><td>" . $num . "</td>
                                        <td>" . $row['name'] . "</td> 
                                        <td>" . $row['date'] . "</td>
                                        <td><a href='access_file.php?nama=$row[name]&action=show' value='$row[id]' class='btn btn-sm btn-warning edit-btn'>
                                         View
                                     </a>
                                      </td>
                                     <td><a href='access_file.php?nama=$row[name]&action=download' value='$row[id]' class='btn btn-sm btn-success'>Download</a></td></tr>";
                                                    $num++;
                                                } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</body>
<script>

</script>