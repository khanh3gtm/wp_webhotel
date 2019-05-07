<?php
class bookcart extends Controller {
	public function __construct(){
		parent::__construct();	
		add_action('init', array($this, '__stCheckoutHandler'));
		add_action('init', array($this, '__stBookingSucces'));
		add_action('init', array($this, '__stBkSucces'));
		add_action('init', array($this, '__stInfoBook'),10,1);
		add_action('init', array($this, '__stInfoSucces'));
		add_action('init', array($this, '__stHistory'));
		add_action('init', array($this, '__stList'),10,1);
		add_action('init', array($this, '__stGetInfoRoom'),10,1);
		add_action('init', array($this, '__stAddSesson'));
		add_action('init', array($this, '_stDestroyCart'));
	}
	public function __stCheckoutHandler(){
		bookcart_model::inst()->taobang();
	}
	public function __stBookingSucces()
	{
			if(isset($_POST['checkout_submit'])){
	 		$data = $_POST;		
				if(!preg_match('/^[_a-z0-9-]*@[a-z0-9-]+(\.[a-z0-9-]+)$/', $_POST['st_email']))
				    {
				    	$err_checkout =  'This email is not valid. Please re-enter.';
				    	$page_id   = get_queried_object_id();
				    	$page_link = get_the_permalink($page_id);
				    	wp_redirect($page_link);
				    }
				    else $err_checkout = '';
				    unset($_SESSION['st_err']);
					$_SESSION['st_err'] = $err_checkout;
				if(!isset($data['term_condition'])||$data['term_condition'] != '1'){
						$err_check ='Please tick a checkbox';
						$page_id   = get_queried_object_id();
				    	$page_link = get_the_permalink($page_id);
				    	wp_redirect($page_link);
					}
				else $err_check = '';
				unset($_SESSION['st_err1']);
				$_SESSION['st_err1'] = $err_check;
	 		if(isset($_POST['checkout_submit'])){
	 			if (empty($_SESSION['st_err'])&& empty($_SESSION['st_err1'])) {
	 				$user_login = $data['st_email'];
	 		$user_email = $data['st_email'];
	 		$check = is_user_logged_in();
	 		if($check==1)
	 		{
	 			$user_id = wp_get_current_user()->ID;
	 		}
	 		else
	 		{
	 			$user_id = register_new_user($user_login, $user_email);
	 			if (is_wp_error($errors) ) {
				echo "Email already exists !!!";
				exit();
				}
	 		}
			update_user_meta( $user_id,'first_name', $data['st_first_name']);
			update_user_meta( $user_id,'last_name', $data['st_last_name']);
			update_user_meta( $user_id,'st_phone', $data['st_phone']);
			update_user_meta( $user_id,'st_address', $data['st_address']);
			update_user_meta( $user_id,'st_address2', $data['st_address2']);
			update_user_meta( $user_id,'st_city', $data['st_city']);
			update_user_meta( $user_id,'st_province', $data['st_province']);
			update_user_meta( $user_id,'st_zip_code', $data['st_zip_code']);
			update_user_meta( $user_id,'st_country', $data['st_country']);
			update_user_meta( $user_id,'st_note', $data['st_note']);
			global $wpdb;
			$stss = $_SESSION['st_cart'];
			$key = $stss['room_id'];
            $cart_dt= bookcart::inst()->__stGetInfoRoom($key);
			$start = convert_date_format($stss['start']);
            $startday= strtotime($start);
            $end = convert_date_format($stss['end']);
            $endday= strtotime($end);
            $night = abs($endday-$startday);
            $sl_night = floor($night/(60*60*24));
            if ($sl_night>1) {
                $price = $sl_night * $cart_dt[3]['st_contact_price_field'][0];
            }
            else {
                $price = $cart_dt[3]['st_contact_price_field'][0];
            }
            $money = $price + $price*0.1;
			$table = 'wp_bill';
			$data = array(
				'bill_id' => '',
				'user_id' => $user_id,
				'room_id' => $stss['room_id'],
				'checkin' => $stss['start'],
				'checkout' => $stss['end'],
				'totalmoney' => $money,
				'date_order'=> date('d-m-Y')
			);
			$format = array('%s','%d');
			$wpdb->insert($table,$data,$format);
			$my_id = $wpdb->insert_id;
	 				$page = get_page_by_path('bookingsucces');
 					$page_link = get_the_permalink($page);
	 				$page_link = add_query_arg('bill_id', $my_id, $page_link); 
	 				wp_redirect($page_link);
	 					exit();
	 			}
	 					
			}
	 	}
	}
	public function __stBkSucces()
	{
		if (isset($_GET['bill_id'])) {
			$key = bookcart_model::inst()->getUserId();
		 			$key2 = bookcart_model::inst()->getFullBill();
		 			$data = bookcart_model::inst()->getDataUser($key);
		 			$stdt = array($data,$key2);
		 			return $stdt;
		}
	}
	public function __stInfoSucces()
	{
		if (isset($_GET['bill_id'])) {
			$key = bookcart_model::inst()->getUserId();
		$data = get_user_meta($key);
	 	return $data;
		}	
	}
	public function __stInfoBook($key)
	{
		$data = get_user_meta($key);
	 	return $data;
	}
	public function __stHistory()
	{
		$page = get_page_by_path('bookinghistory');
 		$page_link = get_the_permalink($page);
  		if(isset($_POST['check_list'])){
		wp_redirect($page_link);
		exit();
 		}
	}
	public function __stList($key)
	 		{
	 			if(is_page_template( 'template_history.php' ))
	 			{
	 				$data = bookcart_model::inst()->getListBill($key);
	 				return $data;
	 			}	 			
	 		}
	public function __stGetInfoRoom($key)
	{
		$room_id = $key;
		$inforoom = get_post($room_id);
		$inforoommeta = get_post_meta($room_id);
		$hotel_id = $inforoommeta['st_contact_hotel_field'][0];
		$infohotel = get_post($hotel_id);
		$infohotelmeta = get_post_meta($hotel_id);
		$location = get_the_terms($hotel_id,'location');
		$data = array($infohotel,$infohotelmeta,$inforoom,$inforoommeta,$location);
		return $data;
	}
public function __stAddSesson()
{
	if(isset($_POST['room_add_to_cart'])){
		$post_data = $_POST;
		unset($post_data['room_add_to_cart']);
		unset($_SESSION['st_cart']);	
		$_SESSION['st_cart'] = $post_data;	
		$page = get_page_by_path('checkout');
 		$page_link = get_the_permalink($page);
		wp_redirect($page_link);
		exit();
	}
}
public function _stDestroyCart()
	{
		if(!empty($_GET['remove'])){
			if(isset($_SESSION['st_cart'])){
			unset($_SESSION['st_cart']);
			}
		}
	}
	public static function inst(){
        static $instane;
        if(is_null($instane)){
            $instane = new self();
        }
        return $instane;
    }
}

new bookcart();