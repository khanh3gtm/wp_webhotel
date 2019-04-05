<?php  
class Route{

	public $c;
	public function __construct() {
		/**
		 * Load các function bên dưới vào trong hàm khởi tạo
		 */
		$this->__loadController();
		$this->__callMethod();
	}
	// Funtion load file và khởi tạo controller dưa vào tham số trong biến $_GET
	public function __loadController()
	{
		$controller = isset($_GET['c']) ? $_GET['c'] :'homepage';
		$file_controller = 'controller/' . $controller . '.php';
		if(file_exists($file_controller))
		{
			require_once $file_controller;
			$this->c = new $controller;
			$this->c->loadModel($controller); 
		}
	}

	//Function gọi phương thức  của controller dựa vào $_GET
 	public function __callMethod()
 	{
 	
 		$action = isset($_GET['a']) ? $_GET['a'] :'view';
 		$this->c->$action();

 	}
	
}

 ?>