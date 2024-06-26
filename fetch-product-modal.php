<?php
session_start();
require_once('include/dbController.php');
$db_handle = new DBController();
require_once('include/settings.php');
date_default_timezone_set("Asia/Hong_Kong");
require_once('include/cart-calculation.php');
$extension = '';
if (isset($_POST["id"])) {

    if(isset($_POST['extension'])){
        if ($_POST['extension'] == 1) {
            $extension = '../';
        } else if ($_POST['extension'] == 2) {
            $extension = '../../';
        }
    }

    $data = $db_handle->runQuery("SELECT * FROM category as c, subcategory as s, product as p where p.category_id=c.id and p.subcategory_id=s.id and p.id='{$_POST["id"]}'");
    ?>
    <div class="col-lg-6">
        <div class="slider-image">
            <img src="<?php echo $extension; ?><?php echo $data[0]['main_image']; ?>" class="img-fluid blur-up lazyload"
                 alt="">
        </div>
    </div>

    <div class="col-lg-6">
        <div class="right-sidebar-modal">
            <form action="?action=add" method="post">
                <input type="hidden" name="product_id" value="<?php echo $data[0]['id']; ?>" required>
                <h4 class="title-name"><?php echo $data[0]['p_name']; ?></h4>
                <h4 class="price"><?php echo $money_symbol; ?><?php echo $data[0]['p_price'] - $data[0]['discount']; ?></h4>
                <div class="product-detail">
                    <h4>Product Details :</h4>
                    <p>
                        <?php echo $data[0]['description']; ?>
                    </p>
                </div>
                <div class="cart_qty qty-box">
                    <div class="input-group bg-white">
                        <button type="button" class="qty-left-minus bg-gray" onclick="quantityCal('minus');">
                            <i class="fa fa-minus" aria-hidden="true"></i>
                        </button>
                        <input class="form-control input-number qty-input" type="text"
                               name="quantity" id="quantity" value="1" required>
                        <button type="button" class="qty-right-plus bg-gray" onclick="quantityCal('plus');">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
                <ul class="brand-list">
                    <li>
                        <div class="brand-box">
                            <h5>Category:</h5>
                            <h6><?php echo $data[0]['c_name']; ?></h6>
                        </div>
                    </li>

                    <li>
                        <div class="brand-box">
                            <h5>Subcategory:</h5>
                            <h6><?php echo $data[0]['s_name']; ?></h6>
                        </div>
                    </li>

                    <li>
                        <div class="brand-box">
                            <h5>Stock Left:</h5>
                            <h6>100</h6>
                        </div>
                    </li>
                </ul>
                <div class="modal-button">
                    <button class="btn btn-md add-cart-button icon" type="submit">
                        Add To Cart
                    </button>
                    <button type="button" onclick="location.href = '<?php echo $extension; ?>product/<?php echo str_replace(' ', '-',$data[0]['p_name']); ?>';"
                            class="btn theme-bg-color view-button icon text-white fw-bold btn-md">
                        View More Details
                    </button>
                </div>
            </form>
        </div>
    </div>
    <?php
}
?>