<?php
include "inc/helpers/helpers.php";
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
	}
	add_action('wp_enqueue_scripts','webhotel_style');

	$arr_libfiles = array(
		'View',
		'Model',
		'Route',
		'Controller'
	);
	foreach ($arr_libfiles as $k=> $v) {
		$file = get_template_directory(). '/inc/libs/' . $v. '.php';
		if(file_exists($file)){
			include $file;
		}
	}

	$arr_admin_files = array(
		'admin' => array(
			'hotel',
			'room'
		),
		'frontend' => array(
			'bookcart'
		)		
	);
	foreach ($arr_admin_files as $k=> $v) {
		$file_path = '';
		if($k == 'admin'){
			$file_path = 'admin/';
		}
		foreach ($v as $key => $value) {
			$file = get_template_directory(). '/inc/controller/'. $file_path . $value. '.php';
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

