<?php
/* Template Name: G2-All-Product */
get_header();
?>

<div class="all_product">
    <div class="container">
        <h2 class="products_title">
            <?php echo get_the_title() . ':' ?>
        </h2>
        <div class="products_content">
            <?php
            echo do_shortcode('[products columns=4 paginate=true order=ASC per_page=8]')
            ?>
        </div>
    </div>
</div>

<?php
get_footer();
