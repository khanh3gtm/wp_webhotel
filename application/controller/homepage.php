<?php  
 	/**
 	 * 
 	 */
 	class homepage extends Controller
 	{
 		
<<<<<<< HEAD
 	public function __construct(argument)
 		{
 			parent::__construct();

 		}
=======
 	public function __construct()
 		{
 			parent::__construct();
 			add_action('init',array($this,'__ShowListHotel'));

 		}
 	public function __ShowListHotel(){
 		$hotel = homepage_model::inst()->__ListHotel();
 		return $hotel;

 	}	
>>>>>>> 512c56d3eed902e5b87d23433342015941abc6b2
 		public static function inst(){
 			static $instane;
 			if(is_null($instane)){
 				$instane = new self();
 			}
 			return $instane;
 		}
 			
 	}
 	new homepage();
 	
