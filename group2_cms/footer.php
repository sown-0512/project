<footer id="footer">
  <div class="footer-contact" style="background: url('<?php echo bloginfo('template_directory') ?>/public/img/footer.png');;">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 footer-logo">
          <a href="<?php echo esc_url(home_url()) ?>">
          <?php
          if (has_custom_logo()) {
            echo '<img src="' . esc_url(get_link_custom_logo()) . '" alt="' . get_bloginfo('name') . '" class="img-fluid"> ';
          } else {?>
            <img src="<?php echo bloginfo('template_directory') ?>/public/img/logo_transparent.png" alt="logoFooter" class="img-fluid">
          <?php }?>
          </a>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-8 contact">
          <div class="row">
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 ">
              <h6 class="footer-title">HỖ TRỢ KHÁCH HÀNG</h6>
              <li><a href="<?php echo esc_url(home_url()) ?>">Trang chủ</a></li>
              <li><a href="<?php echo esc_url( get_permalink( get_page_by_path( 'tat-ca-san-pham' ) ) )?>">Sản phẩm</a></li>
              <li><a href="<?php echo esc_url( get_permalink( get_page_by_path( 'contact' ) ) )?>">liên hệ</a></li>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
              <h6>THÔNG TIN</h6>
              <li><a href="#" onclick="updatingLinkPage();">Hướng dẫn mua hàng</a></li>
              <li><a href="#" onclick="updatingLinkPage();">Hình thức thanh toán</a></li>
              <li><a href="#" onclick="updatingLinkPage();">Chính sách bảo mật thông tin</a></li>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
              <h6>KẾT NỐI VỚI CHÚNG TÔI</h6>
              <a href="#" onclick="updatingLinkPage();"><i class="fab fa-facebook-f"></i></a>
              <img src="<?php echo bloginfo('template_directory') ?>/public/img/payment.png" alt="payment" class="img-fluid payment-logo">
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="footer-author">
      <span>Copyright &copy; 2020 G2 SHOP </span>
    </div>
  </div>
</footer>
<script>
  function updatingLinkPage() {
    alert('Chúng tôi đang cập nhật trang này sớm nhất có thể');
    return false;
  }
</script>
<script src="<?php echo bloginfo('template_directory') ?>/public/js/jquery.min.js"></script>
    <script src="<?php echo bloginfo('template_directory') ?>/public/js/bootstrap.min.js"></script>
    <script src="<?php echo bloginfo('template_directory') ?>/public/js/login.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    
</body>

</html>