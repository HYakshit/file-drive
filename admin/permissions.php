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
                                        <table class="table mt-3" border="1">
                                            <thead class="text-white bg-danger">
                                                <th>No.</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Status</th>
                                                <th>Edit </th>
                                                <th>Delete</th>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $num = 1;
                                                foreach ($users as $index => $row) {
                                                    echo
                                                        "<tr><td>" . $num . "</td>
                                        <td>" . $row['name'] . "</td> 
                                        <td>" . $row['email'] . "</td>
                                        <td>" . $row['status'] . "</td>
                                        <form>
                                        <td><button name='approve' value='$row[id]' class='btn btn-sm btn-warning edit-btn'>
                                         Approve
                                     </button>
                                      </td>
                                     <td><button name='reject' value='$row[id]' class='btn btn-sm btn-danger'>Reject</button></td></tr>
                                     </form>";
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