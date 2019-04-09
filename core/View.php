<?php 
  
class View{
	public $cart = '';
	public function __construct($_cart = array()){
		$this->cart = $_cart;
	}
	public function render($name,$data,$noInclude = false)
	{
		extract($data);
		$cart_data = $this->cart;
		if($noInclude == true){
			include 'view/' . $name . '.php';
		}
		else {
			include 'view/header.php';
			include 'view/' . $name . '.php';
			include 'view/footer.php';
		}
	}
}  

 ?>