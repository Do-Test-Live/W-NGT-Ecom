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
    <title>Add Stock | <?php echo $siteName; ?></title>

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
                            <h4 class="card-title">Add Stock</h4>
                        </div>
                        <div class="card-body">
                            <div class="basic-form">
                                <form method="post" action="insert">
                                    <div class="form-group">
                                        <label>Category Name</label>
                                        <select name="category_id" class="form-control default-select" id="sel2"
                                                onchange="subcategoryFetch(this.value);" required>
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
                                        <label>Sub-Category Name</label>
                                        <select class="form-control" name="subcategory_id" id="subcategory_id" onchange="productFetch(this.value);" required>
                                            <option>Choose category first</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Product Name</label>
                                        <select class="form-control" name="product_id" id="product_id" required>
                                            <option>Choose subcategory first</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control input-default"
                                               placeholder="Product Buy Price" name="buying_price" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control input-default"
                                               placeholder="Product Stock Quantity" name="quantity" required>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" name="insertStock" class="btn btn-primary">Submit</button>
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
<script>
    function subcategoryFetch(value) {
        $.ajax({
            type: 'get',
            url: 'fetch-subcategory',
            data: {
                category_id: value
            },
            success: function (data) {
                $('#subcategory_id').html(data);
                console.log(data);
            }
        });
    }

    function productFetch(value) {
        $.ajax({
            type: 'get',
            url: 'fetch-product',
            data: {
                subcategory_id: value
            },
            success: function (data) {
                $('#product_id').html(data);
                console.log(data);
            }
        });
    }

</script>
</body>
</html>