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
	//create metabox of hotel
	 function hotel_meta_box(){
		add_meta_box('hotel-info','Hotel Information',[$this,'hotel_info_output'],'hotel');
	}
	 function hotel_info_output($post){
	 	wp_nonce_field('hotel_info_save','hotel_meta_box_nonce');
	 	$owner = get_post_meta($post->ID,'_owner',true);
	 
	 	$add = get_post_meta($post->ID,'_add',true);
	 	$image = get_post_meta($post->ID,'_image',true);
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
	 		<input type="hidden" name="hotel_images" class="hotel_images" value="<?php echo $image ?>">
	 		<input type="button" class="st-upload"  value="Add Image">
	 		<input type="button" name="" class="" value="Delete Image">
	 	</p>
	 	<script type="text/javascript">
	 		$('.st-upload').each(function (e) {
            var t = $(this);
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
                    //console.log(attachment);
                    var ids = [];
                    
                        galleryBox.find('.del').each(function () {
                            ids.push($(this).data('id'));
                        });
                        if (attachment.length > 0) {
                            for (var i = 0; i < attachment.length; i++) {
                            	console.log('ID: ' + attachment[i].id);
                            	console.log('URL: ' + attachment[i].url);
                                if (!ids.includes(attachment[i].id)) {
                                    galleryBox.append('<div class="item" style="background-image: url(' + attachment[i].url + ')"><div class="del" data-id="' + attachment[i].id + '"></div></div>');
                                    ids.push(attachment[i].id);
                                }
                            }
                        }
                    
                    t.find('input').val(ids.toString());
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
	 		update_post_meta($post_id,'_image',$image);


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