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
    
     	$args = array(
     		'post_type' => 'hotel',
     		'posts_per_page'  => 4,
     		'oderby' => 'post_date',
     		'order' => 'DESC',
     		
     	);
     	$query = new WP_Query( $args );

     	return $query;

 
      }
      public function listCity()
      {
          global $wpdb;
          $sql ="SELECT *,COUNT(object_id) AS 'column_hotel' FROM `wp_term_taxonomy` INNER JOIN wp_terms ON wp_terms.term_id=wp_term_taxonomy.term_id INNER JOIN wp_term_relationships ON wp_term_taxonomy.term_taxonomy_id=wp_term_relationships.term_taxonomy_id WHERE wp_term_taxonomy.taxonomy='location' AND wp_term_taxonomy.parent > 0 GROUP BY  wp_term_relationships.term_taxonomy_id LIMIT 0,3";
          $res = $wpdb->get_results($sql);
          return $res;

      }
      public function addColumnForPostTable(){
        global $wpdb;
        $version ='1.2.1';
        $db_version = get_option('st_post_column');

        if($db_version != $version)
        {
            $sql =" ALTER TABLE {$wpdb->prefix}posts ADD price varchar(10), ADD hotel_point varchar(10)   ";        
            update_option('st_post_column', $version);
            $wpdb->query($sql);
        }

      }
      // public function updateColumnForPostTable($key1,$key2){
      //   global $wpdb;
      //   $sql =" UPDATE wp_post "
      // }
    public static function inst(){
        static $instane;
        if(is_null($instane)){
            $instane = new self();
        }
        return $instane;
    }

}


?>

