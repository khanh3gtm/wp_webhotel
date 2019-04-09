<?php 
 class Controller{
 	public $model;
 	public $view;
 	public function __construct()
 	{
 		//Khởi tạo đối tượng trong controll base
 		session_start();
 		$this->view = new View($this->getCartData());
 	}
 	//Phương thức load Model trong controller
 	public function loadModel($name, $return = false)
 	{
 		$file_model = 'model/'. $name . '.php';
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
 			$cModel = $this->loadModel('bookcart', true);
 			$dt_cart = $cModel->getRoomDetal($ss['room_id']);
 			//dd($dt_cart);
 			return $dt_cart;
 		}
 		return '';
 	}
 }
?>