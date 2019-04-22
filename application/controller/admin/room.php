<?php
if(!class_exists('ST_Room_Admin')){
	class ST_Room_Admin{
		public static $_inst;
		public function __construct(){
			add_action('init', array($this,'room_custom_post_type'));	
			add_action('init', array($this, 'room_custom_taxonomy'));
		 	add_action('add_meta_boxes',array($this, 'room_meta_box'));
			add_filter('manage_room_posts_columns',array($this, 'sunset_set_contact_columns'));
			add_action('manage_room_posts_custom_column', array($this,'sunset_contact_custom_column'), 10, 2);
			add_action('add_meta_boxes', array($this, 'sunset_contact_add_meta_box'));
			add_action('save_post', array($this, 'sunset_save_contact_email_data'), 10, 2);
			add_action('manage_amenities_custom_column', array($this, 'st_taxonomy_custom_column'),10,3);
			add_action('amenities_add_form_fields', array ( $this, 'add_category_image' ));
			add_action('created_amenities', array($this, 'save_category_image'), 10, 2);
			add_action('amenities_edit_form_fields', array ( $this, 'update_category_image' ), 10, 2 );
			add_action('edited_amenities', array ($this, 'updated_category_image' ), 10, 2 );
			add_action('admin_enqueue_scripts', array( $this, 'load_media' ) );
			add_action('admin_footer', array ( $this, 'add_script' ) );
			add_action('admin_footer', array ( $this, 'upload_image_meta_box' ) );

			add_filter('manage_edit-amenities_columns',array($this, 'my_custom_taxonomy_columns')); 

			add_filter('manage_edit-amenities_columns',array($this, 'my_custom_taxonomy_columns'));
			add_action('save_post',array($this,'__getDataToTable'));

		}
		public function load_media(){
			wp_enqueue_media();
		}
		function upload_image_meta_box(){
			?>

			<script type="text/javascript">
				$('.st-upload1').each(function (e) {
					var t = $(this);
					var parent = t.closest('.st-upload-gallery1');
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
                    $('img', parent).each(function(){
                    	var currentID = $(this).data('id');
                    	if(!ids.includes(currentID)){
                    		ids.push(currentID);
                    	}
                    });

                    

                    if (attachment.length > 0) {
                    	for (var i = 0; i < attachment.length; i++) {
                    		if(!ids.includes(attachment[i].id)){
                    			ids.push(attachment[i].id);
                    			parent.find('.st-include-image1').append('<div class="item1"><img  src="'+ attachment[i].url +'" width="150px" height="150px" style = "margin-left: 10px;"  /><i class="fa fa-times" ></i></div>');
                    		}
                    		
                    	}
                    }
                    console.log(ids);
                    
                    parent.find('.metabox-image').val(ids.toString());
                });

                frame.open();
            });
				})
				$(document).on('click',"i.fa.fa-times" ,function() {
	 			$(this).parent().remove();
	 			var ids = [];
	 			$('.st-include-image1 .item1').each(function(){
	 				var id = $(this).find('img').data('id');
	 				if(!ids.includes(id)){
	 					ids.push(id);
	 				}
	 			});
	 			$('.metabox-image').val(ids.toString());
                   	
            });


			</script>

			<?php
		}
		function my_custom_taxonomy_columns($columns){
			$columns = array();
			$columns['name'] = __('Name');
			$columns['image'] = __('Image');
			$columns['description'] = __('Description');
			$columns['slug'] = __('Slug');

			return $columns;
		}
		function st_taxonomy_custom_column($out, $column,$term_id)
		{
			switch ($column) {
				case 'image':
				$image = get_term_meta($term_id, 'category-image-id', true);
				// $data = maybe_unserialize($image->description);
				$data = wp_get_attachment_image_src($image, 'thumbnail');
				echo '<img src="'. $data[0] .'" alt="">';
				break;
				
			}
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
public function save_category_image($term_id){
	if( isset( $_POST['category-image-id'] ) && '' !== $_POST['category-image-id'] ){
		$image = $_POST['category-image-id'];
		add_term_meta ( $term_id, 'category-image-id', $image );
	} else {
		add_term_meta ( $term_id, 'category-image-id', '' );
	}
}
public function update_category_image ( $term, $amenities ) { ?>
	<tr class="form-field term-group-wrap">
		<th scope="row">
			<label for="category-image-id"><?php _e( 'Image', 'shinetheme' ); ?></label>
		</th>
		<td>
			<?php $image_id = get_term_meta ( $term -> term_id, 'category-image-id', true ); ?>
			<!--Lay gia tri hien tai</!-->
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
public function updated_category_image ( $term_id) {
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
		'add_new' => 'Add Room',
		'all_items' => 'All Rooms',
		'add_new_item' => 'Add Room',
		'edit_item' => 'Edit Room',
		'new_item' => 'New Room',
		'view_item' => 'View Room',
		'search_item' => 'Search Room',
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
	$newColumns['superficies'] = 'Superficies';
	$newColumns['prices'] = 'Prices';
	$newColumns['beds'] = 'Beds';
	$newColumns['children'] = 'Children';
	$newColumns['adult'] = 'Adult';
	$newColumns['image'] = 'Image';
	$newColumns['hotel'] = 'Hotel';
	$newColumns['star'] = 'Star room';
	$columns=	array_merge($newColumns,$columns );
	$newColumns['tags'] = 'Tags';
	$newColumns['date'] = 'Date';
	unset($columns['tags']);
	unset($columns['categories']);
	return $columns;
}

function sunset_contact_custom_column($column,$post_id)
{
	switch ($column) {
		case 'superficies':
		$superficies = get_post_meta($post_id, 'st_contact_superficies_field', true);
		echo $superficies;
		break;
		
		case 'star':
		$star = get_post_meta($post_id, 'st_contact_star_field', true);
		echo $star;
		break;

		case 'hotel':
		$hotelData = get_post_meta($post_id, 'st_contact_hotel_field', true);
		$resHotel = get_the_title($hotelData);
		echo $resHotel;
		break;

		case 'prices':
		$prices = get_post_meta($post_id,'st_contact_price_field',true);
		echo $prices;
		break;

		case 'beds':
		$beds = get_post_meta($post_id, 'st_contact_bed_field', true);
		echo $beds;
		break;

		case 'children':
		$children = get_post_meta($post_id, 'st_contact_children_field', true);
		echo $children;
		break;
		case 'adult':
		$adult = get_post_meta($post_id, 'st_contact_adult_field', true);
		echo $adult;
		break;
		case 'image':
		$image = get_post_meta($post_id, 'metabox-image-id', true);
		$data_img = wp_get_attachment_image_src($image, 'thumbnail');
		echo '<img src="'. $data_img[0] .'" alt="">';

		break;
	}
}



function sunset_contact_add_meta_box()
{
	add_meta_box('contact_email','Thông tin phòng',[$this,'sunset_contact_email_callback'],'room');
}

private function getHotelData(){
	$query = new WP_Query(array(
		'post_type' => 'hotel',
		'posts_per_page' => -1
	));

	$arr = array();
	if($query->have_posts()){
		while ($query->have_posts()) {
		    $query->the_post();
		    $arr[get_the_ID()] = get_the_title();
		}
	}
	wp_reset_postdata();
	return $arr;
	
}
function sunset_contact_email_callback($post){
	wp_nonce_field('sunset_save_contact_email_data', 'sunset_contact_email_meta_box_nonce');
	$superficies = get_post_meta($post->ID, 'st_contact_superficies_field', true);
	$prices = get_post_meta($post->ID, 'st_contact_price_field', true);
	$beds = get_post_meta($post->ID, 'st_contact_bed_field', true);
	$children = get_post_meta($post->ID, 'st_contact_children_field', true);
	$adult = get_post_meta($post->ID, 'st_contact_adult_field', true);
	$image = get_post_meta($post->ID, 'metabox-image-id', true);
	$hotel_parent = get_post_meta($post->ID,'st_contact_hotel_field',true);
	$star = get_post_meta($post->ID, 'st_contact_star_field', true);
	$url = explode(',', $image);

	$hotelData = $this->getHotelData();

	echo '<label for="st_contact_superficies_field">Superficies</label>';
	echo '<br>';
	echo '<input type="text" id="st_contact_superficies_field" name="st_contact_superficies_field" value="' . esc_attr($superficies) . '">';
	echo '<br>';
	echo '<label for="st_contact_price_field">Prices</label>';
	echo '<br>';
	echo '<input type="text" id="st_contact_price_field" name="st_contact_price_field" value="' . esc_attr($prices) . '">';
	echo '<br>';
	echo '<label for="st_contact_star_field">Star Num</label>';
	echo '<select name="st_contact_star_field" id="st_contact_star_field">';
	for($i=1; $i<=5;$i++){
		echo '<option value="'. $i .'" '. selected($star, $i) .'>'.$i.'</option>';
	}
	echo '</select>';
	echo '<br>';
	

	echo '<label for="st_contact_bed_field">Beds</label>';

	echo '<select name="st_contact_bed_field" id="st_contact_bed_field">';
	for($i=1; $i<=10;$i++){
		echo '<option value="'. $i .'" '. selected($beds, $i) .'>'.$i.'</option>';
	}
	echo '</select>';
	echo '<br>';
	echo '<label for="st_contact_hotel_field">Hotel</label>';
	echo '<select name="st_contact_hotel_field" id="st_contact_hotel_field">';
	if(!empty($hotelData)){
		foreach ($hotelData as $key => $value) {
			echo '<option value="'. $key .'" '. selected($hotel_parent, $key) .'>'. $value .'</option>';
		}

	}

	echo '</select>';
	
	echo '<label for="st_contact_children_field">Children</label>';
	echo '<select name="st_contact_children_field" id="st_contact_children_field">';
	for($i=1; $i<=10;$i++){
		echo '<option value="'. $i .'" '. selected($children, $i) .'>'.$i.'</option>';
	}
	echo '</select>';
	$adult_option = isset($adult['select']) ? $adult['select'] : '';
	echo '<label for="st_contact_adult_field">Adult</label>';
	echo '<select name="st_contact_adult_field" id="st_contact_adult_field">';
	for($i=1; $i<=10;$i++){
		echo '<option value="'. $i .'" '. selected($adult, $i) .'>'.$i.'</option>';
	}
	echo '</select>';
	echo '<br>';

	?>
	<label><?php _e('Image', 'shinetheme'); ?></label>
	<div class="st-upload-gallery1">
		<input type="hidden" id="metabox-image" name="metabox-image" class="metabox-image" value="<?php echo $image; ?>">
		<div class="st-include-image1">
			<?php 
			if(!empty($url))
			{
				foreach ($url as $value) {
					if(!empty($value)){
			 			$url_image = wp_get_attachment_image_url($value, 'thumbnail');
			 			echo '<div class="item1" style="display: inline-block;"><img class="st-thumb1" src="'. $url_image .'" width="150px" height="150px"  style = "margin-left: 10px;" data-id="'. $value .'"/><i class="fa fa-times" ></i></div>';
			 			}

				}
			}
			?>
		</div>

		<input type="button" class="st-upload1"  value="<?php _e( 'Add Image', 'shinetheme' ); ?>" />
		<input type="button" class="button"  value="<?php _e( 'Remove Image', 'shinetheme' ); ?>" />
	</div>

	<?php
}

function sunset_save_contact_email_data($post_id){
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
if( ! isset($_POST['st_contact_superficies_field']) ){
	return;
}
if( ! isset($_POST['st_contact_price_field']) ){
	return;
}
if( ! isset($_POST['st_contact_bed_field']) ){
	return;
}
if( ! isset($_POST['st_contact_children_field']) ){
	return;
}
if( ! isset($_POST['st_contact_adult_field']) ){
	return;
}
$superficies = sanitize_text_field($_POST['st_contact_superficies_field']);
update_post_meta($post_id, 'st_contact_superficies_field', $superficies);
$prices = sanitize_text_field($_POST['st_contact_price_field']);
update_post_meta($post_id, 'st_contact_price_field', $prices);
$beds = sanitize_text_field($_POST['st_contact_bed_field']);
update_post_meta($post_id, 'st_contact_bed_field', $beds);
$children = sanitize_text_field($_POST['st_contact_children_field']);
update_post_meta($post_id, 'st_contact_children_field', $children);
$adult = sanitize_text_field($_POST['st_contact_adult_field']);
update_post_meta($post_id, 'st_contact_adult_field', $adult);
$image = $_POST['metabox-image'];
update_post_meta($post_id, 'metabox-image-id', $image);
$hotelData = sanitize_text_field($_POST['st_contact_hotel_field']);	
update_post_meta($post_id, 'st_contact_hotel_field', $hotelData);
$star = sanitize_text_field($_POST['st_contact_star_field']);
update_post_meta($post_id, 'st_contact_star_field', $star);
}
// public function get_hotel(){
// 	$query = new WP_Query( array( 'post_type' => 'hotel' ) );
// 	if ( $query->have_posts() ) {
// 	// The Loop
// 	while ( $query->have_posts() ) {
// 		$query->the_post();
// 		echo '<li>' . get_the_title() . '</li>';
// 	}
// }


public static function inst(){
	if(empty(self::$_inst)){
		self::$_inst = new self();
	}
	return self::$_inst;
}




















function __getDataToTable(){
	
	if($_POST['post_type'] =='room'){
		global $wpdb;
		
		$hotel_id = $_POST['st_contact_hotel_field'];
	
		$args = array(
			'post_type' =>'room',
			'meta_query' => array(
				array(
					'key'     => 'st_contact_hotel_field',
					'value'   => $hotel_id
				),
			)
		);
		$query = new WP_Query( $args );
		$arr_room = array();
		if($query->have_posts()){
			while($query->have_posts()){
				$query->the_post();
				array_push($arr_room, get_the_ID());
			}
			wp_reset_postdata();
		}
	
	
		$medium_price = 0;
		$hotel_point = 0;
		if(!empty($arr_room)){
			foreach ($arr_room as  $value) {
				$price = get_post_meta($value,'st_contact_price_field',true);
				$star_num = get_post_meta($value,'st_contact_star_field',true);
				$medium_price = $medium_price + $price;
				$hotel_point = $hotel_point + $star_num;			
			}	
		}
		$medium_price=ROUND($medium_price/count($arr_room),1);
		$hotel_point = ROUND($hotel_point/count($arr_room),1);

		$post_args = array(
			'price'=>$medium_price,
			'hotel_point' => $hotel_point
		);


		$wpdb->update( $wpdb->prefix . 'posts', $post_args, array( 'ID' => $hotel_id ));
	}  
}
}

ST_Room_Admin::inst();
}

