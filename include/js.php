<!-- Bg overlay Start -->
<div class="bg-overlay"></div>
<!-- Bg overlay End -->

<!-- latest jquery-->
<script src="<?php echo $extension; ?>assets/js/jquery-3.6.0.min.js"></script>

<!-- jquery ui-->
<script src="<?php echo $extension; ?>assets/js/jquery-ui.min.js"></script>

<!-- Bootstrap js-->
<script src="<?php echo $extension; ?>assets/js/bootstrap/bootstrap.bundle.min.js"></script>
<script src="<?php echo $extension; ?>assets/js/bootstrap/bootstrap-notify.min.js"></script>
<script src="<?php echo $extension; ?>assets/js/bootstrap/popper.min.js"></script>

<!-- feather icon js-->
<script src="<?php echo $extension; ?>assets/js/feather/feather.min.js"></script>
<script src="<?php echo $extension; ?>assets/js/feather/feather-icon.js"></script>

<!-- Lazyload Js -->
<script src="<?php echo $extension; ?>assets/js/lazysizes.min.js"></script>

<!-- Slick js-->
<script src="<?php echo $extension; ?>assets/js/slick/slick.js"></script>
<script src="<?php echo $extension; ?>assets/js/slick/slick-animation.min.js"></script>
<script src="<?php echo $extension; ?>assets/js/slick/custom_slick.js"></script>

<!-- Auto Height Js -->
<script src="<?php echo $extension; ?>assets/js/auto-height.js"></script>

<!-- Fly Cart Js -->
<script src="<?php echo $extension; ?>assets/js/fly-cart.js"></script>

<!-- Quantity js -->
<script src="<?php echo $extension; ?>assets/js/quantity-2.js"></script>

<!-- WOW js -->
<script src="<?php echo $extension; ?>assets/js/wow.min.js"></script>
<script src="<?php echo $extension; ?>assets/js/custom-wow.js"></script>

<!-- script js -->
<script src="<?php echo $extension; ?>assets/js/script.js"></script>

<script>
    function quantityCal(operator) {
        let quantity = document.getElementById('quantity');
        let quan = parseInt(quantity.value);

        if (operator === 'plus') {
            quan += 1;
        } else {
            if (quan > 1) {
                quan -= 1;
            }
        }
        quantity.value = quan
    }
</script>
