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
    <title>Add Product | <?php echo $siteName; ?></title>

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
                            <h4 class="card-title">Add Product</h4>
                        </div>
                        <div class="card-body">
                            <div class="basic-form">
                                <form method="post" action="insert" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label>Category Name</label>
                                        <select multiple name="category_id" class="form-control default-select" id="sel2" required>
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Sub-Category Name</label>
                                        <select name="subcategory_id" multiple class="form-control default-select" id="sel3" required>
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="p_name" class="form-control input-default"
                                               placeholder="Product Name" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="p_price" class="form-control input-default"
                                               placeholder="Product Price" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="discount" class="form-control input-default"
                                               placeholder="Discount" required>
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Upload</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" name="main_image" class="custom-file-input" required>
                                            <label class="custom-file-label">Choose Product Image</label>
                                        </div>
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Upload</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" name="extra_image[]" class="custom-file-input" multiple>
                                            <label class="custom-file-label">Choose Product Extra Images</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <textarea name="description" class="form-control input-default"
                                                  placeholder="Product Description" rows="5" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button type="button" name="insertProduct" class="btn btn-primary">Submit</button>
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
</body>
</html>