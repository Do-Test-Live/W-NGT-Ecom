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

if (isset($_GET['subcategory_id'])) {
    $row = $db_handle->numRows("select * FROM `product` WHERE subcategory_id='{$_GET['subcategory_id']}'");

    if ($row == 0) {
        $db_handle->insertQuery("delete from subcategory where id=" . $_GET['subcategory_id'] . "");
        echo 'success';
    } else {
        echo 'P';
    }
}

if (isset($_GET['promo_id'])) {
    $row = $db_handle->numRows("select * FROM `billing_details` WHERE promo_code_id='{$_GET['promo_id']}'");

    if ($row == 0) {
        $db_handle->insertQuery("delete from promo_code where id=" . $_GET['promo_id'] . "");
        echo 'success';
    } else {
        echo 'P';
    }
}

if (isset($_GET['product_id'])) {
    $row = $db_handle->numRows("select * FROM `stock` WHERE product_id='{$_GET['product_id']}'");

    if ($row == 0) {
        $db_handle->insertQuery("delete from product where id=" . $_GET['product_id'] . "");
        echo 'success';
    } else {
        echo 'P';
    }
}