<?php 

class st_sidebar extends Controller
{
	
	function __construct()
	{
		parent::__construct();
		//add_action('init',array($this,'sortListHotel'));
		//add_action('init',array($this,'searchListHotel'));	
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
	public function searchListHotel()
	{
		$this->inst()->sortListHotel();
		$search=st_sidebar_model::inst()->searchHotel();
		return $search;

	}
	public function pagePagination()
	{
		$paged=st_sidebar_model::inst()->pagePagination();
		return $paged;
	}

	// public function getArgsSearchHotel(){
	// 	$args = array(
	// 		'post_type'=>'hotel',
	// 		'posts_per_page'=>'-1'
	// 	);

	// 	if(isset($_GET['optradio'])){
	// 		switch ($_GET['optradio']) {
	// 			case 'name_az':
	// 				$args['orderby'] = 'title';
	// 				$args['order'] = 'ASC';
	// 				break;
	// 			case 'name_za':
	// 				$args['orderby'] = 'title';
	// 				$args['order'] = 'DESC';
	// 				break;
				
	// 			default:
	// 				# code...
	// 				break;
	// 		}
	// 	}

	// 	return $args;
	// }

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