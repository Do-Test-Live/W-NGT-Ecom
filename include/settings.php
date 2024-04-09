<?php
$query = "SELECT * FROM `settings`";

$data = $db_handle->runQuery($query);
$row_count = $db_handle->numRows($query);

$favicon=$logo=$site_name=$authorize_key=$meta_description=$money_symbol='';

for ($i = 0; $i < $row_count; $i = $i + 1) {
    if($i==0){
        $favicon= $data[$i]['description'];
    } else if($i==1){
        $logo= $data[$i]['description'];
    } else if($i==2){
        $site_name= $data[$i]['description'];
    } else if($i==3){
        $authorize_key= $data[$i]['description'];
    } else if($i==4){
        $meta_description= $data[$i]['description'];
    } else if($i==5){
        $money_symbol= $data[$i]['description'];
    }
}
?>