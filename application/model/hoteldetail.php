<?php 

/**
  * 
  */
 class hoteldetail_model extends Model
 {
 	
  public function __construct() {
        parent::__construct();
       
    }
    public function listRoom()
    {
    	$args = array(
			'post_type' =>'room',
			'meta_query' => array(
				array(
					'key'     => 'st_contact_hotel_field',
					'value'   => get_the_ID()
				),
			)
		);
		$query = new WP_Query( $args );
		return $query;
    }
    


    public static function inst(){
        static $instane;
        if(is_null($instane)){
            $instane = new self();
        }
        return $instane;
    }
 } 