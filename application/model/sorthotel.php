<?php 
class st_sidebar_model extends Model 
{
	
	public function __construct()
	{
		parent::__construct();
	}
	public function sortHotel()
	{
		$args = array(
			'post_type'=>'hotel',
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
				case 'low':
					$args['meta_key']='_owner';
					$args['orderby']='_owner';
					$args['order']='ASC';
					break;
				case 'hight':
					$args['meta_key']='_owner';
					$args['orderby']='_owner';
					$args['order']='DESC';
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
	 public static function inst(){
        static $instane;
        if(is_null($instane)){
            $instane = new self();
        }
        return $instane;
    }
}










 ?>