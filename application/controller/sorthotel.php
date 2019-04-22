<?php 

class st_sidebar extends Controller
{
	
	function __construct()
	{
		parent::__construct();
		add_action('init',array($this,'SortListHotel'));	
	}
	public function sortListHotel()
	{
		$sort=st_sidebar_model::inst()->sortHotel();
		return $sort;


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