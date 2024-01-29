<?php
session_start();
require_once("include/dbcontroller.php");
$db_handle = new DBController();
if (isset($_POST["id"])) {
    $data = $db_handle->runQuery("SELECT * FROM product where id='{$_POST["id"]}'");
    ?>
    <div class="col-lg-6">
        <div class="slider-image">
            <img src="<?php echo $data[0]['main_image']; ?>" class="img-fluid blur-up lazyload"
                 alt="">
        </div>
    </div>

    <div class="col-lg-6">
        <div class="right-sidebar-modal">
            <h4 class="title-name"><?php echo $data[0]['p_name']; ?></h4>
            <h4 class="price">$<?php echo $data[0]['p_price'] - $data[0]['discount']; ?></h4>

            <div class="product-detail">
                <h4>Product Details :</h4>
                <p>
                    <?php echo $data[0]['description']; ?>
                </p>
            </div>

            <ul class="brand-list">
                <li>
                    <div class="brand-box">
                        <h5>Category:</h5>
                        <h6>Black Forest</h6>
                    </div>
                </li>

                <li>
                    <div class="brand-box">
                        <h5>Subcategory:</h5>
                        <h6>W0690034</h6>
                    </div>
                </li>

                <li>
                    <div class="brand-box">
                        <h5>Product Type:</h5>
                        <h6>White Cream Cake</h6>
                    </div>
                </li>
            </ul>
            <div class="modal-button">
                <button onclick="location.href = 'cart.html';"
                        class="btn btn-md add-cart-button icon">Add
                    To Cart
                </button>
                <button onclick="location.href = 'product-left.html';"
                        class="btn theme-bg-color view-button icon text-white fw-bold btn-md">
                    View More Details
                </button>
            </div>
        </div>
    </div>
    <?php
}
?>