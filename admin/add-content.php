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
    <title>Add Content | <?php echo $siteName; ?></title>
    <!-- Summernote -->
    <link href="vendor/summernote/summernote.css" rel="stylesheet">

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
                            <h4 class="card-title">Add Content</h4>
                        </div>
                        <div class="card-body">
                            <div class="basic-form">
                                <form method="post" action="insert" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <input type="text" class="form-control input-default"
                                               placeholder="Page Name" name="page_name" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control input-default"
                                               placeholder="Section Name" name="section_name" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control input-default"
                                               placeholder="Title" name="title" required>
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Upload</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="image" required>
                                            <label class="custom-file-label">Choose Content Image</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <p>
                                            Description
                                        </p>
                                        <textarea name="description" class="summernote" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" name="insertContent" class="btn btn-primary">Submit</button>
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

<!-- Summernote -->
<script src="vendor/summernote/js/summernote.min.js"></script>
<!-- Summernote init -->
<script src="js/plugins-init/summernote-init.js"></script>
</body>
</html>