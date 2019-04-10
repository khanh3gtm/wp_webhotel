<!-- chien start -->
<?php
/**
 * Created by PhpStorm.
 * User: Jream
 * Date: 2/16/2019
 * Time: 1:48 PM
 */
class Room extends Controller {

	public function view()
	{
		$room_id = '';
		if(isset($_GET['room_id']))
		{
			$room_id = $_GET['room_id'];
			$room_data = $this->model->getRoom($room_id);
			$hotel_data = $this->model->getNamehotel($room_data[0]['hotel_id']);
			$amenities_data = $this->model->getAmenities($room_id);
		}
		else 
		{
			$room_data = $this->model->getRoom(2);
			$hotel_data = $this->model->getNamehotel(2);
			$amenities_data = $this->model->getAmenities(2);
		}

		$this->view->render('site/room', array('data_room' => $room_data,'data_hotel' => $hotel_data, 'data_amenities' => $amenities_data));
	}
	
}
// chien end