  <div id="myCarousel" class="carousel slide" data-ride="carousel" style="margin-top:-20px">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>
    <!-- Wrapper for slides -->
    <div class="carousel-inner" style="width:30%;margin:auto">
      <div class="item active">
        <img src="<?php echo bloginfo('template_directory') ?>/public/img/logo.png" alt="Los Angeles" style="width:100%;">
        <div class="carousel-caption" style="color:#000;top:-8%">
          <h3>G2 Shop</h3>
          <p>Welcome!</p>
        </div>
      </div>
      <?php 
      $products = getProduct();
      foreach ($products as $product) {
        ?>
        <div class="item" title="<?php echo $product->name?>">
        <img src="<?php echo get_the_post_thumbnail_url($product->id) ?>" alt="<?php echo $product->name?>" style="width:100%;">
        <div class="carousel-caption" style="color:#000;top:-8%">
          <h3><?php echo $product->name?></h3>
        </div>
      </div>
        <?php } ?>
    </div>
    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>