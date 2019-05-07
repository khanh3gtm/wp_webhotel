<?php  
/**
 * 
 */
class hoteldetail extends Controller
{
	
	public function __construct() {
        parent::__construct();
       
    }
    public function listRoom()
    {
    	$listRoom = hoteldetail_model::inst()->listRoom();
    	return $listRoom;
    }
    
    public static function inst(){
 			static $instane;
 			if(is_null($instane)){
 				$instane = new self();
 			}
 			return $instane;
 		}
}
new hoteldetail();