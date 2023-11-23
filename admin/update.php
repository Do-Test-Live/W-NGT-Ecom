<?php
session_start();
require_once("../include/dbController.php");
$db_handle = new DBController();

/*if(!isset($_SESSION["userid"])){
    echo "<script>
                window.location.href='login';
                </script>";
}*/

if (isset($_POST['updateCategory'])) {
    $id = $db_handle->checkValue($_POST['id']);
    $name = $db_handle->checkValue($_POST['cname']);
    $status = $db_handle->checkValue($_POST['status']);

    $updated_at=date('Y-m-d h:i:s');


    $update = $db_handle->insertQuery("update category set c_name='$name', status='$status', updated_at='$updated_at' where id='{$id}'");

    echo "<script>
                document.cookie = 'alert = 3;';
                window.location.href='category-details';
                </script>";

}