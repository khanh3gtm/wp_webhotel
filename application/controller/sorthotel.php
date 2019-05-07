<?php 

class st_sidebar extends Controller
{
	
	function __construct()
	{
		parent::__construct();
		//add_action('init',array($this,'sortListHotel'));
		//add_action('init',array($this,'searchListHotel'));
		add_shortcode('total_posts','wpb_total_posts');	
	}

	public function startInjectSQLQuery(){
		add_filter( 'posts_orderby', array($this, 'addOrderByFilterHotel'), 10, 2 );
		
	}

	
	public function endInjectSQLQuery(){
		remove_filter( 'posts_orderby', array($this, 'addOrderByFilterHotel'), 10, 2 );
		
	}

	public function addOrderByFilterHotel($order_clause, $query){
		$column = $query->get('orderby');
		$column_sort = $query->get('order');
		
		if($column == 'price'){
			global $wpdb;
		  	return  $wpdb->posts
		         . '.'
		         . sanitize_key( $column )
		       . ' ' . $column_sort;
		}
		return $order_clause;
	}

	public function sortListHotel()
	{
		$sort=st_sidebar_model::inst()->sortHotel();
		return $sort;


	} 
	public function wpb_total_posts()
	{
		$total=st_sidebar_model::inst()->wpb_total_posts();
		return $total;
	}
	
	
	public static function inst(){
 			static $instane;
 			if(is_null($instane)){
 				$instane = new self();
 			}
 			return $instane;
 		}


}
new st_sidebar();

 ?>