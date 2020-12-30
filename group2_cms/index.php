<?php
get_header();
?>

<!-- content project -->
<div class="main">
    <!-- slide show  -->
    <div class="slide">
        <?php
        get_template_part('template-parts/content/content')
        ?>
    </div>

    <!-- Lấy 6 sp theo danh mục -->
    <div class="content" style="margin-top:20px;">
        <?php
        getHtmlProductByCategory('Áo');

        getHtmlProductByCategory('Giày');
        ?>
    </div>

</div>
<!-- end content -->

<?php
get_footer();
?>