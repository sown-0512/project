<?php
$cat_slug = getCatSlugById(get_queried_object_id());
?>
<div class="cate_product">
<div class="container">
    <h2 class="products_title">
		<?php the_archive_title() ?>
	</h2>
    <div class="products_content">
        <?php
	   echo do_shortcode('[product_category category='.$cat_slug.' per_page=5 
	   columns=4 orderby=date order=desc paginate=true]')
		?>
	</div>
</div>
</div>

