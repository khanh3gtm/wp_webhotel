<?php 
/**
 * 
 */
class homepage_model extends Model
{
	
	 public function __construct() {
        parent::__construct();
    }
     public function __ListHotel(){
     	global $wpdb;
     	$args = array(
     		'post_type' => 'hotel',
     		'posts_per_pages' => -1,
     		'oderby' => 'ID',
     		'order' => 'ASC',
     		
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
?>