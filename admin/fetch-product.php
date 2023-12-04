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

if (isset($_GET['subcategory_id'])) {
    $subcategory_id = $_GET['subcategory_id'];

    $query="SELECT * FROM product where subcategory_id='$subcategory_id'";
    $data = $db_handle->runQuery($query);
    $row_count = $db_handle->numRows($query);
    ?>
    <option>Choose Now</option>
        <?php
    for ($i = 0; $i < $row_count; $i++) {
        ?><option value="<?php echo $data[$i]["id"]; ?>"><?php echo $data[$i]["p_name"]; ?></option><?php }
}