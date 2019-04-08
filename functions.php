<?php 


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
	}
	add_action('wp_enqueue_scripts','webhotel_style');


	function customsb_post_type()
	{
		$labels=array(
			'name'=>'Hotel',
			'singular_name'=>'Hotel',
			'add_new_item'=>'Add Item',
			'add_new'=>'Add Item',
			'edit_item'=>'Edit Item',
			'new_item'=>'New Item',
			'view_item'=>' View Item',
			'searchs_item'=> 'Search Item',
			'not_found'=>'Not found Item',
			'not_found_in_trash'=>' Not found Item in trash'
		);
		$args=array(
			'labels'=>$labels,
			'public'=>true,
			'has_archive'=>true,
			'publicly_queryable'=>true,
			'query_var'=>true,
			'rewrite'=>true,
			'capability_type'=>'post',
			'hierarchical'=>false,
			'supports'=>array(
				'title',
				'editor',
				'excerpt',
				'thumbnail',
				'revisions',
				'page-attributes'
			),
			'taxonomies'=>array(
				'category',
				'post_tag',

			),
			'menu_position'=>5,
			'exclude_from_search'=>false




		);
		register_post_type('hotel_th',$args);
	}
	add_action( 'init', 'customsb_post_type');
	function custom_taxonomies()
	{
		$labels= array(
			'name'=>'Location',
			'singular_name'=>'Location',
			'search_item'=>'Search Location',
			'all_items'=>'All Locations',
			'parent_item'=>'Parent Locations',
			'parent_item_colon'=>'Parent Locations:',
			'edit_item'=>'Edit Location',
			'update_item'=>'Update Location',
			'add_new_item'=>'Add New Location',
			'new_item_name'=>'New Location Name',
			'menu_name'=>'Location'
		);
		$args=array(
			'hierarchical'=>true,
			'labels'=> $labels,
			'show_ui'=> true,
			'show_admin_column'=>true,
			'query_var'=>true,
			'rewrite'=>array('slug'=>'location')
		);
		register_taxonomy('location',array('hotel_th'),$args);
	}
	add_action('init','custom_taxonomies');

 ?>
 