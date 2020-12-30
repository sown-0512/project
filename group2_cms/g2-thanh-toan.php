<?php
/* Template Name: G2-Thanh-Toan */
get_header();
?>
<div class="cart_checkout">
    <div class="container">
        <?php echo do_shortcode('[woocommerce_checkout]') ?>
    </div>
</div>
<?php
get_footer();
