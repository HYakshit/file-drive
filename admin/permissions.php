<?php
require("../database/User.php");
if (!isset($_SESSION["admin"])) {
    header("location:../");
}
$obj = new User();
$users = $obj->getUsers();
// if ($_SERVER['REQUEST_METHOD'] == 'GET') {
// print_r($_GET);
// return;
// if (isset($_GET['status'])) {
//     $status = $_GET['status'];
//     $id = $_GET['id'];
//     if ($status == 'Approved') {
//         $obj->changeStatus($id, 'Rejected');
//         return;
//     }
//     $obj->changeStatus($id, 'Approved');
// }
// if (isset($_GET['approve'])) {
//     $id = $_GET['approve'];
//     $status = 'Approved';
//     $obj->changeStatus($id, $status);
// }
// if (isset($_GET['reject'])) {
//     $id = $_GET['reject'];
//     $status = 'Rejected';
//     $obj->changeStatus($id, $status);
// }
// }
$users = $obj->getUsers();
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
                    <div class="container">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <?php
                                        if (empty($users)) {
                                            echo "No Users found";
                                            return;
                                        } ?>
                                        <table class="table mt-3" border="1">
                                            <thead class="text-white">
                                                <th>No.</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Status</th>

                                            </thead>
                                            <tbody>
                                                <?php

                                                $num = 1;
                                                foreach ($users as $index => $row) {
                                                    echo
                                                    "<tr><td>" . $num . "</td>
                                        <td>" . $row['name'] . "</td> 
                                        <td>" . $row['email'] . "</td>
                                        <td>
                                      
                                        <button id='$row[id]' value='$row[status]' class='btn btn-sm btn-warning buttonStatus'>
                                        $row[status]
                                     </button>
                
                               </td></tr>
                                       ";
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
                <!-- Page Footer-->
                <?php require_once('../includes/footer.php'); ?>
            </div>
        </div>
    </div>
    <!-- footer links -->
    <?php require_once('../includes/footer_links.php'); ?>
</body>
<script>
    $(document).ready(function() {
        $('.buttonStatus').click(function() {
            $status = $(this).val();
            $id = $(this).attr('id');
            //   console.log("status",$status,"id",$id);
            $.ajax({
                url: 'ajax_files/change_status.php',
                type: 'post',
                dataType: 'json',
                data: {
                    id: $id,
                    status: $status,
                },
                success: function(response) {
                  location.reload();
                   
                },
            });

        })

    });

    function refreshErrors() {
        setTimeout(function() {
            $("#status").html('');
            $("#password_status").html('')
        }, 3000);
    }
</script>

</html>