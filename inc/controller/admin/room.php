<?php
if(!class_exists('ST_Room_Admin')){
class ST_Room_Admin{
	public static $_inst;
	public function __construct(){
		add_action('init', array($this,'room_custom_post_type'));	
		add_action('init', array($this, 'room_custom_taxonomy'));
		add_action('add_meta_boxes', array($this, 'room_meta_box'));
		add_action( 'save_post', array($this, 'save_your_fields_meta' ));
	}

	public function room_custom_post_type(){
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
	public function room_custom_taxonomy(){
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
	
	public function room_meta_box(){
		add_meta_box('room-info', 'Thông tin về phòng', 'show_your_fields_meta_box', 'room');
	}

	public function show_your_fields_meta_box(){
		global $post;
		$meta = get_post_meta($post->ID, 'your_fields', true);?>
		<input type="hidden" name="your_meta_box_nonce" value="<?php echo wp_create_nonce(basename(__FILE__));?>">
		<p>
	    	<label for="superficies">Superficies</label>
	    	<br>
	    	<?php echo ('<input type="text" id="your_fields[text_s]" name="your_fields[text_s]" value="'.$meta.'"/>'); ?>
	    	</p>
    	<p>
    		<label for="">Prices</label>
    		<br>
    		<?php echo ('<input type="text" id="your_fields[text_p]" name="your_fields[text_p]" value="'.$meta.'"/>'); ?>
	    	</p>
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
    	<?php
    		$current_option = isset($meta['select'])  ? $meta['select'] : '';
    	?>
		<p>
	    	<label for="bed">Beds</label>
	    	<br>
	    	<select name="your_fields[select]" id="your_fields[select]">
	    		<option value="option-one" ><?php selected( $current_option, 'option-one' ); ?>Option One</option>
	    		<option value="option-two" ><?php selected( $current_option, 'option-two' ); ?>Option Two</option>
	    	</select>
    	</p>

    	<p>
	    	<label for="children">Children</label>
	    	<br>
	    	<select name="your_fields[select]" id="your_fields[select]">
	    		<option value="option-one" <?php selected( $meta['select'], 'option-one' ); ?>>Option One</option>
	    		<option value="option-two" <?php selected( $meta['select'], 'option-two' ); ?>>Option Two</option>
	    	</select>
    	</p>

    	<p>
	    	<label for="adult">Adults</label>
	    	<br>
	    	<select name="your_fields[select]" id="your_fields[select]">
	    		<option value="option-one" <?php selected( $meta['select'], 'option-one' ); ?>>Option One</option>
	    		<option value="option-two" <?php selected( $meta['select'], 'option-two' ); ?>>Option Two</option>
	    	</select>
    	</p>
	<?php }
	public function save_your_fields_meta( $post_id ) {
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
	public static function inst(){
		if(empty(self::$_inst)){
			self::$_inst = new self();
		}
		return self::$_inst;
	}
}

ST_Room_Admin::inst();
}

