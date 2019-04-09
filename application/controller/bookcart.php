<?php
class bookcart extends Controller {
	public function __construct(){
		parent::__construct();

		add_action('init', array($this, '__stCheckoutHandler'));

	}

	public function __stCheckoutHandler(){
		dd(123);
	}

	// public function view($err=false){
	// 	if(isset($_POST['room_add_to_cart'])){
	// 		$post_data = $_POST;
	// 		unset($post_data['room_add_to_cart']);
	// 		dd($post_data);
	// 		unset($_SESSION['st_cart']);			
	// 		$_SESSION['st_cart'] = $post_data;
	// 		header('location: '.getSiteURL() .'?c=bookcart&a=view');
	// 	}
	// 	$cart_data = $_SESSION['st_cart'];
	// 	$key1=$cart_data['room_id'];
		
	// 	if(isset($_SESSION['currUser'])){
	// 		$key2=$_SESSION['currUser'];
	// 		$getinfo = $this->model->getInfoUser($key2);
	// 	}
	// 	else {
	// 		$getinfo = [];
	// 	}
	// 	$res = $this->model->getRoomDetal($key1);
	// 	$this->view->render('site/cart/view', array('data' => $res,'infouser' => $getinfo,'stss'=>$cart_data,'err'=>$err));
	// }
	// public function checkout(){
	// 	$cart_checkout = $_SESSION['st_cart'];
	// 	$key1=$cart_checkout['room_id'];
	// 	$cart_data = $this->model->getRoomDetal($key1);
	// 	if(isset($_POST['checkout_submit'])){
	// 		$data = $_POST;
	// 		if(!isset($data['term_condition']) || $data['term_condition'] != '1'){
	// 			$err_checkout = array();
	// 			array_push($err_checkout, 'Please tick a checkbox.');
			    
	// 			$this->view($err_checkout);	
	// 			return;		
	// 		}
	// 		$err_checkout = array();

	// 		if (empty($_POST['st_email'])) {
	// 		    array_push($err_checkout, '  Email is required.');
	// 	        $this->view($err_checkout);
	// 	        return;
	// 	    }
	// 		if (!preg_match('/^[_a-z0-9-]*@[a-z0-9-]+(\.[a-z0-9-]+)$/', $_POST['st_email']))
	// 	    {
	// 	    	array_push($err_checkout, '  This email is not valid. Please re-enter. ');
	// 			$this->view($err_checkout);
				
	// 			return;
	// 	    }
		    
	// 		$money = 
	// 		$cart=(array_shift($cart_data));
	// 		$start = convert_date_format($cart_checkout['start']);
 //            $startday= strtotime($start);
 //            $end = convert_date_format($cart_checkout['end']);
 //            $endday= strtotime($end);
 //            $night = abs($endday-$startday);
	// 		$sl_night = floor($night/(60*60*24));
	// 		if ($sl_night>1) {
	// 			$price = $sl_night * $cart['price']*$cart_checkout['number_room'];
	// 		}
	// 		else {
	// 			$price = $cart['price']*$cart_checkout['number_room'];
	// 		}
	// 		$totalmoney = $price + $price*0.1;;
	// 		$order_date = date('d-m-Y');
	// 		$array_insert = array(
	// 			'"' .$data['st_email']. '"',
	// 			$cart['room_id'],
	// 			'"' . $cart_checkout['start'] . '"',
	// 			'"' . $cart_checkout['end'] . '"',
	// 			$totalmoney,
	// 			'"' . $order_date . '"'				
	// 		);
	// 		$this->model->insertBill($array_insert);	
	// 	}
	// 	if(isset($_POST['checkout_submit'])){
	// 		$post_user = $_POST;
	// 		if(isset($_SESSION['currUser'])){
	// 			$key2=$_SESSION['currUser'];
	// 			$value1=$post_user['st_first_name'];
	// 			$value2=$post_user['st_last_name'];
	// 			$value3=$post_user['st_email'];
	// 			$value4=$post_user['st_phone'];
	// 			$value5=$post_user['st_address'];
	// 			$value6=$post_user['st_address2'];
	// 			$value7=$post_user['st_city'];
	// 			$value8=$post_user['st_province'];
	// 			$value9=$post_user['st_zip_code'];
	// 			$value10=$post_user['st_country'];
	// 			$value11=$post_user['st_note'];
	// 			$dataUser=$this->model->updateUser($value1,$value2,$value3,$value4,$value5,$value6,$value7,$value8,$value9,$value10,$value11, $key2);
	// 		}
	// 		else{
	// 			$regisdate= date('d-m-Y H:i:s');
	// 			$password = md5(rand(100000, 999999));
	// 			$arr_user = array(
	// 				'"' .$post_user['st_email']. '"',
	// 				'"' .$password. '"',
	// 				'3',
	// 				'"' .$post_user['st_first_name']. '"',
	// 				'"' .$post_user['st_last_name']. '"',
	// 				'"' .$post_user['st_address']. '"',
	// 				'"' .$post_user['st_address2']. '"',
	// 				'"' .$post_user['st_city']. '"',
	// 				'"' .$post_user['st_email']. '"',
	// 				'"' . $regisdate . '"',
	// 				'"' .$post_user['st_province']. '"',
	// 				'"' .$post_user['st_zip_code']. '"',
	// 				'"' .$post_user['st_country']. '"',
	// 				'"' .$post_user['st_note']. '"'
	// 			);
	// 			$dt=$this->model->getInfoEmail($post_user['st_email']);
	// 			if(empty($dt)){
	// 				$this->model->insertUser($arr_user);
	// 			}
	// 			else{
	// 				echo "Email already exists. Please login now !!!";
	// 				echo "<br>";
	// 				echo '<a href="?c=bookcart&a=view">' . 'Back' .'</a>';
	// 				exit();

	// 			}
	// 		}
	// 	}
	// 	$get_room = $this->model->getRoomDetal($key1);
	// 	$this->view->render('site/cart/booking-success',array('list'=>$data,'room'=>$get_room,'check'=>$cart_checkout));
	// }
	// public function listBill()
	// {
	// 	if(isset($_POST['check_list'])){
	// 		$post_list = $_POST;
	// 	}
	// 	$key=$post_list['st_username'];
	// 	$res= $this->model->listBill($key);
	// 	$this->view->render('site/cart/list_bill',array('list'=>$res));
	// }
	// public function destroy()
	// {
	// 	if(isset($_SESSION['currUser'])){
	// 		unset($_SESSION['currUser']);
	// 		header('location: '.getSiteURL() .'index.php');
	// 	}
	// }
	// public function dtCart()
	// {
	// 	if(isset($_SESSION['st_cart'])){
	// 		unset($_SESSION['st_cart']);
	// 		header('location: '.getSiteURL() .'index.php');
	// 	}
	// }
}

new bookcart();