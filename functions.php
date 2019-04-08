
<?php
include "inc/helpers/helpers.php";
include "inc/class/checkout.php";


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
	function room_custom_post_type(){
		$labels = array(
			'name' => 'Room',
			'singular_name'=> 'Room',
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
			'menu_position' => 5,
			'exclude_form_search' => false
		);
		register_post_type('room', $args);
	}
	add_action('init', 'room_custom_post_type');

	function room_custom_taxonomy(){
		$labels = array(
			'name'  => 'Amenities',
			'singular_name' => 'Amentities',
			'search_items' => 'Search Type',
			'all_items' => 'All Types',
			'parent_item' => 'Parent Type',
			'parent_item_colon' => 'Parent Type:',
			'edit_item' => 'Edit Type',
			'update_item' => 'Update Type',
			'add_new_item' => 'Add New Type',
			'new_item_name' => 'New Type Name',
			'menu_name' => 'Amenities',
		);
		$args = array(
			'labels' => $labels,
			'show_ui' => true,
			'hierarchical' => true,
			'show_admin_column' => true,
			'query_var' => true,
			'rewrite' => array('slug', 'amenities'),

		);
		register_taxonomy('amenities', array('room'), $args);
	}
	add_action('init', 'room_custom_taxonomy');
	function room_meta_box(){
		add_meta_box('room-info', 'Thông tin về phòng', 'show_your_fields_meta_box', 'room');
	}
	add_action('add_meta_boxes', 'room_meta_box');

	function show_your_fields_meta_box(){
		global $post;
		$meta = get_post_meta($post->ID, 'your_fields', true);?>
		<input type="hidden" name="your_meta_box_nonce" value="<?php echo wp_create_nonce(basename(__FILE__));?>">
		<p>
	    	<label for="superficies">Superficies</label>
	    	<br>
	    	<input type="text" name="superficies" id="superficies" class="regular-text" value="<?php echo $meta['text']; ?>">
	    	</p>
    	<p>
    		<label for="">Prices</label>
    		<br>
    		<input type="text" name="price" id="price" class="" value="<?php echo $meta['text1'] ?>">
    	</p>
    	<!-- <p>
    	<label for="your_fields[textarea]">Textarea</label>
    	<br>
    	<textarea name="your_fields[textarea]" id="your_fields[textarea]" rows="5" cols="30" style="width:500px;"><?php echo $meta['textarea']; ?></textarea>
    	</p>
    	</p> -->
    	<!--checkbox</!-->
    	<!-- <p>
    	<label for="your_fields[checkbox]">Checkbox
    		<input type="checkbox" name="your_fields[checkbox]" value="checkbox" <?php if ( $meta['checkbox'] === 'checkbox' ) echo 'checked'; ?>>
    	</label>
    	</p> -->
    	<!--select menu</!-->
		<p>
	    	<label for="bed">Beds</label>
	    	<br>
	    	<select name="bed" id="bed">
	    		<option value="option-one" <?php selected( $meta['select'], 'option-one' ); ?>>Option One</option>
	    		<option value="option-two" <?php selected( $meta['select'], 'option-two' ); ?>>Option Two</option>
	    	</select>
    	</p>

    	<p>
	    	<label for="children">Children</label>
	    	<br>
	    	<select name="children" id="children">
	    		<option value="option-one" <?php selected( $meta['select'], 'option-one' ); ?>>Option One</option>
	    		<option value="option-two" <?php selected( $meta['select'], 'option-two' ); ?>>Option Two</option>
	    	</select>
    	</p>

    	<p>
	    	<label for="adult">Adults</label>
	    	<br>
	    	<select name="adult" id="adult">
	    		<option value="option-one" <?php selected( $meta['select'], 'option-one' ); ?>>Option One</option>
	    		<option value="option-two" <?php selected( $meta['select'], 'option-two' ); ?>>Option Two</option>
	    	</select>
    	</p>
	<?php }
	function save_your_fields_meta( $post_id ) {
    	// verify nonce
    	if ( !wp_verify_nonce( $_POST['your_meta_box_nonce'], basename(__FILE__) ) ) {
    		return $post_id;
    	}
    	// check autosave
    	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
    		return $post_id;
    	}
    	// check permissions
    	if ( 'page' === $_POST['post_type'] ) {
    		if ( !current_user_can( 'edit_page', $post_id ) ) {
    			return $post_id;
    		} elseif ( !current_user_can( 'edit_post', $post_id ) ) {
    			return $post_id;
    		}
    	}

    	$old = get_post_meta( $post_id, 'your_fields', true );
    	$new = $_POST['your_fields'];

    	if ( $new && $new !== $old ) {
    		update_post_meta( $post_id, 'your_fields', $new );
    	} elseif ( '' === $new && $old ) {
    		delete_post_meta( $post_id, 'your_fields', $old );
    	}
    }
    add_action( 'save_post', 'save_your_fields_meta' );




 ?>
