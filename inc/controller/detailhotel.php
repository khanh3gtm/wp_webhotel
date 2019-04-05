<?php
/**
 * Created by PhpStorm.
 * User: Rich Boy
 * Date: 3/6/2019
 * Time: 11:04 AM
 */
class DetailHotel extends Controller{
    public function view(){
     
        $hotel_id='';
        if(isset($_GET['hotel_id'])){
          $hotel_id = $_GET['hotel_id'];
          $data_hotel = $this->model->getHotel($hotel_id);
          $data_fac = $this->model->getFacilities($hotel_id);
          $data_room = $this->model->getListRoom($hotel_id);
      }
      else
      {
       $data_hotel = $this->model->getHotel(1);
       $data_fac = $this->model->getFacilities(1);
       $data_room = $this->model->getListRoom(1);  
   }
   
   $res = $this->model->getListHotel(4,'hotel_name');
   $this->view->render('site/detailhotel',array('data' => $res,'data_hotel' => $data_hotel,'data_fac' => $data_fac,'data_room' => $data_room));

}

}