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
		add_action('init', array($this, '__stCheckErr'),10,1);
		add_action('init', array($this, '__stAddSesson'));
		add_action('init', array($this, '_stDestroyCart'));
				//add_action('init', array($this, 'sendmail'));

	}

	public function __stCheckoutHandler(){
		bookcart_model::inst()->taobang();
	}
	public function __stBookingSucces()
	{
			if(isset($_POST['checkout_submit'])){
	 		$data = $_POST;
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
	 		$page_id = '1801';
	 		$page_link = get_the_permalink($page_id);// lấy đường dẫn theo page id
	 		$page_link = add_query_arg('bill_id', $my_id, $page_link); //thêm query string vào sau đường dẫn.
	 		dd($page_link);die;
	 		if(isset($_POST['checkout_submit'])){
	 			dd($page_link);
	 			wp_redirect($page_link);//chuyển trang
	 			exit();
	 		}
	 	}
	}
	public function __stBkSucces()
	 		{
	 			$key = bookcart_model::inst()->getUserId();
	 			$key2 = bookcart_model::inst()->getFullBill();
	 			$data = bookcart_model::inst()->getDataUser($key);
	 			$stdt = array($data,$key2);
	 			return $stdt;
	 		}
	public function __stInfoSucces()
	{
		$key = bookcart_model::inst()->getUserId();
		$data = get_user_meta($key);
	 	return $data;
	}
	public function __stInfoBook($key)
	{
		$data = get_user_meta($key);
	 	return $data;
	}
	public function __stHistory()
	{
		//$my_id = bookcart_model::inst()->getUserid();
		$page_id = '1813';
 		$page_link = get_the_permalink($page_id);
 		//$page_link = add_query_arg('user_id', $my_id, $page_link); //thêm query string vào sau đường dẫn.
 		if(isset($_POST['check_list'])){
 			//dd($page_link);
 			wp_redirect($page_link);//chuyển trang
 			exit();
 		}
	}
	public function __stList($key)
	 		{
	 			$data = bookcart_model::inst()->getListBill($key);
	 			return $data;
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
	public function __stCheckErr($err = false)
	{
		if(isset($_POST['checkout_submit'])){
			$data = $_POST;
			$error = array();
			if(!isset($data['term_condition']) || $data['term_condition'] != '1'){
				$err_checkout = array();
				array_push($err_checkout, 'Please tick a checkbox.');		
			}
			$err_checkout = array();

			if (empty($_POST['st_email'])) {
			    array_push($err_checkout, '  Email is required.');
		        $this->view($err_checkout);
		        return;
		    }
			if (!preg_match('/^[_a-z0-9-]*@[a-z0-9-]+(\.[a-z0-9-]+)$/', $_POST['st_email']))
		    {
		    	array_push($err_checkout, '  This email is not valid. Please re-enter. ');
				$this->view($err_checkout);	
				return;
		    }   
		}
		return $error;
	}
public function __stAddSesson()
{

	if(isset($_POST['room_add_to_cart'])){
		$post_data = $_POST;
		unset($post_data['room_add_to_cart']);
		unset($_SESSION['st_cart']);	

	
		$_SESSION['st_cart'] = $post_data;	


		$page_id = '1798';
 		$page_link = get_the_permalink($page_id);
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
	public function sendmail()
	{
		$to = 'khanh3gtm@gmail.com';
		$subject = 'The subject';
		$body = 'The email body content';
		$headers = array('Content-Type: text/html; charset=UTF-8');
 
wp_mail( $to, $subject, $body, $headers );
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