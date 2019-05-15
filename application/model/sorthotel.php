<?php 
class StSidebarModel extends Model 
{
	
	public function __construct()
	{
		parent::__construct();
	}


	public function sortHotel()
	{
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		if(!empty(get_option('pagination_hotel'))){
			$args = array(
			'post_type'=>array('hotel'),
			 'posts_per_page' => get_option('pagination_hotel'),
			 'paged' => $paged,

		);
		}else{
			$args = array(
			'post_type'=>array('hotel'),
			 'posts_per_page' => 6,
			 'paged' => $paged,

		);
		}
		

	if(isset($_GET['optradio'])){
			switch ($_GET['optradio']) {
				case 'name_az':
					$args['orderby'] = 'title';
					$args['order'] = 'ASC';
					break;
				case 'name_za':
					$args['orderby'] = 'title';
					$args['order'] = 'DESC';
					break;
				case 'hight':
					
					$args['orderby'] = 'price';
					$args['order'] = 'DESC';
					break;
					
				case 'low':
			
					$args['orderby'] = 'price';
					$args['order'] = 'ASC';
					break;
			
					
				case 'new':
					$args['orderby']='date';
					$args['order']='DESC';
					break;
				default:
					$args['orderby']='date';
					$args['order']='ASC';
					break;
			}
		}
				
			if(isset($_GET['cityid'])&&!empty($_GET['cityid']))
			{
				$cityid=$_GET['cityid'];
				$args['tax_query']= array(
							array(
								'taxonomy' => 'location',
								'field'    => 'term_id',
								'terms'    => $cityid,
							)
						
			);
				
			}
			else if(!isset($_GET['cityid'])&&empty($_GET['cityid']))
			{
				return $args;
			}

		return $args;



		
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