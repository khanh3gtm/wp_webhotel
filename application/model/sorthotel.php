<?php 
class st_sidebar_model extends Model 
{
	
	public function __construct()
	{
		parent::__construct();
	}


	public function sortHotel()
	{
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$args = array(
			'post_type'=>array('hotel'),
			 'posts_per_page' => 3,
			 'paged' => $paged,

		);

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

			if(isset($_GET['cityname'])&&!empty($_GET['cityname']))
			{
				$cityname=$_GET['cityname'];
				$args['tax_query']= array(
							array(
								'taxonomy' => 'location',
								'field'    => 'slug',
								'terms'    => $cityname,
							)
						
			);
				
			}

		return $args;



		
	}
	
		
			

	
	public function pagePagination()
	{
		
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$args = array(
											  'post_type' => array('hotel'),
											  'posts_per_page' => 2,
											  'paged' => $paged,
										
											);
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