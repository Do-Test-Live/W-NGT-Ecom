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
    <title>Add Subcategory | <?php echo $siteName; ?></title>

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
                            <h4 class="card-title">Add Sub-Category</h4>
                        </div>
                        <div class="card-body">
                            <div class="basic-form">
                                <form method="post" action="insert">
                                    <div class="form-group">
                                        <label>Category Name</label>
                                        <select multiple class="form-control default-select" name="category_id" id="sel2" required>
                                            <?php
                                            $category_data = $db_handle->runQuery("SELECT * FROM category order by id desc");
                                            $row_count = $db_handle->numRows("SELECT * FROM category order by id desc");

                                            for ($i = 0; $i < $row_count; $i++) {
                                                ?>
                                                <option value="<?php echo $category_data[$i]["id"]; ?>">
                                                    <?php echo $category_data[$i]["c_name"]; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control input-default"
                                               placeholder="Sub-Category Name" name="s_name" required>
                                    </div>
                                    <div class="form-group">
                                        <button type="button" name="insertSubcategory" class="btn btn-primary">Submit</button>
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