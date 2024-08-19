<?php
session_start();
$logedUser = $_SESSION['user'];
if (!isset($_SESSION["user"])) {
    header("location:index.php");
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
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
                                        <?php
                                        echo "<h2>welcome ".$logedUser['name']."</h2>";
                                        
                                        ?>
                                        </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Page Footer-->
                <?php require_once('includes/footer.php'); ?>
            </div>
        </div>
    </div>
</body>
<script>

</script>