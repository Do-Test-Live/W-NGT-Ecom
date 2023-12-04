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
    <title>Product Details | <?php echo $siteName; ?></title>
    <!-- Datatable -->
    <link href="vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">

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
                <div class="container-fluid">
                    <div class="row">
                        <?php if (isset($_GET['product_id'])) {
                            $data = $db_handle->runQuery("SELECT * FROM product where id={$_GET['product_id']}"); ?>
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Edit Product</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="basic-form">
                                            <form method="post" action="update">
                                                <input type="hidden" value="<?php echo $data[0]["id"]; ?>" name="id"
                                                       required>
                                                <div class="form-group">
                                                    <label>Category Name</label>
                                                    <select name="category_id" class="form-control default-select"
                                                            id="sel2"
                                                            onchange="subcategoryFetch(this.value);" required>
                                                        <?php
                                                        $query = "SELECT * FROM category where id={$data[0]["category_id"]}";
                                                        $category_data = $db_handle->runQuery($query);
                                                        $row_count = $db_handle->numRows($query);

                                                        for ($i = 0; $i < $row_count; $i++) {
                                                            ?>
                                                            <option value="<?php echo $category_data[$i]["id"]; ?>">
                                                                <?php echo $category_data[$i]["c_name"]; ?>
                                                            </option>
                                                        <?php } ?>
                                                        <?php
                                                        $query = "SELECT * FROM category order by id desc";
                                                        $category_data = $db_handle->runQuery($query);
                                                        $row_count = $db_handle->numRows($query);

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
                                                    <select class="form-control" name="subcategory_id"
                                                            id="subcategory_id" required>
                                                        <?php
                                                        $query = "SELECT * FROM subcategory where id={$data[0]["subcategory_id"]}";
                                                        $subcategory_data = $db_handle->runQuery($query);
                                                        $row_count = $db_handle->numRows($query);

                                                        for ($i = 0; $i < $row_count; $i++) {
                                                            ?>
                                                            <option value="<?php echo $subcategory_data[$i]["id"]; ?>">
                                                                <?php echo $subcategory_data[$i]["s_name"]; ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Product Name</label>
                                                    <input type="text" name="p_name" class="form-control input-default"
                                                           placeholder="Product Name"
                                                           value="<?php echo $data[0]["p_name"]; ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Product Price</label>
                                                    <input type="text" name="p_price" class="form-control input-default"
                                                           placeholder="Product Price"
                                                           value="<?php echo $data[0]["p_price"]; ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Discount</label>
                                                    <input type="text" name="discount"
                                                           class="form-control input-default"
                                                           placeholder="Discount"
                                                           value="<?php echo $data[0]["discount"]; ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Main Image</label>
                                                    <div class="row">
                                                        <div class="col-lg-6 mb-3">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">Upload</span>
                                                                </div>
                                                                <div class="custom-file">
                                                                    <input type="file" name="main_image"
                                                                           class="custom-file-input">
                                                                    <label class="custom-file-label">Choose Product
                                                                        Image</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 mb-3">
                                                            <div class="text-center">
                                                                <img src="../<?php echo $data[0]["main_image"]; ?>" alt=""
                                                                     class="img-fluid" style="max-height: 100px;"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Extra Image</label>
                                                    <div class="row">
                                                        <div class="col-lg-6 mb-3">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">Upload</span>
                                                                </div>
                                                                <div class="custom-file">
                                                                    <input type="file" name="extra_image[]"
                                                                           class="custom-file-input"
                                                                           onchange="displayImageNames(event);" multiple>
                                                                    <label class="custom-file-label">Choose Product Extra
                                                                        Images</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 mb-3">
                                                            <div class="text-center">
                                                                <?php
                                                                $urls = json_decode($data[0]["extra_image"]);
                                                                foreach ($urls as $url) {
                                                                    ?>
                                                                    <img src="../<?php echo $url; ?>" alt=""
                                                                         class="img-fluid" style="max-height: 100px;margin-right: 1em"/>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <div id="fileNamesDisplay"></div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Product Description</label>
                                                    <textarea name="description" class="form-control input-default"
                                                              placeholder="Product Description" rows="5"
                                                              required><?php echo $data[0]["description"]; ?></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <select multiple class="form-control default-select" name="status"
                                                            id="sel2" required>
                                                        <option value="1" <?php echo ($data[0]["status"] == 1) ? "selected" : ""; ?>>
                                                            Show
                                                        </option>
                                                        <option value="0" <?php echo ($data[0]["status"] == 0) ? "selected" : ""; ?>>
                                                            Hide
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" name="updateProduct" class="btn btn-primary">
                                                        Submit
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } else { ?>
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Product Details</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="example2" class="display">
                                                <thead>
                                                <tr>
                                                    <th>SL</th>
                                                    <th>Category Name</th>
                                                    <th>Subcategory Name</th>
                                                    <th>Product Name</th>
                                                    <th>Price</th>
                                                    <th>Discount</th>
                                                    <th>Description</th>
                                                    <th>Image</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                $query = "SELECT * FROM product order by id desc";

                                                $data = $db_handle->runQuery($query);
                                                $row_count = $db_handle->numRows($query);

                                                for ($i = 0; $i < $row_count; $i++) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $i + 1; ?></td>
                                                        <td>
                                                            <?php
                                                            $category = $db_handle->runQuery("SELECT * FROM category where id ='{$data[$i]["category_id"]}'");
                                                            echo $category[0]['c_name'];
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            $subcategory = $db_handle->runQuery("SELECT * FROM subcategory where id = '{$data[$i]["subcategory_id"]}'");
                                                            echo $subcategory[0]['s_name'];
                                                            ?>
                                                        </td>
                                                        <td><?php echo $data[$i]["p_name"]; ?></td>
                                                        <td><?php echo $data[$i]["p_price"]; ?></td>
                                                        <td><?php echo $data[$i]["discount"]; ?></td>
                                                        <td><?php echo $data[$i]["description"]; ?></td>
                                                        <td>
                                                            <a href="../<?php echo $data[$i]["main_image"]; ?>"
                                                               target="_blank">main_image</a><br/>
                                                            <?php
                                                            $urls = json_decode($data[$i]["extra_image"]);

                                                            $c = 1;
                                                            foreach ($urls as $url) {
                                                                ?>
                                                                <a href="../<?php echo $url; ?>" target="_blank">extra_image_<?php echo $c; ?></a>
                                                                <br/>
                                                                <?php
                                                                $c += 1;
                                                            }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex justify-content-center">
                                                                <a href="product-details?product_id=<?php echo $data[$i]["id"]; ?>"
                                                                   class="btn btn-primary shadow btn-xs sharp mr-1"><i
                                                                            class="fa fa-pencil"></i></a>
                                                                <button onclick="categoryDelete(<?php echo $data[$i]["id"]; ?>);"
                                                                        class="btn btn-danger shadow btn-xs sharp"><i
                                                                            class="fa fa-trash"></i></button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
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

    <!-- Datatable -->
    <script src="vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="js/plugins-init/datatables.init.js"></script>

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

        function displayImageNames(event) {
            const input = event.target;
            if ('files' in input && input.files.length > 0) {
                const fileList = input.files;
                let fileNames = '';
                for (let i = 0; i < fileList.length; i++) {
                    fileNames += fileList[i].name + ', ';
                }
                fileNames = fileNames.slice(0, -2); // Remove the trailing comma and space
                const fileNamesDisplay = document.getElementById('fileNamesDisplay');
                if (fileNamesDisplay) {
                    fileNamesDisplay.textContent = 'Selected files: ' + fileNames; // Display names in the separate div
                }
            }
        }

    </script>
</body>
</html>