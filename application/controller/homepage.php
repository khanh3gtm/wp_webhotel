<?php  
 	/**
 	 * 
 	 */
 	class homepage extends Controller
 	{
 		
 	public function __construct(argument)
 		{
 			parent::__construct();

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
 	
