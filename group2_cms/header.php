<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop G2</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,600;0,700;1,400;1,600;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.6.0/css/all.css">

    <link rel="stylesheet" href="<?php echo bloginfo('template_directory') ?>/public/css/style.css">
    <link rel="stylesheet" href="<?php echo bloginfo('template_directory') ?>/public/css/style-products.css">
    <link rel="stylesheet" href="<?php echo bloginfo('template_directory') ?>/public/css/styles.css">
    <link rel="stylesheet" href="<?php echo bloginfo('template_directory') ?>/public/css/style-single.css">
    <link rel="stylesheet" href="<?php echo bloginfo('template_directory') ?>/public/css/login.css">
    <link rel="stylesheet" href="<?php echo bloginfo('template_directory') ?>/public/css/avatar.scss">

    <link rel="stylesheet" href="<?php echo bloginfo('template_directory') ?>/public/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo bloginfo('template_directory') ?>/public/css/bootstrap.min.css">

    <style>
        .dropdown button {
            background: none !important;
            border: none !important;
        }

        .avatar {
            vertical-align: middle;
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }

        .dropbtn:hover,
        .dropbtn:focus .avatar {
            background: none !important;
            border: none !important;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f1f1f1;
            min-width: 160px;
            overflow: auto;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown-content input {
            border: none;
            background: none;
        }

        .dropdown-content a,
        .dropdown-content input {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            text-align: center;
        }

        .dropdown a:hover,
        .dropdown-content input:hover {
            background-color: #ddd;
        }

        .show {
            display: block;
        }

        /* tablet mini */
        @media only screen and (min-width: 576px) and (max-width: 1100px) {
            .carousel-caption {
                display: none;
            }
        }

        /* mobile */
        @media only screen and (max-width: 575px) {
            .carousel-caption {
                display: none;
            }
        }
    </style>
    <link rel="stylesheet" href="<?php echo bloginfo('template_directory') ?>/public/css/style-products.css">
    <link rel="stylesheet" href="<?php echo bloginfo('template_directory') ?>/public/css/cart_style.css">
    <link rel="stylesheet" href="<?php echo bloginfo('template_directory') ?>/public/css/checkout_style.css">
    <link rel="stylesheet" href="<?php echo bloginfo('template_directory') ?>/public/css/contact.css">

</head>

<body>
    <header>
        <div class="header">
            <div class="header__top">
                <a href="<?php echo esc_url(home_url()) ?>">
                    <?php
                    if (has_custom_logo()) {
                        echo '<img class="logo" src="' . esc_url(get_link_custom_logo()) . '" alt="' . get_bloginfo('name') . '">';
                    } else {
                    ?>
                        <img class="logo" src="<?php echo bloginfo('template_directory') ?>/public/img/logo.png" alt="logo">
                    <?php
                    }
                    ?>
                </a>
                <ul class="nav__link">
                    <li class="nav__link--item">
                        <a href="<?php echo esc_url(home_url()) ?>">Home</a>
                    </li>
                    <li class="nav__link--item">
                        <a href="<?php echo esc_url(get_permalink(get_page_by_path('tat-ca-san-pham'))) ?>">sản phẩm</a>
                    </li>
                    <li class="nav__link--item">
                        <a href="<?php echo esc_url(get_permalink(get_page_by_path('contact'))) ?>">liên hệ</a>
                    </li>
                    <li class="nav__link--item">
                        <?php global $woocommerce; ?>
                        <a class="cart-contents" style="color:#FEC144" 
                        href="<?php echo $woocommerce->cart->get_cart_url(); ?>" 
                        title="<?php _e('View your shopping cart', 'woothemes'); ?>">
                            <?php echo sprintf(_n('%d item', '%d  <i class="fas fa-cart-plus"></i>',
                             $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count); ?>
                            <!-- <?php echo $woocommerce->cart->get_cart_total(); ?> -->
                        </a>
                    </li>

                    <?php
                    if (isset($_COOKIE['userName'])) {
                        $user = new User();
                        $user->setUser($_COOKIE['userName']);
                    ?>
                        <div class="dropdown">
                            <button>
                                <img onclick="myFunction()" 
                                src="<?php echo $user->getFilter("avatar")?>" alt="Avatar" 
                                class="avatar dropbtn img-fluid" style="box-shadow: 1px 1px 4px 0px rgba(0, 0, 0, 0.75);">
                            </button>
                            <div id="myDropdown" class="dropdown-content">
                                <a href="<?php echo esc_url(get_permalink(get_page_by_path('profile-user'))) ?>">Profile</a>
                                <form action="" method="post">
                                    <input type="hidden" name="logout" value="true">
                                    <input type="submit" value="Logout" class="form-control">
                                </form>
                                <!-- <a href="#about">Logout</a> -->
                            </div>
                        </div>
                    <?php
                    } else {
                        echo '
                    <li class="nav__link--item"><a data-toggle="modal" href="javascript:void(0)" onclick="openLoginModal();">Đăng Nhập</a></li>';
                    }
                    ?>
                </ul>

                <?php
                get_template_part('template-parts/modal/modal', 'login')
                ?>
            </div>

            <div class="header__bottom">
                <ul class="nav__link">
                    <?php $categories = get_category_wc();
                    foreach ($categories as $cat) {
                    ?>
                        <li class="nav__link--item" title="<?php echo $cat->ID; ?>">
                            <a href="<?php echo get_term_link($cat); ?> "><?php echo $cat->name; ?></a>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
    </header>

    <script>
        function myFunction() {
            document.getElementById("myDropdown").classList.toggle("show");
        }

        window.onclick = function(event) {
            if (!event.target.matches('.dropbtn')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                var i;
                for (i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }
    </script>