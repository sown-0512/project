<?php

#########=========THEME======#########

use PHPMailer\PHPMailer\PHPMailer;

/**
 * thông báo thành công
 */
function g2_alert_success($msg)
{
	echo '<div class="alert alert-success alert-dismissible" id="alert-success">
  <a href="#" class="close" data-dismiss="alert" aria-label="close" onclick="close_success()">&times;</a>
  <strong>Success! </strong>' . $msg . '
</div>
';
?>
	<script>
		function close_success() {
			document.getElementById('alert-success').style.display = "none";
		}
	</script>
<?php
}

/**
 * thông báo lỗi
 */
function g2_alert_error($msg)
{
	echo '<div class="alert alert-danger alert-dismissible" id="alert-danger">
  <a href="#" class="close" data-dismiss="alert" aria-label="close" onclick="close_danger()">&times;</a>
  <strong>Error! </strong>' . $msg . '
</div>
';
?>
	<script>
		function close_danger() {
			document.getElementById('alert-danger').style.display = "none";
		}
	</script>
<?php
}

/**
 * Khởi tạo hàm custom logo
 *
 * Thêm lựa chọn vào theme trên wp-admin (website)
 */
function themename_custom_logo_setup()
{
	$defaults = array(
		'height'      => 70,
		'width'       => 70,
		'flex-height' => true,
		'flex-width'  => true,
		'header-text' => array('site-title', 'site-description'),
		'unlink-homepage-logo' => true,
	);
	add_theme_support('custom-logo', $defaults);
}
add_action('after_setup_theme', 'themename_custom_logo_setup');

/**
 * Khởi tạo hàm trả về giá trị là đường dẫn logo
 *
 * Đường link sẽ lấy theo url
 */
function get_link_custom_logo()
{
	$custom_logo_id = get_theme_mod('custom_logo');
	$logo = wp_get_attachment_image_src($custom_logo_id, 'full');
	return $logo[0];
}

#########=========PRODUCT======#########

/**
 * Hàm lấy toàn bộ danh mục sản phẩm
 *
 * Danh mục ít nhất 1 sản phẩm 
 */
function get_category_wc()
{
	$categories = get_terms(['taxonomy' => 'product_cat']);
	return $categories;
}

/**
 * Hàm lấy 10 sản phẩm
 * 
 * Số lượng sản phẩm là 
 */
function getProduct()
{
	$args = array(
		'status' => 'publish',
		'numberposts' => 10,
	);
	$products = wc_get_products($args);
	return $products;
}

/**
 * Hàm lấy slug danh mục theo id
 *
 */
function getCatSlugById($cat_id)
{
	$term = get_term_by('id', $cat_id, 'product_cat', 'ARRAY_A');
	return $term['slug'];
}


add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');
function woocommerce_header_add_to_cart_fragment($fragments)
{
	global $woocommerce;
	ob_start();
?>

	<a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>"><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count); ?> - <?php echo $woocommerce->cart->get_cart_total(); ?></a>

<?php

	$fragments['a.cart-contents'] = ob_get_clean();

	return $fragments;
}
/**
 * Hàm lấy sản phẩm theo danh mục
 *
 * Danh mục ở đây là nhập vào để hiển thị ra giao diện chính (Home)
 * Số lượng sản phẩm là 6
 */
function getProductByCategory($category)
{
	$args = array(
		'post_type' => 'product',
		'category' => array($category),
		'orderby'  => 'name',
		'numberposts' => 6,
	);
	$products = wc_get_products($args);
	return $products;
}

/**
 * Hàm tính phần trăm giảm giá của sản phẩm
 *
 */
function getSale($price, $sale_price)
{
	$sale = 100 - ((intval($sale_price) * 100) / intval($price));
	return intval($sale);
}

function getHtmlProducts($product)
{
	echo '<a href="' . esc_url(get_post_permalink($product->id, false, false)) . '">
			<div class="el-wrapper" title="' .  $product->name . '">
				<div class="box-up">
					<img class="img" src="' .  get_the_post_thumbnail_url($product->id) . '" alt="">
					<div class="img-info">
						<div class="info-inner">';
	if ($product->sale_price > 0) {
		echo '<span class="p-sale"> <span class="sale">Sale</span> ' .  getSale($product->regular_price, $product->sale_price) . ' %</span>';
	}
	echo '<span class="p-name">' .  $product->name . '</span>
									</div>
								</div>
							</div>
							<div class="box-down">
								<div class="h-bg">
									<div class="h-bg-inner"></div>
								</div>';
	if ($product->sale_price > 0) {
		echo '<a class="shop-cart" href="#">
										<span class="price" style="left:25%"><s style="color:#818181;left:15%">' .  number_format_i18n($product->regular_price) . ' đ</s></span>
										<span class="price-sale" style="left:65%">' .  number_format_i18n($product->sale_price) . ' đ</span>
										<span class="add-to-shop-cart">
											<span class="txt">Thêm vào giỏ hàng</span>
										</span>
									</a>';
	} else {
		echo '<a class="shop-cart" href="#">
										<span class="price">' .  number_format_i18n($product->price) . ' đ</span>
										<span class="add-to-shop-cart">
											<span class="txt">Thêm vào giỏ hàng</span>
										</span>
									</a>';
	}
	echo '</div>
									</div>
								</a>
							';
}
/**
 * Xuất ra html của 6 sản phẩm theo danh mục
 *
 * Giá trị là tên của danh mục
 */
function getHtmlProductByCategory($category)
{
	echo '<div class="container page-wrapper">
    <div class="page-inner">
        <div class="heading_hotdeal">
            <h2 class="title-head" title="' .  $category . '">
                <a href="">' . $category . ' Mới Nhất</a>
            </h2>
        </div>
		<div class="row">';
	$products = getProductByCategory($category);
	foreach ($products as $product) {
		echo '<a href="' . esc_url(get_post_permalink($product->id, false, false)) . '">
			<div class="el-wrapper" title="' .  $product->name . '">
				<div class="box-up">
					<img class="img" src="' .  get_the_post_thumbnail_url($product->id) . '" alt="">
					<div class="img-info">
						<div class="info-inner">';
		if ($product->sale_price > 0) {
			echo '<span class="p-sale"> <span class="sale">Sale</span> ' .  getSale($product->regular_price, $product->sale_price) . ' %</span>';
		}
		echo '<span class="p-name">' .  $product->name . '</span>
									</div>
								</div>
							</div>
							<div class="box-down">
								<div class="h-bg">
									<div class="h-bg-inner"></div>
								</div>';
		if ($product->sale_price > 0) {
			echo '<a class="shop-cart" href="' . esc_url(get_post_permalink($product->id, false, false)) . '">
					<span class="price" style="left:25%"><s style="color:#818181;left:15%">' .  number_format_i18n($product->regular_price) . ' đ</s></span>
					<span class="price-sale" style="left:65%">' .  number_format_i18n($product->sale_price) . ' đ</span>
					<span class="add-to-shop-cart">
						<span class="txt">Thêm vào giỏ hàng</span>
					</span>
				</a>';
		} else {
			echo '<a class="shop-cart" href="' . do_shortcode('[add_to_cart_url id="' . $product->id . '"]') . '">
										<span class="price">' .  number_format_i18n($product->price) . ' đ</span>
										<span class="add-to-shop-cart">
											<span class="txt">Thêm vào giỏ hàng</span>
										</span>
									</a>';
		}
		echo '</div>
									</div>
								</a>
							';
	}
	echo '
						</div>
					</div>
				</div>';
}

#########=========DATABASE======#########
/**
 * lấy thời gian ngày-tháng-năm giờ-phút-giây
 * 
 * Hồ Chí Minh City
 */

function getTimeNow()
{
	date_default_timezone_set('asia/ho_chi_minh');
	$getTime = date("d-m-Y H:i:s");
	return $getTime;
}

/**
 * Thêm thông tin vào bảng trong db
 * 
 * Tên bảng, dữ liệu cần thêm
 */
function g2_insert_db($table_name, $data)
{
	global $wpdb;
	$table = $wpdb->prefix . $table_name;
	$wpdb->insert(
		$table,
		$data
	);
	$fl = $wpdb->insertId;
}

/**
 * Cập nhật thông tin vào bảng trong db
 * 
 * Tên bảng, dữ liệu cần cập nhật, cập nhật ở đâu
 */
function g2_update_db($table_name, $data, $where)
{
	global $wpdb;
	$table = $wpdb->prefix . $table_name;
	$wpdb->update(
		$table,
		$data,
		$where
	);
}
/**
 * Lấy thông tin của 1 bảng trong db
 * 
 * Tên bảng
 */
function g2_get_db($table_name)
{
	global $wpdb;
	$table = $wpdb->prefix . $table_name;
	$sql = "SELECT * FROM $table";
	$results = $wpdb->get_results($sql);
	return $results;
}

/**
 * Lấy thông tin của 1 cột trong 1 bảng db
 * 
 * Tên bảng, Id của cột cần lấy
 */
function g2_get_row_db($table_name, $id)
{
	global $wpdb;
	$table = $wpdb->prefix . $table_name;
	$sql = "SELECT * FROM $table WHERE `id` = '$id' ";
	$results = $wpdb->get_results($sql);
	return $results;
}

#########=========ACCOUNT======#########

/**
 * tạo db cho người dùng
 *
 * Thuộc tính của một user
 */
function g2_create_db_users()
{
	global $wpdb;
	$charset_collate = $wpdb->get_charset_collate();
	$table_name = $wpdb->prefix . "g2_users";

	$sql = "CREATE TABLE IF NOT EXISTS {$table_name} (
  	id int(11) NOT NULL AUTO_INCREMENT COMMENT 'auto',
	user varchar(64) DEFAULT NULL ,
    password varchar(64) DEFAULT NULL,
	email varchar(64) DEFAULT NULL,
	phone varchar(15) DEFAULT NULL,
	avatar varchar(254) DEFAULT NULL,
    register_time varchar(64) COMMENT '(dd/mm/yy-h:m:s)',
	sex int(1) DEFAULT 0 COMMENT '0: Nam / 1: Nữ / 2: Khác',
	user_type int(1) DEFAULT 1 COMMENT '0: Admin / 1: user',
		PRIMARY KEY (id)
	) $charset_collate;";

	if (!function_exists('dbDelta')) {
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	}
	dbDelta($sql);
}
add_action('init', 'g2_create_db_users');
function g2_activate_create_db()
{
	g2_create_db_users();
	// Clear the permalinks after the post type has been registered.
	flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'g2_activate_create_db');



/**
 * Kiểm tra tài khoản có trong db hay chưa
 *
 * 1: Có
 * 
 * 0: Chưa có
 */
function g2_check_user($userName)
{
	$check_user = 0;
	$g2_users = array();

	$g2_users = g2_get_db("g2_users");
	foreach ($g2_users as $user) {
		if ($user->user == $userName) {
			$check_user = 1;
		}
	}
	return $check_user;
}

/**
 * Kiểm tra password
 *
 * 1: giống 
 * 
 * 0: Sai
 */
function g2_check_password($password)
{
	$check_pass = 0;
	$g2_users = array();

	$g2_users = g2_get_db("g2_users");
	foreach ($g2_users as $user) {
		if ($user->password == md5($password)) {
			$check_pass = 1;
		}
	}
	return $check_pass;
}

/**
 * Tạo class để xuất lấy từng thông tin của user
 */
class User
{
	public $id;
	public $user;
	public $password;
	public $email;
	public $phone;
	public $sex;
	public $user_type;
	public $avatar;
	public $create_time;

	/**
	 * Truyền vào tên user để kiểm tra user tồn tại hay không
	 */
	function setUser($user)
	{
		if (g2_check_user($user) == 1) {
			$this->user = $user;
		}
	}

	/**
	 * Truyền giá trị filter cần lấy của tài khoản đó
	 * 
	 * * 
	 *  id;
	 * * 
	 *	user;
	 * * 
	 *	password;
	 * * 
	 *	email;
	 * * 
	 *	phone;
	 * * 
	 *	sex;
	 * * 
	 *	user_type;
	 * * 
	 *	avatar;
	 * * 
	 *	create_time;
	 */
	function getFilter($filter)
	{
		if ($this->user != "") {
			$g2_users = g2_get_db("g2_users");
			foreach ($g2_users as $user) {
				if ($user->user == $this->user) {
					$this->$filter = $user->$filter;
				}
			}
			return $this->$filter;
		} else {
			return "Không tồn tại tài khoản";
		}
	}
}
/**
 * Đăng ký tài khoản
 *
 * thời gian khởi tạo là thời gian đăng ký thành công
 * gmt +7 / tp hồ chí minh
 */

function g2_register_account($re_user, $re_pass)
{
	$data = array(
		'user' => $re_user,
		'password' => md5($re_pass),
		'register_time' => getTimeNow(),
		'avatar' => 'http://localhost/wordpress/wp-content/uploads/2020/11/defaul-avatar.png',
	);
	g2_insert_db("g2_users", $data);
}

if ($_POST['register'] === "Đăng Ký") {
	if ($_POST['userRegister'] != '' || $_POST['passRegister'] != '') {
		$re_user = $_POST['userRegister'];
		$re_pass = $_POST['passRegister'];
		$check_user = g2_check_user($re_user);
		if ($check_user == 1) {
			if (!isset($_COOKIE['userName'])) {
				if (!isset($_COOKIE['re_false'])) {
					g2_alert_error('Đã có tài khoản');
					$_COOKIE['re_false'] = $re_user;
					setcookie("re_false", $re_user, time() + (WEEK_IN_SECONDS), COOKIEPATH, COOKIE_DOMAIN);
				}
			}
		} else {
			g2_register_account($re_user, $re_pass);

			if (!isset($_COOKIE['userName'])) {
				g2_alert_success('Tạo tài khoản thành công');
				unset($_COOKIE['re_false']);
				setcookie("re_false", '', 0, COOKIEPATH, COOKIE_DOMAIN);

				$_COOKIE['userName'] = $re_user;
				setcookie("userName", $re_user, time() + (WEEK_IN_SECONDS), COOKIEPATH, COOKIE_DOMAIN);
			}
		}
	}
}
/**
 * Đăng Nhập
 *
 */
if ($_POST['login'] === "Đăng Nhập") {
	if ($_POST['userLogin'] != '' || $_POST['passLogin'] != '') {
		$login_user = $_POST['userLogin'];
		$login_pass = $_POST['passLogin'];

		$check_user = g2_check_user($login_user);
		$check_pass = g2_check_password($login_pass);

		if ($check_user == 1) {
			if ($check_pass == 1) {
				if (!isset($_COOKIE['userName'])) {
					g2_alert_success("Đăng nhập thành công");
					$_COOKIE['userName'] = $login_user;
					setcookie("userName", $login_user, time() + (WEEK_IN_SECONDS), COOKIEPATH, COOKIE_DOMAIN);
				}
			} else {
				g2_alert_error('Tài khoản hoặc mật khẩu không đúng!');
			}
		} else {
			g2_alert_error('Tài khoản hoặc mật khẩu không đúng!');
		}
	}
}

/**
 * Đăng Xuất
 *
 */
if (isset($_POST['logout']) && $_POST['logout'] == "true") {
	unset($_COOKIE['userName']);
	setcookie("userName", '', 0, COOKIEPATH, COOKIE_DOMAIN);
}

/**
 * Update Profile
 *
 */
if (isset($_POST['profile_update']) && $_POST['profile_update'] == "true") {
	if (isset($_COOKIE['userName'])) {
		require_once(ABSPATH . 'wp-admin/includes/image.php');
		require_once(ABSPATH . 'wp-admin/includes/file.php');
		require_once(ABSPATH . 'wp-admin/includes/media.php');
		$overrides = array(
			'test_form' => false,
			'test_type' => false,
		);

		$pf_user = $_COOKIE['userName'];
		$pf_email = $_POST['profile_email'];
		$pf_pass_old = $_POST['profile_password_old'];
		$pf_pass_new = $_POST['profile_password_new'];
		$pf_phone = $_POST['profile_phone'];
		$pf_sex = $_POST['profile_sex'];

		$user = new User();
		$user->setUser($pf_user);

		$pf_avatar = $user->getFilter("avatar");

		if ($_FILES['profile_avatar']['name'] != "") {
			$upload = wp_handle_upload($_FILES['profile_avatar'], $overrides);
		} else {
			$upload['url'] = $pf_avatar;
		}

		$pass = $user->getFilter("password");
		if (md5($pf_pass_old) != $pass && $pf_pass_old != "") {
			g2_alert_error("Sai mật khẩu cũ!");
		} else {
			if ($pf_pass_new == "") {
				$pf_pass_new = $pf_pass_old;

				$where = array('user' => $pf_user);

				$data = array(
					'user' => $pf_user,
					'password' => md5($pf_pass_new),
					'avatar' => $upload['url'],
					'phone' => $pf_phone,
					'email' => $pf_email,
					'sex' => intval($pf_sex),
				);
			}
			g2_update_db("g2_users", $data, $where);
		}
	} else {
		g2_alert_error("Bạn phải đăng nhập!");
	}
}

/**
 * Contact form
 *
 * Gửi thông tin về mail của admin bằng phpmailer
 */
// add_action('phpmailer_init','sendContact');
//  function sendContact(PHPMailer $phpMailer)
//  {
// 	 $phpMailer->setFrom($_POST['contact-email'], $_POST['contact-name']);
// 	 $phpMailer->Host = 'smtp1.example.com;smtp2.example.com';
// 	 $phpMailer->Port = 110;
// 	 $phpMailer->SMTPAuth =  true;
// 	 $phpMailer->SMTPSecure = 'tls';
// 	 $phpMailer->Username = 'g2team.666@gmail.com';
// 	 $phpMailer->Password = 'superg2team666';
// 	 $phpMailer->Body = $_POST['contact-messenger'];
// 	 $phpMailer->isSMTP();
//  }