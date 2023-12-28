<?php
session_start();
$id = $_SESSION['user']['id'];
// echo $id;
require("../database/User.php");
$obj = new User();
$approvedusers = $obj->getApprovedUsers();
$approvedIdArray = array_column($approvedusers, 'id');
$files_array = $obj->getSharedFiles($id);
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <?php require_once('../includes/head_links.php'); ?>
</head>

<body>
    <section class="pt-2">
        <div class="container ">
            <div class="card">
                <div class="card-body">
                    <div class="row">


                        <div class="col">
                            <?php
                            if (empty($files_array)) {
                                echo "No files shared";
                                return;
                            } else if (!(in_array($id, $approvedIdArray))) {
                                echo " User have no permission";
                                return;
                            } ?>
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
</body>
<script>

</script>