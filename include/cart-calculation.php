<?php
if (!empty($_GET["action"])) {
    switch ($_GET["action"]) {
        case "add":
            if (!empty($_POST["quantity"])) {

                $productByCode = $db_handle->runQuery("SELECT * FROM product WHERE id='" . $_POST["product_id"] . "'");
                $itemArray = array('PP' . $productByCode[0]["id"] => array('name' => $productByCode[0]["p_name"], 'image' => $productByCode[0]["main_image"], 'product_id' => 'PP' . $productByCode[0]["id"], 'quantity' => $_POST["quantity"], 'price' => $productByCode[0]["p_price"]));

                if (!empty($_SESSION["cart_item"])) {
                    if (in_array('PP' . $productByCode[0]["id"], array_keys($_SESSION["cart_item"]))) {
                        foreach ($_SESSION["cart_item"] as $k => $v) {
                            if ('PP' . $productByCode[0]["id"] == $k) {
                                if (empty($_SESSION["cart_item"][$k]["quantity"])) {
                                    $_SESSION["cart_item"][$k]["quantity"] = 0;
                                }
                                $_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
                            }
                        }
                    } else {
                        $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"], $itemArray);
                    }
                } else {
                    $_SESSION["cart_item"] = $itemArray;
                }

                echo "<script>
                const urlWithoutParams = window.location.origin + window.location.pathname;
                window.location.href = urlWithoutParams;  
                document.cookie = 'alert = 10;';
                </script>";

            }
            break;
        case "remove":
            if (!empty($_SESSION["cart_item"])) {
                foreach ($_SESSION["cart_item"] as $k => $v) {
                    if ($_GET["product_id"] == $k)
                        unset($_SESSION["cart_item"][$k]);
                    if (empty($_SESSION["cart_item"]))
                        unset($_SESSION["cart_item"]);
                }
            }
            break;
        case "update":
            if (!empty($_POST["quantity"]) && !empty($_POST["product_id"])) {
                // Loop through the submitted quantities and update the cart
                for ($i = 0; $i < count($_POST["product_id"]); $i++) {
                    $code = $_POST["product_id"][$i];
                    $quantity = $_POST["quantity"][$i];

                    // Ensure quantity is a positive integer
                    if (is_numeric($quantity) && $quantity > 0) {
                        if (isset($_SESSION["cart_item"][$code])) {
                            $_SESSION["cart_item"][$code]["quantity"] = $quantity;
                        }
                    }
                }
            }
            break;
        case "empty":
            unset($_SESSION["cart_item"]);
            break;
    }
}

$total_quantity = 0;
$total_price = 0;
if (isset($_SESSION["cart_item"])) {
    foreach ($_SESSION["cart_item"] as $item) {
        $item_price = $item["quantity"] * $item["price"];
        $total_quantity += $item["quantity"];
        $total_price += ($item["price"] * $item["quantity"]);
    }
}
?>