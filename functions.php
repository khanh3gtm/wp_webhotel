<?php
include "application/helpers/helpers.php";
/**
@khai bao hang gia tri
	@THEME_URL = lay duong dan thu muc theme
	@ CORE = lay duong dan cua thu muc /core
	**/
	define( 'THEME_URL', get_stylesheet_directory_uri() );

	define( 'THEME_DIR', get_stylesheet_directory() );

	define( 'CORE', THEME_DIR . "/core" );


/**
	@Nhung file /core/init.php
	**/
	require_once ( CORE . "/init.php" );
/**
	@Thiet lap chieu rong noi dung
	**/
	if(!isset($content_width)){
		$content_width = 620;
	}
/**
	@Khai bao chuc nang cua theme
	**/	
	if(!function_exists('webhotel_theme_setup')){
		function webhotel_theme_setup(){
		//thiet lap textdomain
			$language_folder = THEME_URL . '/languages';
			load_theme_textdomain('shinetheme',$language_folder);
		//Tu dong them link RSS len <head>
			add_theme_support( 'automatic-feed-links' );
		//Them post thumbnail
			add_theme_support('post-thumbnails');
			
		//Them title-tag(thay doi title theo tung trang)
			add_theme_support('title-tag');
		// Them custom background
			$default_background = array(
				'default-color' => '#e8e8e8e'
			);
			add_theme_support('custom-background',$default_background);
		// Them menu
			register_nav_menu('primary-menu',__('Primary Menu','shinetheme'));
			register_nav_menus( array(
				'Bassic-menu' => __('Bassic Menu','shinetheme'),
				'medium-menu' => __('Medium Menu','shinetheme'),

			));
		//Tao sidebar
			$sidebar = array(
				'name' => __('Main Sidebar','shinetheme'),
				'id' => 'main-sidebar',
				'description' => __('Default sidebar'),
				'class' => 'main-sidebar',
				'before_title' => '<h3 class ="widgettitle">',
				'after_title' => '</h3>'
			);
			register_sidebar($sidebar);




		}
		add_action('after_setup_theme','webhotel_theme_setup');
	}
	function webhotel_style(){
		wp_register_style('menu-style',THEME_URL . '/CSS/menu.css','all');
		wp_enqueue_style('menu-style');
		wp_register_style('footer-style',THEME_URL . '/CSS/footer.css','all');
		wp_enqueue_style('footer-style');
		wp_register_style('body-style',THEME_URL . '/style.css','all');
		wp_enqueue_style('body-style');
		wp_register_script('match-height-script',THEME_URL . '/js/jquery.matchHeight.js','all');
		wp_enqueue_script('match-height-script');
		if(is_page_template('template_homepage.php')){
			wp_register_script('homepage-script',THEME_URL . '/js/khanh.js','all');
		wp_enqueue_script('homepage-script');
		}
		if(is_page_template('template_hotel_search.php'))
		{
			wp_register_style('sidebar123-style',THEME_URL . '/CSS/slide_deadline.css','all');
			wp_enqueue_style('sidebar123-style');
			
			wp_register_script('sidebar-script',THEME_URL . '/js/cuong.js','all');
			wp_enqueue_script('sidebar-script');

		}
		if(is_singular('hotel')){
			wp_register_style('hoteldetail-style',THEME_URL . '/CSS/roomhotel.css','all');
			wp_enqueue_style('hoteldetail-style');
			wp_register_script('hotel-script',THEME_URL . '/js/script.js','all');
			wp_enqueue_script('hotel-script');
		}
		if(is_singular('room')){
			wp_enqueue_style('room', THEME_URL . '/CSS/room.css', 'all');
		}
	}
	add_action('wp_enqueue_scripts','webhotel_style');

	$arr_libfiles = array(
		'View',
		'Model',
		'Controller'
	);
	foreach ($arr_libfiles as $k=> $v) {
		$file = get_template_directory(). '/core/' . $v. '.php';
		if(file_exists($file)){
			include $file;
		}
	}
	//load model
	$arr_model = array(
		'bookcart',
		'homepage',
		'sorthotel'
	);
	foreach ($arr_model as $k=> $v) {
		$files = get_template_directory(). '/application/model/' . $v. '.php';
		if(file_exists($files)){
			include $files;
		}
	}

	$arr_admin_files = array(
		'admin' => array(
			'hotel',
			'room'
		),
		'frontend' => array(
			'homepage',
			'bookcart',
			'sorthotel'
		)		
	);

	foreach ($arr_admin_files as $k=> $v) {
		$file_path = '';
		if($k == 'admin'){
			$file_path = 'admin/';
		}
		foreach ($v as $key => $value) {
			$file = get_template_directory(). '/application/controller/'. $file_path . $value. '.php';
			if(file_exists($file)){
				include $file;
			}
		}
		/*$file = get_template_directory(). '/inc/controller/admin/' . $v. '.php';
		if(file_exists($file)){
			include $file;
		}*/
	}
	function dd($arr){
	echo '<pre>';
	print_r($arr);
	echo '</pre>';
	}
 ?>
