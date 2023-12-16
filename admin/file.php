<?php
require("../database/User.php");
if (!isset($_SESSION["admin"])) {
    header("location:../");
}
$obj = new User();

$category_array = $obj->getCategories();
// print_r($category_array);
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
                                    <div class="col-md-10">
                                        <!-- categories -->
                                        <form id="file_form" method="post" enctype="multipart/form-data">
                                            <div class="form-group  mb-2">
                                                <label class="Hedvig Letters Sans sans-serif">Select Category</label>
                                                <?php
                                                foreach ($category_array as $index => $row) {
                                                    echo "<input class='p-2 form-check-input' type='checkbox' name='Category' id='$row[id]' value='$row[name]'
                                                  class='custom'/>
                                              <label class='me-3 form-check-label' for='$row[id]'>$row[name]</label>";
                                                }
                                                ?>
                                            </div>
                                            <!-- file -->
                                            <div class="form-group  mb-2">
                                                <label class="Hedvig Letters Sans sans-serif">Select File to
                                                    Upload</label>
                                                <input required class="form-control" type="file" name="file">
                                            </div>
                                            <p id="status"></p>
                                            <!-- submit -->
                                            <button type="submit" id="submit" name="submit" class="btn mb-2 btn-success">Upload</button>
                                        </form>
                                    </div>

                                </div>
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
        var category = $('input[name="Category"]:checked').serialize();
        var file = $('input[name="file"]')[0].files;

        // Create a FormData object and append form data
        var formData = new FormData();
        formData.append('path', category);
        formData.append('file', file);

        $.ajax({
            url: 'ajax/php',
            type: 'post',
            contentType: false,
            processData: false,
            data: {
                data: formData,
            },
            success: function(res) {
                console.log(res);
                if (res == 'false') {
                    $('#repeat_err').text('Error');
                    setTimeout(function() {
                        $('span').text('');
                    }, 1500);
                } else {
                    list();
                    $('#repeat_err').text('Data Stored Successfully');
                }
            }
        })


        function refreshErrors() {
            setTimeout(function() {
                $("#status").html('');
                $("#password_status").html('')
            }, 3000);
        }
    });
</script>

</html>