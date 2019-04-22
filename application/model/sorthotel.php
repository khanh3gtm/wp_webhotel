<?php 
class st_sidebar_model extends Model 
{
	
	public function __construct()
	{
		parent::__construct();
	}


	public function sortHotel()
	{
		global $wpdb;
		$args = array(
			'post_type'=>array('hotel'),
			'posts_per_page'=>'-1'
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

		return $args;



		
	}
	public function searchHotel()
	{
		// $this->inst()->sortHotel();
		
		if(isset($_GET['cityname'])&&!empty($_GET['cityname']))
		{
			$cityname=$_GET['cityname'];

			$args=array(


				'hide_empty'    => true,
				'post_type'=> 'hotel',
				'post_per_page'=>-1,
				'tax_query' => array(
					array(
						'taxonomy' => 'location',
						'field'    => 'slug',
						'terms'    => $cityname,
					)
				) ,


			);

			$query= new WP_Query($args);
			return $query;
		}
		
			

	}
	public function pagePagination()
	{
		
		$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
		$args=array(
			'base'=> get_pagenum_link(),
			'total'=>10,
			'current'=>$paged,
			'show_all'=>true,
			'format'=>'?paged=%#%',
			'prev_text'          => __('« Previous'),
			'next_text'          => __('Next »'),
			'prev_next'=> true


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