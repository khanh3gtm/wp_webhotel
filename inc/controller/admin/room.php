<?php
if(!class_exists('ST_Room_Admin')){
class ST_Room_Admin{
	public static $_inst;
	public function __construct(){
		add_action('init', array($this,'room_custom_post_type'));	
		add_action('init', array($this, 'room_custom_taxonomy'));
		add_action('add_meta_boxes',array($this, 'room_meta_box'));

		add_action('save_post',array($this, 'save_your_fields_meta'));
		add_action('amenities_add_form_fields', array ( $this, 'add_category_image' ) );

	}
	 public function add_category_image () { ?>
   <div class="form-field term-group">
     <label for="category-image-id"><?php _e('Image', 'shinetheme'); ?></label>
     <input type="hidden" id="category-image-id" name="category-image-id" class="custom_media_url" value="">
     <div id="category-image-wrapper"></div>
     <p>
       <input type="button" class="button button-secondary ct_tax_media_button" id="ct_tax_media_button" name="ct_tax_media_button" value="<?php _e( 'Add Image', 'shinetheme' ); ?>" />
       <input type="button" class="button button-secondary ct_tax_media_remove" id="ct_tax_media_remove" name="ct_tax_media_remove" value="<?php _e( 'Remove Image', 'shinetheme' ); ?>" />
    </p>
   </div>
 <?php
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
	function room_meta_box(){
		add_meta_box('room-info', 'Thông tin về phòng', [$this,'show_your_fields_meta_box'], 'room');
	}
	function show_your_fields_meta_box($post){
		global $post;
		$meta = get_post_meta($post->ID, 'your_fields', true);?>
		<input type="hidden" name="your_meta_box_nonce" value="<?php echo wp_create_nonce(basename(__FILE__));?>">
		<p>
	    	<label for="superficies">Superficies</label>
	    	<br>
	    	<?php $current_text = isset($meta['text']) ? $meta[text] : ''; ?>
	    	<input type="text" name="your_fields[text_s]" id="your_fields[text_s]" class="regular-text" value="<?php echo $current_text; ?>">
	    	<!-- <?php echo ('<input type="text" id="your_fields[text_s]" name="your_fields[text_s]" value="'.$meta.'"/>'); ?> -->
	    	</p>
    	<p>
    		<label for="">Prices</label>
    		<br>
    		<input type="text" name="your_fields[text_p]" id="your_fields[text_p]" class="regular-text" value="<?php echo $current_text; ?>">
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
	    	<select name="your_fields[bed]" id="your_fields[bed]">
	    		<option value="option-one" ><?php selected( $current_option, 'option-one' ); ?>1</option>
	    		<option value="option-two" ><?php selected( $current_option, 'option-two' ); ?>2</option>
	    		<option value="option-three" ><?php selected( $current_option, 'option-three' ); ?>3</option>
	    		<option value="option-four" ><?php selected( $current_option, 'option-four' ); ?>4</option>
	    		<option value="option-five" ><?php selected( $current_option, 'option-five' ); ?>5</option>
	    		<option value="option-six" ><?php selected( $current_option, 'option-six' ); ?>6</option>
	    		<option value="option-seven" ><?php selected( $current_option, 'option-seven' ); ?>7</option>
	    		<option value="option-eight" ><?php selected( $current_option, 'option-eight' ); ?>8</option>

	    	</select>
    	</p>

    	<p>
	    	<label for="children">Children</label>
	    	<br>
	    	<select name="your_fields[children]" id="your_fields[children]">
	    		<option value="option-one" ><?php selected( $current_option, 'option-one' ); ?>1</option>
	    		<option value="option-two" ><?php selected( $current_option, 'option-two' ); ?>2</option>
	    		<option value="option-three" ><?php selected( $current_option, 'option-three' ); ?>3</option>
	    		<option value="option-four" ><?php selected( $current_option, 'option-four' ); ?>4</option>
	    		<option value="option-five" ><?php selected( $current_option, 'option-five' ); ?>5</option>
	    		<option value="option-six" ><?php selected( $current_option, 'option-six' ); ?>6</option>
	    		<option value="option-seven" ><?php selected( $current_option, 'option-seven' ); ?>7</option>
	    		<option value="option-eight" ><?php selected( $current_option, 'option-eight' ); ?>8</option>

	    	</select>
    	</p>

    	<p>
	    	<label for="adult">Adults</label>
	    	<br>
	    	<select name="your_fields[adult]" id="your_fields[adult]">
	    		<option value="option-one" ><?php selected( $current_option, 'option-one' ); ?>1</option>
	    		<option value="option-two" ><?php selected( $current_option, 'option-two' ); ?>2</option>
	    		<option value="option-three" ><?php selected( $current_option, 'option-three' ); ?>3</option>
	    		<option value="option-four" ><?php selected( $current_option, 'option-four' ); ?>4</option>
	    		<option value="option-five" ><?php selected( $current_option, 'option-five' ); ?>5</option>
	    		<option value="option-six" ><?php selected( $current_option, 'option-six' ); ?>6</option>
	    		<option value="option-seven" ><?php selected( $current_option, 'option-seven' ); ?>7</option>
	    		<option value="option-eight" ><?php selected( $current_option, 'option-eight' ); ?>8</option>

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
  




	public static function inst(){
		if(empty(self::$_inst)){
			self::$_inst = new self();
		}
		return self::$_inst;
	}
}

ST_Room_Admin::inst();
}

