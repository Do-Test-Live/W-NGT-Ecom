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
    <title>Promo Code Details | <?php echo $siteName; ?></title>
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
                <?php if (isset($_GET['promo_code_id'])) {
                    $data = $db_handle->runQuery("SELECT * FROM promo_code where id={$_GET['promo_code_id']}"); ?>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Edit Promo Code</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form method="post" action="update">
                                        <input type="hidden" value="<?php echo $data[0]["id"]; ?>" name="id" required>
                                        <div class="form-group">
                                            <input type="text" class="form-control input-default"
                                                   placeholder="Promo Code Name" name="name" value="<?php echo $data[0]["coupon_name"]; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control input-default"
                                                   placeholder="Code" name="code" value="<?php echo $data[0]["code"]; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <p class="mb-1">Discount Type</p>
                                            <select class="form-control" name="coupon_type" required>
                                                <option value="Direct" <?php if($data[0]["coupon_type"]=='Direct') echo 'selected'; ?>>Direct</option>
                                                <option value="Percentage" <?php if($data[0]["coupon_type"]=='Percentage') echo 'selected'; ?>>Percentage</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control input-default"
                                                   placeholder="Amount" name="amount" value="<?php echo $data[0]["amount"]; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <p class="mb-1">Start Date</p>
                                            <input name="start_date" class="form-control" type="datetime-local" value="<?php echo $data[0]["start_date"]; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <p class="mb-1">Expire Date</p>
                                            <input name="expirey_date" class="form-control" type="datetime-local" value="<?php echo $data[0]["expirey_date"]; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control input-default"
                                                   placeholder="Minimum Purchase Amount" name="minimum_purchase_amount" value="<?php echo $data[0]["minimum_order"]; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <p class="mb-1">Description</p>
                                            <textarea name="description" rows="4" class="form-control" required><?php echo $data[0]["description"]; ?></textarea>
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
                                            <button type="submit" name="updatePromoCode" class="btn btn-primary">Submit</button>
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
                                <h4 class="card-title">Promo Code Details</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example2" class="display">
                                        <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Coupon Name</th>
                                            <th>Code</th>
                                            <th>Coupon Type</th>
                                            <th>Amount</th>
                                            <th>Start Date</th>
                                            <th>Expire Date</th>
                                            <th>Minimum Purchase Amount</th>
                                            <th>Description</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $query = "SELECT * FROM promo_code order by id desc";

                                        $data = $db_handle->runQuery($query);
                                        $row_count = $db_handle->numRows($query);

                                        for ($i = 0; $i < $row_count; $i++) {
                                            ?>
                                            <tr>
                                                <td><?php echo $i + 1; ?></td>
                                                <td><?php echo $data[$i]["coupon_name"]; ?></td>
                                                <td><?php echo $data[$i]["code"]; ?></td>
                                                <td><?php echo $data[$i]["coupon_type"]; ?></td>
                                                <td><?php echo $data[$i]["amount"]; ?></td>
                                                <td><?php echo $data[$i]["start_date"]; ?></td>
                                                <td><?php echo $data[$i]["expirey_date"]; ?></td>
                                                <td><?php echo $data[$i]["minimum_order"]; ?></td>
                                                <td><?php echo $data[$i]["description"]; ?></td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <a href="promo-code-details?promo_code_id=<?php echo $data[$i]["id"]; ?>" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
                                                        <button onclick="promoDelete(<?php echo $data[$i]["id"]; ?>);" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></button>
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
        function promoDelete(id) {
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
                            promo_id: id
                        },
                        success: function (data) {
                            if (data.toString() === 'P') {
                                Swal.fire(
                                    'Not Deleted!',
                                    'Someone used this code for purchase.',
                                    'error'
                                ).then((result) => {
                                    window.location = 'promo-code-details';
                                });
                            } else {
                                Swal.fire(
                                    'Deleted!',
                                    'Your promo code has been deleted.',
                                    'success'
                                ).then((result) => {
                                    window.location = 'promo-code-details';
                                });
                            }
                        }
                    });
                } else {
                    Swal.fire(
                        'Cancelled!',
                        'Your promo code is safe :)',
                        'error'
                    ).then((result) => {
                        window.location = 'promo-code-details';
                    });
                }
            })
        }
    </script>
</body>
</html>