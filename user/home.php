<?php
session_start();
$id = $_SESSION['user']['id'];
// echo $id;
// exit();
require("../database/User.php");
$obj = new User();
$files_array = $obj->getSharedFiles($id);
// echo '<pre>';
// print_r($files_array);
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <!-- Include jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- css -->
    <!-- <link rel="stylesheet" href="home.css"> -->
    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
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
                                        <td><button name='view' value='$row[id]' class='btn btn-sm btn-warning edit-btn'>
                                         View
                                     </button>
                                      </td>
                                     <td><button name='download' value='$row[id]' class='btn btn-sm btn-success'>Download</button></td></tr>";
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