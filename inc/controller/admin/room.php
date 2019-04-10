<?php
if(!class_exists('ST_Room_Admin')){
class ST_Room_Admin{
	public static $_inst;
	public function __construct(){
		add_action('init', array($this,'room_custom_post_type'));	
		add_action('init', array($this, 'room_custom_taxonomy'));
		// add_action('add_meta_boxes',array($this, 'room_meta_box'));
		add_filter('manage_room_posts_columns',array($this, 'sunset_set_contact_columns'));
		add_action('manage_room_posts_custom_column', array($this,'sunset_contact_custom_column'), 10, 2);
		add_action('add_meta_boxes', array($this, 'sunset_contact_add_meta_box'));
		add_action('save_posts', array($this, 'sunset_save_contact_email_data'), 10, 2);
		


		add_action('amenities_add_form_fields', array ( $this, 'add_category_image' ));
		add_action('created_amenities', array($this, 'save_category_image'), 10, 2);
		add_action('amenities_edit_form_fields', array ( $this, 'update_category_image' ), 10, 2 );
		add_action('edited_amenities', array ( $this, 'updated_category_image' ), 10, 2 );
		add_action('admin_enqueue_scripts', array( $this, 'load_media' ) );
		add_action( 'admin_footer', array ( $this, 'add_script' ) );

	}
	public function load_media(){
		wp_enqueue_media();
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
	
	  public function add_script() { ?>
   <script>
     jQuery(document).ready( function($) {
       function ct_media_upload(button_class) {
         var _custom_media = true,
         _orig_send_attachment = wp.media.editor.send.attachment;
         $('body').on('click', button_class, function(e) {
           var button_id = '#'+$(this).attr('id');
           var send_attachment_bkp = wp.media.editor.send.attachment;
           var button = $(button_id);
           _custom_media = true;
           wp.media.editor.send.attachment = function(props, attachment){
             if ( _custom_media ) {
               $('#category-image-id').val(attachment.id);
               $('#category-image-wrapper').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
               $('#category-image-wrapper .custom_media_image').attr('src',attachment.url).css('display','block');
             } else {
               return _orig_send_attachment.apply( button_id, [props, attachment] );
             }
            }
         wp.media.editor.open(button);
         return false;
       });
     }
     ct_media_upload('.ct_tax_media_button.button'); 
     $('body').on('click','.ct_tax_media_remove',function(){
       $('#category-image-id').val('');
       $('#category-image-wrapper').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
     });
     // Thanks: http://stackoverflow.com/questions/15281995/wordpress-create-category-ajax-response
     $(document).ajaxComplete(function(event, xhr, settings) {
       var queryStringArr = settings.data.split('&');
       if( $.inArray('action=add-tag', queryStringArr) !== -1 ){
         var xml = xhr.responseXML;
         $response = $(xml).find('term_id').text();
         if($response!=""){
           // Clear the thumb image
           $('#category-image-wrapper').html('');
         }
       }
     });
   });
 </script>
 <?php }
 	 public function save_category_image(){
	 	if(isset($_POST['category-image-id']) && '' !== $_POST['category-image-id']){
	 		$image = $_POST['category-image-id'];
	 		add_term_meta($term_id, 'category-image-id', $image, true);
	 	}
	 }
	  public function update_category_image ( $term, $amenities ) { ?>
   <tr class="form-field term-group-wrap">
     <th scope="row">
       <label for="category-image-id"><?php _e( 'Image', 'shinetheme' ); ?></label>
     </th>
     <td>
       <?php $image_id = get_term_meta ( $term -> term_id, 'category-image-id', true ); ?>
       <input type="hidden" id="category-image-id" name="category-image-id" value="<?php echo $image_id; ?>">
       <div id="category-image-wrapper">
         <?php if ( $image_id ) { ?>
           <?php echo wp_get_attachment_image ( $image_id, 'thumbnail' ); ?>
         <?php } ?>
       </div>
       <p>
         <input type="button" class="button button-secondary ct_tax_media_button" id="ct_tax_media_button" name="ct_tax_media_button" value="<?php _e( 'Add Image', 'shinetheme' ); ?>" />
         <input type="button" class="button button-secondary ct_tax_media_remove" id="ct_tax_media_remove" name="ct_tax_media_remove" value="<?php _e( 'Remove Image', 'shinetheme' ); ?>" />
       </p>
     </td>
   </tr>
 <?php
 }
  public function updated_category_image ( $term_id, $tt_id ) {
   if( isset( $_POST['category-image-id'] ) && '' !== $_POST['category-image-id'] ){
     $image = $_POST['category-image-id'];
     update_term_meta ( $term_id, 'category-image-id', $image );
   } else {
     update_term_meta ( $term_id, 'category-image-id', '' );
   }
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
	function sunset_set_contact_columns($columns)
{
	$newColumns = array();
	$newColumns['title'] = '__Full Name';
	$newColumns['message'] = 'Message';
	$newColumns['email'] = 'Email';
	$newColumns['tags'] = 'Tags';
	$newColumns['date'] = 'Date';
	return $newColumns;
}
function sunset_contact_custom_column($column,$post_id)
{
	switch ($column) {
		case 'message':
			echo get_the_excerpt();
			break;
		
		case 'email':
			$email = get_post_meta($post_id,'_contact_email_value_key',true);
			echo '<a href = "mailto:'.$email.'">'.$email.'</a>';
			break;
	}
}



function sunset_contact_add_meta_box()
{
	add_meta_box('contact_email','User Email',[$this,'sunset_contact_email_callback'],'room');

}
function sunset_contact_email_callback($post){
	wp_nonce_field('sunset_save_contact_email_data', 'sunset_contact_email_meta_box_nonce');
	$value = get_post_meta($post->ID, '_contact_email_value_key', true);
	echo '<label for="sunset_contact_email_field">User email</label>';
	echo '<input type="email" id="sunset_contact_email_field" name="sunset_contact_email_field" value="' . esc_attr($value) . '">';

}
function sunset_save_contact_email_data($post_id, $my_data){
	if( ! isset($_POST['sunset_contact_email_meta_box_nonce']) ){
		return;
	}
	if( ! wp_verify_nonce($_POST['sunset_contact_email_meta_box_nonce'],
	 'sunset_save_contact_email_data') ){
		return;
	}
	if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE){
		return;
	}
	if( ! current_user_can('edit_post', $post_id)){
		return;
	}
	if( ! isset($_POST['sunset_contact_email_field']) ){
		return;
	}
	$my_data = sanitize_text_field($_POST['sunset_contact_email_field']);
	update_post_meta($post_id, '_contact_email_value_key', $my_data);
}
// function st_contact_email_callback($post)
// {
// 	wp_nonce_field('st_save_contact_email_data','st_contact_email_meta_box_nonce');
// 	$value = get_post_meta($post->ID,'contact_email_value_key',true);
// 	echo '<label for = "st_contact_email_field">User Email Address: </lable>';
// 	echo '<input type = "email" id = "st_contact_email_field" name = "st_contact_email_field" value="'.esc_attr($value).'" size = "25"/>';
// }
// function st_contact_save_email_data($post_id)
// {
// 	if (!isset($_POST['st_contact_email_meta_box_nonce'])) {
// 		return;
// 	}
// 	if (!wp_verify_nonce($_POST['st_contact_email_meta_box_nonce'],'st_save_contact_email_data')) {
// 		return;
// 	}
// 	if (define('DOING_AUTOSAVE')&& DOING_AUTOSAVE) {
// 		return;
// 	}
// 	if (!current_user_can('edit_post',$post_id)) {
// 		return;
// 	}
// 	if (!isset($_POST['st_contact_email_field'])) {
// 		return;
// 	}
// 	$my_data = sanitize_text_field($_POST['st_contact_email_field']);
// 	update_post_meta($post_id,'contact_email_value_key',$my_data);
// }



// function st_add_metabox()
// {
// 	add_meta_box('contact_email','User Email',[$this,'st_contact_email_callback'],'room');

// }
// function st_contact_email_callback($post){
// 	wp_nonce_field('save_email_data', 'contact_email_meta_box_nonce');
// 	$value = get_post_meta($post->ID, '_contact_email_value_key', true);
// 	echo '<label for="contact_email_field">User Email</label>';
// 	echo '<input type="email" id="contact_email_field" name="contact_email_field" value="'.esc_attr($value).'"/>';
// }
// function save_contact_email_data($post_id){
// 	if(!isset( $_POST['contact_email_meta_box_nonce'])){
// 		return;
// 	}
// 	if(!wp_verify_nonce($_POST['contact_email_meta_box_nonce'],'save_email_data')){
// 		return;
// 	}
// 	if( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE){
// 		return;
// 	}
// 	if( ! current_user_can('edit_post', $post_id)){
// 		return;
// 	}
// 	if(!isset($_POST['contact_email_field'])){
// 		return;
// 	}
// 	$my_data = sanitize_text_field($_POST['contact_email_field']);
// 	update_post_meta($post_id, '_contact_email_value_key', $my_data);
// }




	
	// function room_meta_box(){
	// 	add_meta_box('room-info', 'Thông tin về phòng', [$this,'show_your_fields_meta_box'], 'room');
	// }
	// function show_your_fields_meta_box($post){
	// 	wp_nonce_field('save_contact_email_data', 'contact_email_meta_box_nonce');
	// 	$value = get_post_meta($post->ID, '_contact_email_value_key', true);
	// 	echo '<label for="contact_email_field">User email:</label>';
	// 	echo '<input type="email" id="contact_email_field" name="contact_email_field" value="'. esc_attr($value) . '">';
	// }
	// function save_contact_email_data($post_id){
	// 	if( ! isset($_POST['contact_email_meta_box_nonce']) ){
	// 		return;
	// 	}
	// 	if( ! wp_verify_nonce($_POST['contact_email_meta_box_nonce'], 'show_your_fields_meta_box')){
	// 		return;
	// 	}
	// 	if( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE){
	// 		return;
	// 	}
	// 	if( ! current_user_can('edit_post', $post_id)){
	// 		return;
	// 	}
	// 	if(! isset($_POST['contact_email_field'])){
	// 		return;
	// 	}
	// 	$my_data = sanitize_text_field($_POST['contact_email_field']);
	// 	update_post_meta($post_id, '_contact_email_value_key', $my_data);
	// }
 



	public static function inst(){
		if(empty(self::$_inst)){
			self::$_inst = new self();
		}
		return self::$_inst;
	}
}

ST_Room_Admin::inst();
}

