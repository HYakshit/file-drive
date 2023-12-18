<?php
require("../database/User.php");
$obj = new User();
$approved_users = $obj->getApprovedUsers();
$files_array = $obj->getFiles();
// echo"<pre>";
// $rr;

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
                                    <div class="col">
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
                                     <td>  <button type='button' value='$row[id]' class='btn action btn-primary' data-bs-toggle='modal' data-bs-target='#exampleModal'>
                                     share
                                 </button></td></tr>
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
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Select Users</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="users_form">
                        <div class="modal-body">
                            <!-- <label class='me-3 form-check-label' >Select Users</label> -->
                            <?php foreach ($approved_users as $index => $user) {
                                echo "<input class='p-2 form-check-input' type='checkbox' name='users[]' id='$user[id]' value='$user[id]'
                                                  class='custom'/>
                                              <label class='me-3 form-check-label' for='$user[id]'>$user[name]</label><br>
                                             ";

                            }
                            ?>
                            <input id='id_saver' name='file_id' value="" class='d-none' />
                            <div id="status"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="close_modal" class="btn btn-secondary"
                                data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Share</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <!-- footer links -->
    <?php require_once('../includes/footer_links.php'); ?>
</body>
<script>
    $(document).ready(function () {
        $('.action').click(function () {
            $file_id = $(this).val();
            console.log($file_id);
            $('#id_saver').val($file_id);

        });
        $('#users_form').submit(function (event) {
            event.preventDefault();
            var formData = new FormData($(this)[0]);
            // console.log(formData);
            // formData.append()
            $.ajax({
                url: 'ajax_files/share_files.php',
                type: 'post',
                dataType: 'json',
                contentType: false,
                processData: false,
                data: formData,
                success: function (res) {
                    console.log(res);
                    if (!res['status']) {
                        $("#status").html(`<p class="alert alert-danger">${res['message']}</p>`);
                        refreshErrors();
                        return;
                    }
                    $("#status").html(`<p class="alert alert-success">${res['message']}</p>`);
                    refreshErrors();
                },
            });
            function refreshErrors() {
                setTimeout(function () {
                    $("#status").html('');
                    $("#password_status").html('')
                }, 3000);
            }
        });
    });

</script>

</html>