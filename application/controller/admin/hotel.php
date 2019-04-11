<?php
if(!class_exists('ST_Hotel_Admin')){
class ST_Hotel_Admin{
	public static $_inst;
	public function __construct(){
		add_action('init', array($this,'customsb_post_type'));	
		add_action( 'init', array($this,'custom_taxonomy_location') );
		add_action('init', array($this, 'hotel_custom_taxonomies'));
		add_action('add_meta_boxes',array($this,'hotel_meta_box'));
		add_action('save_post',array($this,'hotel_info_save'));
		add_action('manage_hotel_posts_columns',array($this,'hotel_set_columns'));
		add_action('manage_hotel_posts_custom_column',array($this,'hotel_custom_columns'), 10,2);
		add_action('manage_edit-location_columns',array($this,'location_set_columns'));
		// add_action('manage_location_columns',array($this,'location_custom_columns'), 10,2);
		add_action('location_add_form_fields', array ( $this, 'add_location_image' ));
		add_action('created_location', array($this, 'save_location_image'), 10, 2);
		add_action('location_edit_form_fields', array ( $this, 'update_location_image' ), 10, 2 );
		add_action('edited_location', array ( $this, 'updated_location_image' ), 10, 2 );
		add_action('admin_enqueue_scripts', array( $this, 'load_media' ) );
		add_action( 'admin_footer', array ( $this, 'add_script' ) );
	}

	public function customsb_post_type(){
		$labels = array(
			'name' => 'Hotel',
			'singular_name'=> 'Hotel',
			'add_new' => 'Add Hotel',
			'all_items' => 'All Hotels',
			'add_new_item' => 'Add Hotel',
			'edit_item' => 'Edit Item',
			'new_item' => 'New Item',
			'view_item' => 'View Item',
			'search_items' => 'Search Hotel',
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
		register_post_type('hotel', $args);
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
		register_taxonomy('location', array('hotel','room'), $args);
	}
	//Create metabox of hotel
	public function hotel_custom_taxonomies(){
		$labels = array(
			'name'  => 'Facilities',
			'singular_name' => 'Facilities',
			'search_items' => 'Search Facilities',
			'all_items' => 'All Facilities',
			'parent_item' => 'Parent Type',
			'parent_item_colon' => 'Parent Type:',
			'edit_item' => 'Edit Type',
			'update_item' => 'Update Type',
			'add_new_item' => 'Add New Type',
			'new_item_name' => 'New Type Name',
			'menu_name' => 'Facilities',
		);
		$args = array(
			'labels' => $labels,
			'show_ui' => true,
			'hierarchical' => true,
			'show_admin_column' => true,
			'query_var' => true,

			'rewrite' => array('slug', 'facilities'),

		);
		register_taxonomy('facilities', array('hotel'), $args);
	}
	//create custome column
	function hotel_set_columns($columns){
		unset($columns['categories']);
		unset($columns['tags']);
		$newColumns = array();
		$newColumns['title'] = 'Hotel Name';
		$newColumns['description'] = 'Description';
		$newColumns['owner'] = 'Owner';
		$newColumns['address'] = 'Address';
		$newColumns['date'] = 'Date';
		
		//$newColumns['location'] ='Location'; 
		$columns = array_merge($columns, $newColumns);
		return $columns;
	}
	function hotel_custom_columns($column,$post_id){
		switch ($column){
			case 'description':
				echo get_the_excerpt();
				break;
			case 'owner':
				$owner = get_post_meta($post_id,'_owner',true);		
				echo $owner;
				break;	
			case 'address':
				$add = get_post_meta($post_id,'_add',true);
				echo $add;
					break;	
			case 'location':
				$location = get_the_terms($post_id,'location');
				dd($location);
					break;	
			default:
				# code...
				break;
		}
	}
	//create custom columns 
	function location_set_columns($columns){
		$newColumns = array();
		$newColumns['images'] = 'Images';
		$columns = array_merge($columns, $newColumns);
		return $columns;
	}
	function location_custom_columns($column,$post_id){
		switch ($column){
			case 'description':
				echo get_the_excerpt();
				break;
			case 'images':
				echo "123";
				break;	
			default:
				# code...
				break;
		}
	}

	public function load_media(){
			wp_enqueue_media();
		}

		public function add_location_image () { ?>
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

public function save_location_image(){
	if(isset($_POST['category-image-id']) && '' !== $_POST['category-image-id']){
		$image = $_POST['category-image-id'];
		add_term_meta($term_id, 'category-image-id', $image, true);
	}
}
public function update_location_image ( $term, $amenities ) { ?>
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
public function updated_location_image ( $term_id, $tt_id ) {
	if( isset( $_POST['category-image-id'] ) && '' !== $_POST['category-image-id'] ){
		$image = $_POST['category-image-id'];
		update_term_meta ( $term_id, 'category-image-id', $image );
	} else {
		update_term_meta ( $term_id, 'category-image-id', '' );
	}
}


	//create metabox of hotel
	 function hotel_meta_box(){
		add_meta_box('hotel-info','Hotel Information',[$this,'hotel_info_output'],'hotel');
	}
	 function hotel_info_output($post){
	 	wp_nonce_field('hotel_info_save','hotel_meta_box_nonce');
	 	$owner = get_post_meta($post->ID,'_owner',true);
	 
	 	$add = get_post_meta($post->ID,'_add',true);
	 	$image = get_post_meta($post->ID,'_hotel_image',true);
	 	$url = explode(",", $image);
	 	?>
	 	<p>
	 		<label for="owner">Owner:</label><br />
	 		<input type="text" name="owner" id="owner" size="30" value="<?php echo $owner; ?>" />
	 	</p>
	 	<p>
	 		<label for="address">Address:</label><br />
	 		<input type="text" name="address" id="address" size="30" value="<?php echo $add; ?>" />
	 	</p>
	 	<p>
	 		<label>Images</label><br/>
	 		<div class="st-upload-gallery" style="min-height: 100px;">
		 		<input type="hidden" name="hotel_images" class="hotel_images" value="<?php echo $image; ?>">
		 		<div class="st-include-image">
		 		<?php
		 		if(!empty($url)){
			 		foreach ($url as $key => $value) {
			 			$url_image = wp_get_attachment_image_url($value, 'thumbnail');
			 			echo '<img class="st-thumb" src="'. $url_image .'" style = "margin-left: 10px;" data-id="'. $value .'"/><i class="fa fa-times time " ></i>';
			 		}
			 	}
			 	?>
			 	</div>
			 	<br>
		 		<input type="button" class="st-upload"  value="Add Image">
		 		<input type="button" name="" class="" value="Delete Image">

	 		</div>
	 	</p>
	 	<script type="text/javascript">
	 		$('.st-upload').each(function (e) {
            var t = $(this);
            var parent = t.closest('.st-upload-gallery');
            var multi = t.data('multi');
            var frame;
            t.click(function (e) {
                e.preventDefault();

                var galleryBox = t.parent().find('.st-selection');

                if (frame) {
                    frame.open();
                    return;
                }
                // Create a new media frame
                frame = wp.media({
                    title: 'Select image',
                    button: {
                        text: 'Use this media'
                    },
                    multiple: true  // Set to true to allow multiple files to be selected
                });

                frame.on('select', function () {

                    // Get media attachment details from the frame state
                    var attachment = frame.state().get('selection').toJSON();

                    var ids = [];                    

                    //Get id ảnh đã có để đưa vào ids;
                    $('img', parent).each(function(){
                    	var currentID = $(this).data('id');
                    	if(!ids.includes(currentID)){
                    		ids.push(currentID);
                    	}
                    });

                    console.log(ids);

                 
                   
                    if (attachment.length > 0) {
                        for (var i = 0; i < attachment.length; i++) {
                        	if(!ids.includes(attachment[i].id)){
	                   			ids.push(attachment[i].id);
	                   			parent.find('.st-include-image').append('<img  src="'+ attachment[i].url +'" width="150px" height="150px" style = "margin-left: 10px;"  />');
                   			}
                        }
                    }
                    
                    parent.find('.hotel_images').val(ids.toString());
                });

                frame.open();

            });
        })

	 	</script>

	 	<?php }

	 	function hotel_info_save($post_id){
	 		if(!isset($_POST['hotel_meta_box_nonce'])){
	 			return;
	 		}
	 		if(!wp_verify_nonce($_POST['hotel_meta_box_nonce'],'hotel_info_save')){
	 			return;
	 		}
	 		if(define('DOING_AUTOSAVE') && DOING_AUTOSAVE){
	 			return;
	 		}

	 		$owner = sanitize_text_field($_POST['owner']);	
	 		update_post_meta($post_id,'_owner',$owner);
	 		$add = sanitize_text_field($_POST['address']);	
	 		update_post_meta($post_id,'_add',$add);
	 		$image = sanitize_text_field($_POST['hotel_images']);
	 		update_post_meta($post_id,'_hotel_image',$image);


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