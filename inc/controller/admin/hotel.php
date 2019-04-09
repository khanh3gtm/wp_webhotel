<?php
if(!class_exists('ST_Hotel_Admin')){
class ST_Hotel_Admin{
	public static $_inst;
	public function __construct(){
		add_action('init', array($this,'customsb_post_type'));	
		add_action( 'init', array($this,'custom_taxonomy_location') );
	}

	public function customsb_post_type(){
		$labels = array(
			'name' => 'Hotel',
			'singular_name'=> 'Hotel',
			'add_new' => 'Add Item',
			'all_items' => 'All Items',
			'add_new_item' => 'Add Item',
			'edit_item' => 'Edit Item',
			'new_item' => 'New Item',
			'view_item' => 'View Item',
			'search_item' => 'Search Item',
			'not_found' => 'No Items Found',
			'not_found_in_trash' => 'No items found in trash',
			'parent_item_colon' => 'Parent Item',

		);
		$args = array(
			'labels' => $labels,
			'public' => true,
			'has_archive' => true, // cho phep luu tru bai viet
			'publicly_queryable' => true,
			'query_var' => true,
			'rewrite' => true,
			'capability_type' => 'post',
			'hierarchical' => true,
			'supports' => array(
				'title',
				'editor',
				'excerpt',
				'thumbnail',
				'revisions',
				'page-attributes'
			),
			'taxonomies' => array('category', 'post_tag'),
			'menu_position' => 4,
			'exclude_form_search' => false
		);
		register_post_type('hotel-th', $args);
	}
	public function custom_taxonomy_location(){
		$labels = array(
			'name'  => 'Location',
			'singular_name' => 'Location',
			'search_items' => 'Search Location',
			'all_items' => 'All Locations',
			'parent_item' => 'Parent Location',
			'parent_item_colon' => 'Parent Location:',
			'edit_item' => 'Edit Location',
			'update_item' => 'Update Location',
			'add_new_item' => 'Add New Location',
			'new_item_name' => 'New Location Name',
			'menu_name' => 'Location',
		);
		$args = array(
			'labels' => $labels,
			'show_ui' => true,
			'hierarchical' => true,
			'show_admin_column' => true,
			'query_var' => true,
			'rewrite' => array('slug'=>'location'),

		);
		register_taxonomy('location', array('hotel-th','room'), $args);
	}




	public static function inst(){
		if(empty(self::$_inst)){
			self::$_inst = new self();
		}
		return self::$_inst;
	}


}
ST_Hotel_Admin::inst();
}