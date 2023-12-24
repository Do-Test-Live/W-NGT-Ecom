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
    <title>Stock Details | <?php echo $siteName; ?></title>
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
                <?php if (isset($_GET['stock_id'])) {
                    $data = $db_handle->runQuery("SELECT * FROM stock where id={$_GET['stock_id']}");

                    $product = $db_handle->runQuery("SELECT * FROM product where id={$data[0]["product_id"]}");
                    $category = $db_handle->runQuery("SELECT * FROM category where id={$product[0]["category_id"]}");
                    $subcategory = $db_handle->runQuery("SELECT * FROM subcategory where id={$product[0]["subcategory_id"]}");

                    ?>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Edit Stock</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form method="post" action="update">
                                        <input type="hidden" value="<?php echo $data[0]["id"]; ?>" name="id" required>
                                        <div class="form-group">
                                            <label>Category Name</label>
                                            <select name="category_id" class="form-control default-select" id="sel2"
                                                    onchange="subcategoryFetch(this.value);" required>
                                                <?php
                                                $query = "SELECT * FROM category where id={$product[0]["category_id"]}";
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
                                            <select class="form-control" name="subcategory_id" id="subcategory_id" onchange="productFetch(this.value);" required>
                                                <?php
                                                $query = "SELECT * FROM subcategory where id={$product[0]["subcategory_id"]}";
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
                                            <select class="form-control" name="product_id" id="product_id" required>
                                                <?php
                                                $query = "SELECT * FROM product where id={$data[0]["product_id"]}";
                                                $product_data = $db_handle->runQuery($query);
                                                $row_count = $db_handle->numRows($query);

                                                for ($i = 0; $i < $row_count; $i++) {
                                                    ?>
                                                    <option value="<?php echo $product_data[$i]["id"]; ?>">
                                                        <?php echo $product_data[$i]["p_name"]; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control input-default"
                                                   placeholder="Product Buy Price" name="buying_price" value="<?php echo $data[0]["buying_price"]; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control input-default"
                                                   placeholder="Product Stock Quantity" name="quantity" value="<?php echo $data[0]["quantity"]; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" name="updateStock" class="btn btn-primary">Submit</button>
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
                                <h4 class="card-title">Stock Details</h4>
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
                                            <th>Buying Price</th>
                                            <th>Quantity</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $query = "SELECT * FROM stock order by id desc";

                                        $data = $db_handle->runQuery($query);
                                        $row_count = $db_handle->numRows($query);

                                        for ($i = 0; $i < $row_count; $i++) {
                                            ?>
                                            <tr>
                                                <td><?php echo $i + 1; ?></td>
                                                <td>
                                                    <?php
                                                    $product = $db_handle->runQuery("SELECT * FROM product where id={$data[$i]["product_id"]}");
                                                    $category = $db_handle->runQuery("SELECT * FROM category where id={$product[0]["category_id"]}");
                                                    $subcategory = $db_handle->runQuery("SELECT * FROM subcategory where id={$product[0]["subcategory_id"]}");

                                                    echo $category[0]["c_name"];
                                                    ?>
                                                </td>
                                                <td><?php echo $subcategory[0]["s_name"]; ?></td>
                                                <td><?php echo $product[0]["p_name"]; ?></td>
                                                <td><?php echo $data[$i]["buying_price"]; ?></td>
                                                <td><?php echo $data[$i]["quantity"]; ?></td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <a href="stock-details?stock_id=<?php echo $data[$i]["id"]; ?>" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
                                                        <button onclick="stockDelete(<?php echo $data[$i]["id"]; ?>);" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></button>
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

        function stockDelete(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'get',
                        url: 'delete',
                        data: {
                            stock_id: id
                        },
                        success: function (data) {
                            if (data.toString() === 'P') {
                                Swal.fire(
                                    'Not Deleted!',
                                    'Your have already sell product from this stock.',
                                    'error'
                                ).then((result) => {
                                    window.location = 'stock-details';
                                });
                            } else {
                                Swal.fire(
                                    'Deleted!',
                                    'Your stock has been deleted.',
                                    'success'
                                ).then((result) => {
                                    window.location = 'stock-details';
                                });
                            }
                        }
                    });
                } else {
                    Swal.fire(
                        'Cancelled!',
                        'Your stock is safe :)',
                        'error'
                    ).then((result) => {
                        window.location = 'stock-details';
                    });
                }
            })
        }
    </script>
</body>
</html>