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
				case 'hight':
					$args['meta_key']='st_contact_price_field';
					$args['orderby']='st_contact_price_field';
					$args['order']='ASC';
					break;
				case 'low':
					$args['meta_key']='st_contact_price_field';
					$args['orderby']='st_contact_price_field';
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