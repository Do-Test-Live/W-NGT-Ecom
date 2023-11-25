<?php
session_start();
require_once('../include/dbController.php');
$db_handle = new DBController();
date_default_timezone_set("Asia/Hong_Kong");

/*if (!isset($_SESSION["userid"])) {
    echo "<script>
                window.location.href='Login';
                </script>";
}*/

if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];

    $data = $db_handle->runQuery("SELECT * FROM subcategory where category_id='$category_id'");
    $row_count = $db_handle->numRows("SELECT * FROM subcategory where category_id='$category_id'");

    for ($i = 0; $i < $row_count; $i++) {
        ?><option value="<?php echo $data[$i]["id"]; ?>"><?php echo $data[$i]["s_name"]; ?></option><?php }
}