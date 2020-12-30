<?php
$product = wc_get_product(get_the_ID());
?>
<section class="u-clearfix u-section-2" id="sec-9bc7">
    <div class="u-clearfix u-sheet u-valign-middle-lg u-sheet-1">
        <div class="u-container-style u-expanded-width u-product u-product-1">
            <div class="u-container-layout u-valign-top-md u-valign-top-sm u-valign-top-xs u-container-layout-1">
                <!--product_image-->
                <img alt="" class="u-image u-image-default u-product-control u-image-1" src="<?php echo get_the_post_thumbnail_url(); ?>">
                <!--/product_image-->
                <div class="u-align-left u-container-style u-expanded-width-md u-expanded-width-sm u-expanded-width-xs u-group u-shape-rectangle u-group-1">
                    <div class="u-container-layout u-valign-middle-lg u-valign-middle-xl u-container-layout-2">
                        <!--product_title-->
                        <h2 class="u-product-control u-text u-text-1">
                            <div class="u-product-title-link" style="font-weight:450;text-transform: capitalize">
                                <?php echo $product->name ?>
                            </div>
                        </h2>
                        <!--product_price-->
                        <div class="u-product-control u-product-price u-product-price-1">
                            <div class="u-price-wrapper u-spacing-10">
                                <!--product_regular_price-->
                                <?php
                                if ($product->sale_price > 0) {
                                ?>
                                    <div class="u-price u-text-palette-2-base" style="font-size: 1.5rem; font-weight: 700;text-decoration: line-through;color:#8a8686!important">
                                        <!--product_regular_price_content--><?php echo number_format_i18n($product->regular_price) ?>đ
                                        <!--/product_regular_price_content-->
                                    </div>
                                    <div class="u-price u-text-palette-2-base" style="font-size: 1.5rem; font-weight: 700;">
                                        <!--product_regular_price_content--><?php echo number_format_i18n($product->sale_price) ?>đ
                                        <!--/product_regular_price_content-->
                                    </div>
                                <?php
                                } else {
                                ?>
                                    <div class="u-price u-text-palette-2-base" style="font-size: 1.5rem; font-weight: 700;">
                                        <!--product_regular_price_content--><?php echo number_format_i18n($product->regular_price) ?>đ
                                        <!--/product_regular_price_content-->
                                    </div>
                                <?php
                                }
                                ?>
                                <!--/product_regular_price-->
                            </div>
                        </div>
                        <!--/product_price-->
                        <div class="u-border-3 u-border-grey-dark-1 u-line u-line-horizontal u-line-1"></div>
                        <form action="" method="POST" id="formCart">
                            <label for="qty">Số lượng mua:</label>
                            <input type="hidden" name="productId" value="<?php echo $product->id ?>">
                            <input type="number" name="qty" id="qty" min="1" max="50" value="1" class="form-control" style="width:30%">
                        </form>
                        <a href="<?php echo do_shortcode('[add_to_cart_url id="' . $id . '"]') ?>" class="u-black u-border-2 u-border-grey-75 u-btn u-button-style u-hover-grey-75 u-product-control u-btn-1">Thêm vào giỏ hàng</a>
                        <!--/product_button-->
                    </div>
                </div>
                <div class="desc">
                    <h5>Thông tin sản phẩm</h5>
                    <div class="u-border-3 u-border-grey-dark-1 u-line u-line-horizontal u-line-1"></div>
                    <p>
                        <?php
                        echo $product->description ?>
                    </p>
                </div>
            </div>
        </div>
        <!--/product_item-->
        <!--/product-->
    </div>
</section>