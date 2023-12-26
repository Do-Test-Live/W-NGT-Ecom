<?php
session_start();
require_once('../include/dbController.php');
$db_handle = new DBController();
date_default_timezone_set("Asia/Hong_Kong");

if(isset($_POST['insertCategory'])){
    $cname=$_POST['cname'];
    $inserted_at=date('Y-m-d h:i:s');

    $insert = $db_handle->insertQuery("INSERT INTO `category`(`c_name`, `inserted_at`) VALUES ('$cname','$inserted_at')");

    if($insert){
        echo "<script>
                document.cookie = 'alert = 1;';
                window.location.href='add-category';
                </script>";
    }else{
        echo "<script>
                document.cookie = 'alert = 2;';
                window.location.href='add-category';
                </script>";
    }
}

if(isset($_POST['insertContent'])){
    $page_name=$_POST['page_name'];
    $section_name=$_POST['section_name'];
    $title=$_POST['title'];


    $image='';

    if (!empty($_FILES['image']['name'])){
        $RandomAccountNumber = mt_rand(1, 99999);
        $file_name = $RandomAccountNumber."_" . $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];

        $file_type = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        if (
            $file_type != "jpg" && $file_type != "png" && $file_type != "jpeg"
            && $file_type != "gif"
        ) {
            $attach_files = '';
        } else {
            move_uploaded_file($file_tmp, "../assets/images/content/" .$file_name);
            $image = "assets/images/content/" . $file_name;
        }
    }

    $description=$_POST['description'];
    $inserted_at=date('Y-m-d h:i:s');

    $insert = $db_handle->insertQuery("INSERT INTO `content`(`page_name`, `section_name`, `title`, `image`, `description`, `inserted_at`) VALUES ('$page_name','$section_name','$title','$image','$description','$inserted_at')");

    if($insert){
        echo "<script>
                document.cookie = 'alert = 1;';
                window.location.href='add-content';
                </script>";
    }else{
        echo "<script>
                document.cookie = 'alert = 2;';
                window.location.href='add-content';
                </script>";
    }
}

if(isset($_POST['insertProduct'])){
    $category_id=$_POST['category_id'];
    $subcategory_id=$_POST['subcategory_id'];
    $p_name=$_POST['p_name'];
    $p_price=$_POST['p_price'];
    $discount=$_POST['discount'];


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
        }
    }

    $description=$_POST['description'];

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
    }
    $extra_images_json = json_encode($extra_images);

    $inserted_at=date('Y-m-d h:i:s');

    $insert = $db_handle->insertQuery("INSERT INTO `product`(`category_id`, `subcategory_id`, `p_name`, `p_price`, `discount`,
                      `main_image`, `description`, `extra_image`, `inserted_at`) VALUES ('$category_id','$subcategory_id','$p_name',
                                                                                         '$p_price','$discount','$main_image','$description',
                                                                                         '$extra_images_json','$inserted_at')");

    if($insert){
        echo "<script>
                document.cookie = 'alert = 1;';
                window.location.href='add-product';
                </script>";
    }else{
        echo "<script>
                document.cookie = 'alert = 2;';
                window.location.href='add-product';
                </script>";
    }
}

if(isset($_POST['insertPromoCode'])){
    $name=$_POST['name'];
    $code=$_POST['code'];
    $amount=$_POST['amount'];
    $coupon_type=$_POST['coupon_type'];
    $minimum_purchase_amount=$_POST['minimum_purchase_amount'];
    $start_date=$_POST['start_date'];
    $expirey_date=$_POST['expirey_date'];
    $description=$_POST['description'];
    $inserted_at=date('Y-m-d h:i:s');

    $insert = $db_handle->insertQuery("INSERT INTO `promo_code`(`coupon_name`, `code`, `coupon_type`,`amount`, `start_date`, `expirey_date`, `minimum_order`, `description`, `inserted_at`) VALUES ('$name','$code','$coupon_type','$amount','$start_date','$expirey_date','$minimum_purchase_amount','$description','$inserted_at')");

    if($insert){
        echo "<script>
                document.cookie = 'alert = 1;';
                window.location.href='add-promo-code';
                </script>";
    }else{
        echo "<script>
                document.cookie = 'alert = 2;';
                window.location.href='add-promo-code';
                </script>";
    }
}

if(isset($_POST['insertStock'])){
    $product_id=$_POST['product_id'];
    $buying_price=$_POST['buying_price'];
    $quantity=$_POST['quantity'];
    $inserted_at=date('Y-m-d h:i:s');

    $insert = $db_handle->insertQuery("INSERT INTO `stock`(`product_id`, `buying_price`, `quantity`, `inserted_at`) 
VALUES ('$product_id','$buying_price','$quantity','$inserted_at')");

    if($insert){
        echo "<script>
                document.cookie = 'alert = 1;';
                window.location.href='add-stock';
                </script>";
    }else{
        echo "<script>
                document.cookie = 'alert = 2;';
                window.location.href='add-stock';
                </script>";
    }
}

if(isset($_POST['insertSubcategory'])){
    $category_id=$_POST['category_id'];
    $s_name=$_POST['s_name'];
    $inserted_at=date('Y-m-d h:i:s');

    $insert = $db_handle->insertQuery("INSERT INTO `subcategory`(`category_id`, `s_name`, `inserted_at`) 
VALUES ('$category_id','$s_name','$inserted_at')");

    if($insert){
        echo "<script>
                document.cookie = 'alert = 1;';
                window.location.href='add-subcategory';
                </script>";
    }else{
        echo "<script>
                document.cookie = 'alert = 2;';
                window.location.href='add-subcategory';
                </script>";
    }
}