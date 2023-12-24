<?php
$data = $db_handle->runQuery("SELECT * FROM `settings` where name='site_name'");
$siteName=$data[0]['description'];