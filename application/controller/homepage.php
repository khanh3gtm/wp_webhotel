<?php  
 	/**
 	 * 
 	 */
 	class homepage extends Controller
 	{
 		
 	public function __construct()
 		{
 			parent::__construct();
 			add_action('init',array($this,'__ShowListHotel'));

 		}
 	public function __ShowListHotel(){
 		$hotel = homepage_model::inst()->__ListHotel();
 		return $hotel;

 	}	
 		public static function inst(){
 			static $instane;
 			if(is_null($instane)){
 				$instane = new self();
 			}
 			return $instane;
 		}
 			
 	}
 	new homepage();
 	
