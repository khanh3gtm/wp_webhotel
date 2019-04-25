<!DOCTYPE html>
<html <?php language_attributes();  ?> />
<head>
	<title>Web Traveler</title>
	<meta charset="<?php bloginfo('charset'); ?>" />
	<link rel="profile"  href="http://gmgp.org/xfn/11" />
	<link rel="pingback"  href="<?php bloginfo('pingback_url'); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous"/>
    <link rel='stylesheet' id='google-font-css-css'  href='https://fonts.googleapis.com/css?family=Poppins%3A400%2C500%2C600' type='text/css' media='all' />
	<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <!-- slide hotel -->
    <link  href="http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet"> 
    <script src="http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js"></script> 
    <!-- end slide hotel -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- date -->
     <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
   <!-- header -->
<header>
        <div class="topbar">
            <div class="container-fluid">
                <div class="topbar-left">
                    <ul class="st-list socials">
                        <li>
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                        </li>
                    </ul>
                    <ul class="st-list topbar-items">
                        <li class="hidden-xs hidden-sm">
                            <a href="#" target="">contact@shinetheme.com</a>
                        </li>
                    </ul>
                </div>
                <?php $us = wp_get_current_user();
                    $check = is_user_logged_in(); 
                ?>
                <div class="topbar-right">
                    <ul class="st-list topbar-items">
                        <?php if($check==1){ ?>
                        <li ><a href="<?php get_template_directory_uri() ?>/wordpress/wp-login.php">Hi, <?php echo $us->data->user_login . '<br />'; ?></a></li>
                        <li><a href="<?php get_template_directory_uri() ?>/wordpress/wp-login.php?action=logout">Logout</a></li>
                        <?php }else{
                            ?>
                        <li><a href="<?php get_template_directory_uri() ?>/wordpress/wp-login.php">Login</a></li>
                        <li ><a href="../../register">Sign up</a></li>
                            <?php
                        } ?>
                        
                        <li class="dropdown dropdown-currency hidden-sm hidden-xs">
                            <a href="#">EUR<i class="fa fa-angle-down"></i></a>
                            <ul class="dropmenu">
                                <li><a href="#">USD</a></li>
                                <li><a href="#">AUD</a></li>
                            </ul>
                        </li>
                        <li class="dropdown dropdown-language hidden-sm hidden-xs">
                            <a href="#">English<i class="fa fa-angle-down"></i></a>
                            <ul class="dropmenu">
                                <li><a href="#">Français</a></li>
                                <li><a href="#">Español</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="head1">
            <div class="container">
                <div class="toggle">
                    <i class="fa fa-bars menu1" ></i>
                </div>
                <div class="header1left">
                    <a href="<?php echo home_url() ?>">
                        <img src="<?php echo get_template_directory_uri(); ?>/application/libs/Images/logo_homap-4.svg">
                    </a>
                    <div class="menu">

                        <nav id="st-main-menu" >
                            <a href="#" class="back-menu"><i class="fa fa-angle-left"></i></a>
                            <ul id="main-menu">
                                <li><a href="<?php echo home_url() ?>">HOME</a></li>
                                <li><a href="#">LISTING<i class="fa fa-angle-down"></i></a>
                                    <ul class="sub-menu">
                                        <li><a href="#">Full Map Layout</a></li>
                                        <li><a href="#">Half Map Layout</a></li>
                                        <li><a href="<?php echo get_permalink(( get_page_by_path( 'hotel-search' ) )); ?>">Sidebar layout</a></li>

                                    </ul>
                                </li>
                                <li><a href="#">HOTEL<i class="fa fa-angle-down"></i></a>
                                    <ul class="sub-menu">
                                        <li><a href="<?php site_url( '/hotel/' ); ?>">Hotel Detail 1</a></li>
                                        <li><a href="#">Hotel Detail 2</a></li>
                                        <li><a href="#">Hotel Detail 3</a></li>
                                        <li><a href="?c=room&a=view">Room Detail 1</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">HOUSE<i class="fa fa-angle-down"></i></a>
                                    <ul class="sub-menu">
                                        <li><a href="#">House Detail 1</a></li>
                                        <li><a href="#">House Detail 2</a></li>

                                    </ul>
                                </li>
                                <li><a href="#">PAGES<i class="fa fa-angle-down"></i></a>
                                    <ul class="sub-menu">
                                        <li><a href="../../view/site/aboutus.php">About Us</a></li>
                                        <li><a href="../../view/site/blog1.php">Blog</a></li>
                                        <li><a href="#">404 Page</a></li>

                                    </ul>
                                </li>
                                <li><a href="../../view/site/Contact.php">CONTACT</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <?php  
                    
                if (isset($_SESSION['st_cart'])) {
                ?>
                <!-- Icon Bookcart -->
                <div class="header1right">
                    <form action="" method="get" class="header-search hidden-sm">
                        <input type="text" class="form-control" name="s" value="">
                        <i class="fa fa-search"></i>
                    </form>
                    <div id="d-minicart" class="mini-cart" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <div class="cart-caret">1</div>
                        <i class="input-icon field-icon fa">
                            <img class="ico_card" src="<?php echo get_template_directory_uri(); ?>/application/libs/Images/ico_card.svg">
                        </i>
                    </div>
                    <ul class="dropdown-menu" aria-labelledby="d-minicart">
                        <li class="heading">
                            <h4 class="st-heading-section">Your Cart</h4>
                        </li>
                        <li class="cart-item">
                            <div class="media">
                                <?php $ss = $_SESSION['st_cart']; 
                                    $key = $ss['room_id'];
                                $cart= bookcart::inst()->__stGetInfoRoom($key);
                                ?>
                                <div class="media-left">
                                    <?php
                        echo get_the_post_thumbnail($cart[2]->ID,array(70, 70)); ?>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading"><a class="st-link c-main" href="#"><?php echo $cart[0]->post_title ?></a>
                                    </h4>
                                    <div class="price-wrapper">Price:
                                        <span class="price">€ 
                                            <?php 
                                                $start = convert_date_format($ss['start']);
                                                $startday= strtotime($start);
                                                $end = convert_date_format($ss['end']);
                                                $endday= strtotime($end);
                                                $night = abs($endday-$startday);
                                                $sl_night = floor($night/(60*60*24));
                                                if ($sl_night>1) {
                                                    $price = $sl_night * $cart[3]['st_contact_price_field'][0];
                                                }
                                                else {
                                                    $price = $cart[3]['st_contact_price_field'][0];
                                                }
                                                $money = $price + $price*0.1;
                                                echo $money;
                                            ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <a href="?remove=true" class="cart-delete-item"><i class="fa">
                                <img src="<?php echo get_template_directory_uri(); ?>/application/libs/Images/delete.svg" style="height: 16px;width: 16px;">
                            </i></a>
                        </li>
                        <li class="cart-total">
                            <div class="sub-total">Subtotal: <span class="price"> €
                                <?php
                                    echo $money;
                                ?>
                            </span>
                            </div>
                            <a href="<?php echo site_url( '/checkout/'); ?>" class="btn btn-green btn-full upper">Check Out</a>
                        </li>
                    </ul>
                </div>
            <?php }
            else{ ?>
                <div class="header1right">
                    <form action="" method="get" class="header-search hidden-sm">
                        <input type="text" class="form-control" name="s" value="">
                        <i class="fa fa-search"></i>
                    </form>
                    <div id="d-minicart" class="mini-cart" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <i class="input-icon field-icon fa">
                            <img class="ico_card" src="<?php echo get_template_directory_uri(); ?>/application/libs/Images/ico_card.svg">
                        </i>
                    </div>
                    <ul class="dropdown-menu" aria-labelledby="d-minicart">
                        <li class="heading">
                            <h4 class="st-heading-section">Your Cart</h4>
                        </li>
                        
                        <li class="cart-total">
                            <p>Your cart is empty !!!</p>
                        </li>
                    </ul> 
                </div>
            <?php } ?>
            </div>
        </div>
    </header>
