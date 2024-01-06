<?php
require("../database/User.php");
if (!isset($_SESSION["admin"])) {
    header("location:../");
}
$obj = new User();
$category_array = $obj->getCategories();
$data = $obj->getdata($_SESSION['admin']['id']);
// admin change
if (!empty($data['img_url'])) {
  $_SESSION['img'] = $data['img_url'];
} else {

  $_SESSION['img'] = 'default.jpg';
}
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
                                                    echo "<input class='p-2 form-check-input' type='checkbox' name='category[]' id='$row[id]' value='$row[id]'
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
                                            <button type="submit" id="submit" name="submit"
                                                class="btn mb-2 btn-success">Upload</button>
                                        </form>
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
    $(document).ready(function () {
        $('#file_form').submit(function (event) {
            event.preventDefault();
            var formData = new FormData($(this)[0]);
            $.ajax({
                url: 'ajax_files/file_ajax.php',
                type: 'post',
                dataType: 'json',
                contentType: false,
                processData: false,
                data: formData,
                success: function (res) {
                    // console.log(res);
                    if (!res['status']) {
                        $("#status").html(`<p class="alert alert-danger">${res['message']}</p>`);
                        refreshErrors();
                        return;
                    }
                    $("#status").html(`<p class="alert alert-success">${res['message']}</p>`);
                    refreshErrors();
                },
            });
        });

        function refreshErrors() {
            setTimeout(function () {
                $("#status").html('');
            }, 3000);
        }
    });
</script>

</html>