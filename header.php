<!DOCTYPE html>
<html <?php language_attributes();  ?> />
<head>
	<title></title>
	<meta charset="<?php bloginfo('charset'); ?>" />
	<link rel="profile"  href="http://gmgp.org/xfn/11" />
	<link rel="pingback"  href="<?php bloginfo('pingback_url'); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous"/>
	<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
				<div class="topbar-right">
					<ul class="st-list topbar-items">
						<li style="border-right: 1px solid rgba(255, 255, 255, 0.2);"><a href="#">Login</a></li>
						<li style="border-right: 1px solid rgba(255, 255, 255, 0.2);"><a href="#">Sign up</a></li>
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
					<img src="<?php echo get_template_directory_uri(); ?>/application/libs/Images/logo_homap-4.svg">
					<div class="menu">

						<nav id="st-main-menu" >
							<a href="#" class="back-menu"><i class="fa fa-angle-left"></i></a>
							<ul id="main-menu">
								<li><a href="../HTML/HomePage.html"  >HOME</a></li>
								<li><a href="#">LISTING<i class="fa fa-angle-down"></i></a>
									<ul class="sub-menu">
										<li><a href="#">Full Map Layout</a></li>
										<li><a href="#">Half Map Layout</a></li>
										<li><a href="../HTML/slidebar.html">Sidebar layout</a></li>
										
									</ul>
								</li>
								<li><a href="#">HOTEL<i class="fa fa-angle-down"></i></a>
									<ul class="sub-menu">
										<li><a href="../HTML/detailhotel1.html">Hotel Detail 1</a></li>
										<li><a href="#">Hotel Detail 2</a></li>
										<li><a href="#">Hotel Detail 3</a></li>
										<li><a href="../HTML/roomdetail1.html">Room Detail 1</a></li>
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
										<li><a href="../HTML/aboutus.html">About Us</a></li>
										<li><a href="../HTML/blog1.html">Blog</a></li>
										<li><a href="#">404 Page</a></li>
										
									</ul>
								</li>
								<li><a href="../HTML/Contact.html">CONTACT</a></li>
							</ul>
						</nav>
					</div>
                </div>
				<div class="header1right">
					<form action="" method="get" class="header-search hidden-sm">
						<input type="text" class="form-control" name="s" value="">
						<i class="fa fa-search"></i>
					</form>
					<img class="ico_card" src="<?php echo get_template_directory_uri(); ?>/application/libs/Images/ico_card.svg">
				</div>
			</div>
		</div>
	
</header>
