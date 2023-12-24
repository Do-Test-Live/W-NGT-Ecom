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

if (isset($_POST['updateSubCategory'])) {
    $id = $db_handle->checkValue($_POST['id']);
    $category_id = $db_handle->checkValue($_POST['category_id']);
    $s_name = $db_handle->checkValue($_POST['s_name']);
    $status = $db_handle->checkValue($_POST['status']);

    $updated_at=date('Y-m-d h:i:s');


    $update = $db_handle->insertQuery("UPDATE `subcategory` SET `category_id`='$category_id',`s_name`='$s_name',`status`='$status',`updated_at`='$updated_at' WHERE `id`='$id'");

    echo "<script>
                document.cookie = 'alert = 3;';
                window.location.href='subcategory-details';
                </script>";

}

if (isset($_POST['updateProduct'])) {
    $id = $db_handle->checkValue($_POST['id']);
    $category_id = $db_handle->checkValue($_POST['category_id']);
    $subcategory_id = $db_handle->checkValue($_POST['subcategory_id']);
    $p_name = $db_handle->checkValue($_POST['p_name']);
    $p_price = $db_handle->checkValue($_POST['p_price']);
    $discount = $db_handle->checkValue($_POST['discount']);
    $description = $db_handle->checkValue($_POST['description']);
    $status = $db_handle->checkValue($_POST['status']);

    $query='';

    $main_image='';

    if (!empty($_FILES['main_image']['name'])){
        $RandomAccountNumber = mt_rand(1, 99999);
        $file_name = $RandomAccountNumber."_" . $_FILES['main_image']['name'];
        $file_size = $_FILES['main_image']['size'];
        $file_tmp = $_FILES['main_image']['tmp_name'];

        $file_type = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        if (
            $file_type != "jpg" && $file_type != "png" && $file_type != "jpeg"
            && $file_type != "gif"
        ) {
            $main_image = '';
        } else {
            move_uploaded_file($file_tmp, "../assets/images/product/" .$file_name);
            $main_image = "assets/images/product/" . $file_name;

            $query.=",`meta_image`=".$main_image;
        }
    }

    $extra_images = array();

    if (!empty($_FILES['extra_image']['name'][0])) {
        $file_count = count($_FILES['extra_image']['name']);

        for ($i = 0; $i < $file_count; $i++) {
            $RandomAccountNumber = mt_rand(1, 99999);
            $file_name = $RandomAccountNumber . "_" . $_FILES['extra_image']['name'][$i];
            $file_size = $_FILES['extra_image']['size'][$i];
            $file_tmp = $_FILES['extra_image']['tmp_name'][$i];

            $file_type = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

            if ($file_type != "jpg" && $file_type != "png" && $file_type != "jpeg" && $file_type != "gif") {
                // Handle invalid file type
            } else {
                move_uploaded_file($file_tmp, "../assets/images/product/" . $file_name);
                $extra_images[] = "assets/images/product/" . $file_name;


            }
        }
        $extra_images_json = json_encode($extra_images);

        $query.=",`extra_image`=".$extra_images_json;
    }


    $updated_at=date('Y-m-d h:i:s');


    $update = $db_handle->insertQuery("UPDATE `product` SET `category_id`='$category_id',`subcategory_id`='$subcategory_id',`p_name`='$p_name',`p_price`='$p_price',`discount`='$discount',`description`='$description'".$query.",`status`='$status',`updated_at`='$updated_at' WHERE `id`='$id'");

    echo "<script>
                document.cookie = 'alert = 3;';
                window.location.href='product-details';
                </script>";
}

if (isset($_POST['updateStock'])) {
    $id = $db_handle->checkValue($_POST['id']);
    $product_id = $db_handle->checkValue($_POST['product_id']);
    $buying_price = $db_handle->checkValue($_POST['buying_price']);
    $quantity = $db_handle->checkValue($_POST['quantity']);

    $updated_at=date('Y-m-d h:i:s');


    $update = $db_handle->insertQuery("UPDATE `stock` SET `product_id`='$product_id',`buying_price`='$buying_price',`quantity`='$quantity',`updated_at`='$updated_at' WHERE `id`='$id'");

    echo "<script>
                document.cookie = 'alert = 3;';
                window.location.href='stock-details';
                </script>";

}