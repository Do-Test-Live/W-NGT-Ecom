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
    <title>Category Details | <?php echo $siteName; ?></title>
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
                <?php if (isset($_GET['category_id'])) {
                    $data = $db_handle->runQuery("SELECT * FROM category where id={$_GET['category_id']}"); ?>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Edit Category</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form method="post" action="update">
                                        <input type="hidden" value="<?php echo $data[0]["id"]; ?>" name="id" required>
                                        <div class="form-group">
                                            <input type="text" class="form-control input-default"
                                                   placeholder="Category Name" name="cname" value="<?php echo $data[0]["c_name"]; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select multiple class="form-control default-select" name="status" id="sel2" required>
                                                <option value="1" <?php echo ($data[0]["status"] == 1) ? "selected" : ""; ?>>
                                                    Show
                                                </option>
                                                <option value="0" <?php echo ($data[0]["status"] == 0) ? "selected" : ""; ?>>
                                                    Hide
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" name="updateCategory" class="btn btn-primary">Submit</button>
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
                            <h4 class="card-title">Category Details</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example2" class="display">
                                    <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Category Name</th>
                                        <th>Total Subcategory</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $query = "SELECT * FROM category order by id desc";

                                    $data = $db_handle->runQuery($query);
                                    $row_count = $db_handle->numRows($query);

                                    for ($i = 0; $i < $row_count; $i++) {
                                        ?>
                                        <tr>
                                            <td><?php echo $i + 1; ?></td>
                                            <td><?php echo $data[$i]["c_name"]; ?></td>
                                            <td>
                                                <?php
                                                $totalSubCategory = $db_handle->numRows("SELECT * FROM subcategory where category_id like '%{$data[$i]["id"]}%'");
                                                echo $totalSubCategory;
                                                ?>
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <a href="category-details?category_id=<?php echo $data[$i]["id"]; ?>" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
                                                    <button onclick="categoryDelete(<?php echo $data[$i]["id"]; ?>);" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></button>
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
        function categoryDelete(id) {
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
                            category_id: id
                        },
                        success: function (data) {
                            if (data.toString() === 'P') {
                                Swal.fire(
                                    'Not Deleted!',
                                    'Your have subcategory in this category.',
                                    'error'
                                ).then((result) => {
                                    window.location = 'category-details';
                                });
                            } else {
                                Swal.fire(
                                    'Deleted!',
                                    'Your category has been deleted.',
                                    'success'
                                ).then((result) => {
                                    window.location = 'category-details';
                                });
                            }
                        }
                    });
                } else {
                    Swal.fire(
                        'Cancelled!',
                        'Your category is safe :)',
                        'error'
                    ).then((result) => {
                        window.location = 'category-details';
                    });
                }
            })
        }
    </script>
</body>
</html>