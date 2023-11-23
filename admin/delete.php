<?php
session_start();
require_once("../include/dbController.php");
$db_handle = new DBController();
date_default_timezone_set("Asia/Hong_Kong");

/*if (!isset($_SESSION["userid"])) {
    echo "<script>
                window.location.href='login';
                </script>";
}*/

if (isset($_GET['category_id'])) {
    $row = $db_handle->numRows("select * FROM `subcategory` WHERE category_id='{$_GET['category_id']}'");

    if ($row == 0) {
        $db_handle->insertQuery("delete from category where id=" . $_GET['category_id'] . "");
        echo 'success';
    } else {
        echo 'P';
    }
}