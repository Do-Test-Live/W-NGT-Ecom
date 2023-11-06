<?php
session_start();
require_once('../include/dbController.php');
$db_handle = new DBController();
date_default_timezone_set("Asia/Hong_Kong");
$siteName='';

include('include/siteSettings.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Dashboard | <?php echo $siteName; ?></title>

    <?php include('include/css.php'); ?>
</head>
<body>

<?php include('include/preloader.php'); ?>

<!--**********************************
    Main wrapper start
***********************************-->
<div id="main-wrapper">

    <?php include('include/navHeader.php'); ?>

    <?php include('include/header.php'); ?>

    <?php include('include/sidebar.php'); ?>

    <!--**********************************
        Content body start
    ***********************************-->
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class="row">


            </div>
        </div>
    </div>
    <!--**********************************
        Content body end
    ***********************************-->

    <?php include('include/footer.php'); ?>

</div>
<!--**********************************
    Main wrapper end
***********************************-->

<?php include('include/js.php'); ?>
</body>
</html>