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
    <title>Content Details | <?php echo $siteName; ?></title>
    <!-- Datatable -->
    <link href="vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
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
                <?php if (isset($_GET['content_id'])) {
                    $data = $db_handle->runQuery("SELECT * FROM content where id={$_GET['content_id']}"); ?>
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Edit Content</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form method="post" action="update" enctype="multipart/form-data">
                                        <input type="hidden" value="<?php echo $data[0]["id"]; ?>" name="id"
                                               required>
                                        <div class="form-group">
                                            <input type="text" class="form-control input-default"
                                                   placeholder="Page Name" name="page_name"
                                                   value="<?php echo $data[0]["page_name"]; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control input-default"
                                                   placeholder="Section Name" name="section_name"
                                                   value="<?php echo $data[0]["section_name"]; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control input-default"
                                                   placeholder="Title" name="title"
                                                   value="<?php echo $data[0]["title"]; ?>" required>
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Upload</span>
                                            </div>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="image">
                                                <label class="custom-file-label">Choose Content Image</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <p>
                                                Description
                                            </p>
                                            <textarea name="description" class="summernote"
                                                      required><?php echo $data[0]["description"]; ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" name="updateContent" class="btn btn-primary">Submit
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
                                <h4 class="card-title">Content Details</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example2" class="display">
                                        <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Page</th>
                                            <th>Section</th>
                                            <th>Title</th>
                                            <th>Image</th>
                                            <th>Description</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $query = "SELECT * FROM content order by id desc";

                                        $data = $db_handle->runQuery($query);
                                        $row_count = $db_handle->numRows($query);

                                        for ($i = 0; $i < $row_count; $i++) {
                                            ?>
                                            <tr>
                                                <td><?php echo $i + 1; ?></td>
                                                <td><?php echo $data[$i]["page_name"]; ?></td>
                                                <td><?php echo $data[$i]["section_name"]; ?></td>
                                                <td><?php echo $data[$i]["title"]; ?></td>
                                                <td><a href="../<?php echo $data[$i]["image"]; ?>"
                                                       target="_blank">image</a></td>
                                                <td><?php echo $data[$i]["description"]; ?></td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <a href="content-details?content_id=<?php echo $data[$i]["id"]; ?>"
                                                           class="btn btn-primary shadow btn-xs sharp mr-1"><i
                                                                    class="fa fa-pencil"></i></a>
                                                        <button onclick="contentDelete(<?php echo $data[$i]["id"]; ?>);"
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
        function contentDelete(id) {
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
                            content_id: id
                        },
                        success: function (data) {
                            Swal.fire(
                                'Deleted!',
                                'Your content has been deleted.',
                                'success'
                            ).then((result) => {
                                window.location = 'content-details';
                            });
                        }
                    });
                } else {
                    Swal.fire(
                        'Cancelled!',
                        'Your content is safe :)',
                        'error'
                    ).then((result) => {
                        window.location = 'content-details';
                    });
                }
            })
        }
    </script>

    <!-- Datatable -->
    <script src="vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="js/plugins-init/datatables.init.js"></script>
    <!-- Summernote -->
    <script src="vendor/summernote/js/summernote.min.js"></script>
    <!-- Summernote init -->
    <script src="js/plugins-init/summernote-init.js"></script>
</body>
</html>