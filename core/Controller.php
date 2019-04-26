<?php 
 class Controller{
 	public $model;
 	public $view;
 	public function __construct()
 	{
 		//Khởi tạo đối tượng trong controll base

		add_action('init', array($this, 'register_my_session'));
 		$this->view = new View($this->getCartData());
 	}

 	function register_my_session()
	{
	  if( !session_id() )
	  {
	    session_start();
	  }
	}


 	//Phương thức load Model trong controller
 	public function loadModel($name, $return = false)
 	{
 		$file_model = 'model'. $name . '.php';
 		if(file_exists($file_model)){
 			require_once $file_model;
 			$name_model = $name .'_model';
 			if(!$return)
 				$this->model = new $name_model();
 			else{
 				$c_model = new $name_model();
 				return $c_model;
 			}
 		}
 	}
 	public function getCartData(){
 		if(isset($_SESSION['st_cart'])){
 			$ss = $_SESSION['st_cart'];
 			//$cModel = $this->loadModel('bookcart', true);
 			//$dt_cart = bookcart::inst()->__stGetInfoRoom($key);
 			//dd($dt_cart);
 			return $dt_cart;
 		}
 		return '';
 	}
 }
?>