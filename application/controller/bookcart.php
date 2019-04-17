<?php
class bookcart extends Controller {
	public function __construct(){
		parent::__construct();

		add_action('init', array($this, '__stCheckoutHandler'));
		add_action('init', array($this, '__stBookingSucces'));
		add_action('init', array($this, '__stBkSucces'));
		add_action('init', array($this, '__stInfoBook'),10,1);
		add_action('init', array($this, '__stInfoSucces'));
		add_action('init', array($this, '__stList'),10,1);
		add_action('init', array($this, '__stHistory'));
		add_action('init', array($this, '__stGetInfoRoom'));
		add_action('init', array($this, '__stCheckErr'));

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
			dd($user_id);
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
			$table = 'wp_bill';
			$data = array(
				'bill_id' => '',
				'user_id' => $user_id,
				'room_id' => '',
				'checkin' => '',
				'checkout' => '',
				'totalmoney' => '',
				'date_order'=> date('d-m-Y')
			);
			$format = array('%s','%d');
			$wpdb->insert($table,$data,$format);
			$my_id = $wpdb->insert_id;
			

	 		$page_id = '1801';
	 		$page_link = get_the_permalink($page_id);// lấy đường dẫn theo page id
	 		$page_link = add_query_arg('bill_id', $my_id, $page_link); //thêm query string vào sau đường dẫn.
	 		dd($page_link);
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
	 			$data = bookcart_model::inst()->getDataUser($key);
	 			return $data;
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
	public function __stGetInfoRoom()
	{
		$room_id = '1815';
		$hotel_id = '1816';
		$location = get_the_terms($hotel_id,'location');
		$inforoom = get_post($room_id);
		$infohotel = get_post($hotel_id);
		$inforoommeta = get_post_meta($room_id);
		$infohotelmeta = get_post_meta($hotel_id);

		$data = array($infohotel,$infohotelmeta,$inforoom,$inforoommeta,$location);
		return $data;
	}
	public function __stCheckErr()
	{
		if(isset($_POST['checkout_submit'])){
			$data = $_POST;
			if(!isset($data['term_condition']) || $data['term_condition'] != '1'){
				$err_checkout = array();
				array_push($err_checkout, 'Please tick a checkbox.');
			    
				$this->view($err_checkout);	
				return;		
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