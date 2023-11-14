<?php
session_start();
require_once('../include/dbController.php');
$db_handle = new DBController();
date_default_timezone_set("Asia/Hong_Kong");
$siteName = '';

include('include/siteSettings.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Add Promo Code | <?php echo $siteName; ?></title>
    <!-- Daterange picker -->
    <link href="vendor/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Pick date -->
    <link rel="stylesheet" href="vendor/pickadate/themes/default.css">
    <link rel="stylesheet" href="vendor/pickadate/themes/default.date.css">

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
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Add Promo Code</h4>
                        </div>
                        <div class="card-body">
                            <div class="basic-form">
                                <form method="post" action="insert">
                                    <div class="form-group">
                                        <input type="text" class="form-control input-default"
                                               placeholder="Promo Code Name" name="name" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control input-default"
                                               placeholder="Value" name="value" required>
                                    </div>
                                    <div class="form-group">
                                        <p class="mb-1">Start Date</p>
                                        <input name="start_date" class="datepicker-default form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <p class="mb-1">Expire Date</p>
                                        <input name="expirey_date" class="datepicker-default form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control input-default"
                                               placeholder="Minimum Purchase Amount" name="minimum_purchase_amount" required>
                                    </div>
                                    <div class="form-group">
                                        <button type="button" name="insertPromoCode" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
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

<!-- pickdate -->
<script src="vendor/pickadate/picker.js"></script>
<script src="vendor/pickadate/picker.time.js"></script>
<script src="vendor/pickadate/picker.date.js"></script>



<!-- Daterangepicker -->
<script src="js/plugins-init/bs-daterange-picker-init.js"></script>
<!-- Clockpicker init -->
<script src="js/plugins-init/clock-picker-init.js"></script>
<!-- asColorPicker init -->
<script src="js/plugins-init/jquery-asColorPicker.init.js"></script>
<!-- Material color picker init -->
<script src="js/plugins-init/material-date-picker-init.js"></script>
<!-- Pickdate -->
<script src="js/plugins-init/pickadate-init.js"></script>
</body>
</html>