<?php
session_start();
require_once('../include/dbController.php');
$db_handle = new DBController();
date_default_timezone_set("Asia/Hong_Kong");

if($_POST['insertCategory']){
    $cname=$_POST['cname'];
    $inserted_at=date('Y-m-d h:i:s');

}