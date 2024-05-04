<?php
session_start();
require_once('include/dbController.php');
$db_handle = new DBController();
require_once('include/settings.php');
date_default_timezone_set("Asia/Hong_Kong");
require_once('include/cart-calculation.php');
$extension = '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo $site_name; ?>">
    <meta name="keywords" content="<?php echo $site_name; ?>">
    <meta name="author" content="<?php echo $site_name; ?>">
    <link rel="icon" href="<?php echo $extension; ?>assets/images/favicon/1.png" type="image/x-icon">
    <title>Checkout | <?php echo $site_name; ?></title>

    <?php include('include/css.php'); ?>
</head>

<body>

<?php include('include/header.php'); ?>

<!-- Breadcrumb Section Start -->
<section class="breadscrumb-section pt-0">
    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-12">
                <div class="breadscrumb-contain">
                    <h2>Checkout</h2>
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                                <a href="<?php echo $extension; ?>home">
                                    <i class="fa-solid fa-house"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Checkout section Start -->
<section class="checkout-section-2 section-b-space">
    <div class="container-fluid-lg">
        <div class="row g-sm-4 g-3">
            <div class="col-lg-8">
                <div class="left-sidebar-checkout">
                    <div class="checkout-detail-box">
                        <ul>
                            <li>
                                <div class="checkout-icon">
                                    <lord-icon target=".nav-item" src="https://cdn.lordicon.com/ggihhudh.json"
                                               trigger="loop-on-hover"
                                               colors="primary:#121331,secondary:#646e78,tertiary:#0baf9a"
                                               class="lord-icon">
                                    </lord-icon>
                                </div>
                                <div class="checkout-box">
                                    <div class="checkout-title">
                                        <h4>Delivery Address</h4>
                                    </div>

                                    <div class="checkout-detail">
                                        <div class="row g-4">
                                            <div class="col-xxl-6 col-lg-12 col-md-6">
                                                <div class="delivery-address-box">
                                                    <div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="jack"
                                                                   id="flexRadioDefault1">
                                                        </div>

                                                        <div class="label">
                                                            <label>Home</label>
                                                        </div>

                                                        <ul class="delivery-address-detail">
                                                            <li>
                                                                <h4 class="fw-500">Jack Jennas</h4>
                                                            </li>

                                                            <li>
                                                                <p class="text-content"><span
                                                                            class="text-title">Address
                                                                            : </span>8424 James Lane South San
                                                                    Francisco, CA 94080</p>
                                                            </li>

                                                            <li>
                                                                <h6 class="text-content"><span
                                                                            class="text-title">Pin Code
                                                                            :</span> +380</h6>
                                                            </li>

                                                            <li>
                                                                <h6 class="text-content mb-0"><span
                                                                            class="text-title">Phone
                                                                            :</span> + 380 (0564) 53 - 29 - 68</h6>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xxl-6 col-lg-12 col-md-6">
                                                <div class="delivery-address-box">
                                                    <div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="jack"
                                                                   id="flexRadioDefault2" checked="checked">
                                                        </div>

                                                        <div class="label">
                                                            <label>Office</label>
                                                        </div>

                                                        <ul class="delivery-address-detail">
                                                            <li>
                                                                <h4 class="fw-500">Jack Jennas</h4>
                                                            </li>

                                                            <li>
                                                                <p class="text-content"><span
                                                                            class="text-title">Address
                                                                            :</span>Nakhimovskiy R-N / Lastovaya Ul.,
                                                                    bld. 5/A, appt. 12
                                                                </p>
                                                            </li>

                                                            <li>
                                                                <h6 class="text-content"><span
                                                                            class="text-title">Pin Code :</span>
                                                                    +380</h6>
                                                            </li>

                                                            <li>
                                                                <h6 class="text-content mb-0"><span
                                                                            class="text-title">Phone
                                                                            :</span> + 380 (0564) 53 - 29 - 68</h6>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li>
                                <div class="checkout-icon">
                                    <lord-icon target=".nav-item" src="https://cdn.lordicon.com/oaflahpk.json"
                                               trigger="loop-on-hover" colors="primary:#0baf9a" class="lord-icon">
                                    </lord-icon>
                                </div>
                                <div class="checkout-box">
                                    <div class="checkout-title">
                                        <h4>Delivery Option</h4>
                                    </div>

                                    <div class="checkout-detail">
                                        <div class="row g-4">
                                            <div class="col-xxl-6">
                                                <div class="delivery-option">
                                                    <div class="delivery-category">
                                                        <div class="shipment-detail">
                                                            <div
                                                                    class="form-check custom-form-check hide-check-box">
                                                                <input class="form-check-input" type="radio"
                                                                       name="standard" id="standard" checked>
                                                                <label class="form-check-label"
                                                                       for="standard">Standard
                                                                    Delivery Option</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xxl-6">
                                                <div class="delivery-option">
                                                    <div class="delivery-category">
                                                        <div class="shipment-detail">
                                                            <div
                                                                    class="form-check mb-0 custom-form-check show-box-checked">
                                                                <input class="form-check-input" type="radio"
                                                                       name="standard" id="future">
                                                                <label class="form-check-label" for="future">Future
                                                                    Delivery Option</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12 future-box">
                                                <div class="future-option">
                                                    <div class="row g-md-0 gy-4">
                                                        <div class="col-md-6">
                                                            <div class="delivery-items">
                                                                <div>
                                                                    <h5 class="items text-content"><span>3
                                                                                Items</span>@
                                                                        $693.48</h5>
                                                                    <h5 class="charge text-content">Delivery Charge
                                                                        $34.67
                                                                        <button type="button" class="btn p-0"
                                                                                data-bs-toggle="tooltip"
                                                                                data-bs-placement="top"
                                                                                title="Extra Charge">
                                                                            <i
                                                                                    class="fa-solid fa-circle-exclamation"></i>
                                                                        </button>
                                                                    </h5>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <form
                                                                    class="form-floating theme-form-floating date-box">
                                                                <input type="date" class="form-control">
                                                                <label>Select Date</label>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li>
                                <div class="checkout-icon">
                                    <lord-icon target=".nav-item" src="https://cdn.lordicon.com/qmcsqnle.json"
                                               trigger="loop-on-hover" colors="primary:#0baf9a,secondary:#0baf9a"
                                               class="lord-icon">
                                    </lord-icon>
                                </div>
                                <div class="checkout-box">
                                    <div class="checkout-title">
                                        <h4>Payment Option</h4>
                                    </div>

                                    <div class="checkout-detail">
                                        <div class="accordion accordion-flush custom-accordion"
                                             id="accordionFlushExample">
                                            <div class="accordion-item">
                                                <div class="accordion-header" id="flush-headingFour">
                                                    <div class="accordion-button collapsed"
                                                         data-bs-toggle="collapse"
                                                         data-bs-target="#flush-collapseFour">
                                                        <div class="custom-form-check form-check mb-0">
                                                            <label class="form-check-label" for="cash"><input
                                                                        class="form-check-input mt-0" type="radio"
                                                                        name="flexRadioDefault" id="cash" checked> Cash
                                                                On Delivery</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="flush-collapseFour"
                                                     class="accordion-collapse collapse show"
                                                     data-bs-parent="#accordionFlushExample">
                                                    <div class="accordion-body">
                                                        <p class="cod-review">Pay digitally with SMS Pay
                                                            Link. Cash may not be accepted in COVID restricted
                                                            areas. <a href="javascript:void(0)">Know more.</a>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="right-side-summery-box">
                    <div class="summery-box-2">
                        <div class="summery-header">
                            <h3>Order Summery</h3>
                        </div>

                        <ul class="summery-contain">
                            <?php
                            $total_quantity_new = 0;
                            $total_price_new = 0;
                            if (isset($_SESSION["cart_item"])) {
                                foreach ($_SESSION["cart_item"] as $item) {
                                    $item_price = $item["quantity"] * $item["price"];
                                    ?>
                                    <li>
                                        <img src="<?php echo $extension; ?><?php echo $item["image"]; ?>"
                                             class="img-fluid blur-up lazyloaded checkout-image" alt="">
                                        <h4><?php echo $item["name"]; ?> <span>X <?php echo $item["quantity"]; ?></span></h4>
                                        <h4 class="price"><?php echo $money_symbol . number_format($item_price, 2); ?></h4>
                                    </li>
                                    <?php
                                    $total_quantity_new += $item["quantity"];
                                    $total_price_new += ($item["price"] * $item["quantity"]);
                                }

                            }
                            ?>
                        </ul>

                        <ul class="summery-total">
                            <li>
                                <h4>Subtotal</h4>
                                <h4 class="price">$111.81</h4>
                            </li>

                            <li>
                                <h4>Shipping</h4>
                                <h4 class="price">$8.90</h4>
                            </li>

                            <li>
                                <h4>Tax</h4>
                                <h4 class="price">$29.498</h4>
                            </li>

                            <li>
                                <h4>Coupon/Code</h4>
                                <h4 class="price">$-23.10</h4>
                            </li>

                            <li class="list-total">
                                <h4>Total (USD)</h4>
                                <h4 class="price">$19.28</h4>
                            </li>
                        </ul>
                    </div>

                    <div class="checkout-offer">
                        <div class="offer-title">
                            <div class="offer-icon">
                                <img src="https://themes.pixelstrap.com/fastkart/assets/images/inner-page/offer.svg"
                                     class="img-fluid" alt="">
                            </div>
                            <div class="offer-name">
                                <h6>Available Offers</h6>
                            </div>
                        </div>

                        <ul class="offer-detail">
                            <li>
                                <p>Combo: BB Royal Almond/Badam Californian, Extra Bold 100 gm...</p>
                            </li>
                            <li>
                                <p>combo: Royal Cashew Californian, Extra Bold 100 gm + BB Royal Honey 500 gm</p>
                            </li>
                        </ul>
                    </div>

                    <button class="btn theme-bg-color text-white btn-md w-100 mt-4 fw-bold">Place Order</button>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Checkout section End -->

<?php include('include/footer.php'); ?>

<!-- Add address modal box start -->
<div class="modal fade theme-modal" id="add-address" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Add a new address</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-floating mb-4 theme-form-floating">
                        <input type="text" class="form-control" id="fname" placeholder="Enter First Name">
                        <label for="fname">First Name</label>
                    </div>
                </form>

                <form>
                    <div class="form-floating mb-4 theme-form-floating">
                        <input type="text" class="form-control" id="lname" placeholder="Enter Last Name">
                        <label for="lname">Last Name</label>
                    </div>
                </form>

                <form>
                    <div class="form-floating mb-4 theme-form-floating">
                        <input type="email" class="form-control" id="email" placeholder="Enter Email Address">
                        <label for="email">Email Address</label>
                    </div>
                </form>

                <form>
                    <div class="form-floating mb-4 theme-form-floating">
                            <textarea class="form-control" placeholder="Leave a comment here" id="address"
                                      style="height: 100px"></textarea>
                        <label for="address">Enter Address</label>
                    </div>
                </form>

                <form>
                    <div class="form-floating mb-4 theme-form-floating">
                        <input type="email" class="form-control" id="pin" placeholder="Enter Pin Code">
                        <label for="pin">Pin Code</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-md" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn theme-bg-color btn-md text-white" data-bs-dismiss="modal">Save
                    changes
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Add address modal box end -->

<!-- Bg overlay Start -->
<div class="bg-overlay"></div>
<!-- Bg overlay End -->

<?php include('include/js.php'); ?>
</body>
</html>
