<?php 

class StSidebar extends Controller
{
	
	function __construct()
	{
		parent::__construct();
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
		$sort=StSidebarModel::inst()->sortHotel();
		return $sort;


	} 
	public static function inst(){
 			static $instane;
 			if(is_null($instane)){
 				$instane = new self();
 			}
 			return $instane;
 		}


}
new StSidebar();

 ?>