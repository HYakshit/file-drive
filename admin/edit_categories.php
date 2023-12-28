<?php
require("../database/User.php");
if (!isset($_SESSION["admin"])) {
    header("location:../");
}
$obj = new User();
$category_array = $obj->getCategories();
?>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Edit Category</title>
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
                        <h2 class="mb-0 p-1">Edit</h2>
                    </div>
                </header>
                <!-- Main Section-->
                <section class="pt-2">
                    <div class="container">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-10">
                                        <?php
                                        if (empty($category_array)) {
                                            echo "No Categories found";
                                        } ?>
                                        <table class="table mt-3" border="1">
                                            <thead class="">
                                                <th>No.</th>
                                                <th>Name</th>
                                                <th>Edit </th>
                                                <th>Delete</th>
                                            </thead>
                                            <tbody>
                                                <?php

                                                $num = 1;
                                                foreach ($category_array as $index => $row) {
                                                    echo
                                                    "<tr>
                                                    <td>" . $num . "</td>
                                                    <td>" . $row['name'] . "</td> 
                                        <td><button id='edit' data-category='$row[name]' value='$row[id]' class='btn btn-sm btn-warning edit-btn'>
                                         Edit
                                     </button>
                                      </td>
                                     <td><button id='delete' value='$row[id]' class='btn btn-sm btn-danger'>Delete</button></td></tr>
                                    ";
                                                    $num++;
                                                } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-2">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn mt-2 btn-primary w-100" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            Add Categories
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </section>
                <!-- Page Footer-->
                <?php require_once('../includes/footer.php'); ?>
            </div>
            <!--Add category modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Add Categories</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="category_form">
                            <div class="modal-body">
                                <!-- Category -->
                                <div>
                                    <label for="category">Category</label>
                                    <input class="form-control" name="category" type="text" id="category">
                                </div>
                                <div id="category_status"></div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" id="close_modal" class="btn  btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--Edit Modal -->
            <div class="modal fade" id="edit_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Category</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <label class="label-material" for="updatedcountry">Category</label>
                            <input class="form-control" id="edit_category" type="text" name="updatedcountry" autocomplete="off" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="close_modal" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" id="update" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- footer links -->
    <?php require_once('../includes/footer_links.php'); ?>
</body>
<script>
    $(document).ready(function() {
        $('#category_form').submit(function(event) {
            event.preventDefault();
            var category = $('#category').val();
            $.ajax({
                url: "ajax_files/category_ajax.php",
                type: "post",
                dataType: 'json',
                data: {
                    action: 'add',
                    category: category,
                },
                success: function(res) {
                    if (res['status']) {
                        // $('#category_status').html(`<p class="alert alert-success">${res['message']}</p>`);
                        location.reload();
                        return;
                    }
                    $('#category_status').html(`<p class="alert alert-danger">${res['message']}</p>`);
                    refreshErrors();
                }
            });
        });

        $(document).on("click", "#edit", function() {
            let index = $(this).val();

            // get edit values
            let category = $(this).data('category');

            // Set the values in the modal inputs
            $('#edit_category').val(category);
            $('#edit_modal').modal('show');

            $('#update').click(function() {
                let category = $('#edit_category').val();
                $.ajax({
                    type: "post",
                    dataType: 'json',
                    url: 'ajax_files/category_ajax.php',
                    data: {
                        action: 'edit',
                        index: index,
                        category: category,

                    },
                    success: function(res) {
                        console.log(res);
                    }
                });
            })
        });
        // delete
        $(document).on("click", "#delete", function() {
            let index = $(this).val();
            $.ajax({
                type: "post",
                dataType: 'json',
                url: 'ajax_files/category_ajax.php',
                data: {
                    action: 'delete',
                    index: index,
                },
                success: function(res) {
                    console.log(res);
                },
            });
        });
    });

    function refreshErrors() {
        setTimeout(function() {
            $("#status").html('');
            $("#password_status").html('')
        }, 3000);
    }
</script>

</html>