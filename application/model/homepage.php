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
     		'oderby' => 'post_date',
     		'order' => 'DESC',
     		
     	);
     	$query = new WP_Query( $args );

     	return $query;

 
      }
      public function addColumnForPostTable(){
        global $wpdb;
        $version ='1.1.1';
        $db_version = get_option('st_post_column');

        if($db_version != $version)
        {
            $sql =" ALTER TABLE {$wpdb->prefix}posts ADD price varchar(100)   ";        
            update_option('st_post_column', $version);
            $wpdb->query($sql);
        }

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

