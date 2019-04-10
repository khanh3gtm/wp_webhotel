<?php
/**
 * Created by PhpStorm.
 * User: Rich Boy
 * Date: 3/6/2019
 * Time: 11:09 AM
 */
class DetailHotel_Model extends Model{
    // start Manh
    public function getListHotel($limit = false,$values){
        $sql = "SELECT *,MIN(room.price) AS 'hotel_price',ROUND(AVG(room.price),2) AS 'medium_price',ROUND(AVG(room.starnum),1) AS 'hotel_point' FROM hotel INNER JOIN room ON hotel.hotel_id = room.hotel_id INNER JOIN city ON hotel.city_id = city.city_id GROUP BY hotel_name ORDER BY $values DESC";

        if($limit && is_numeric($limit)){
            $sql .= " LIMIT 0,{$limit}";
        }

        $res = $this->query($sql);
        $data = [];

        if($res->num_rows > 0){
            while($row = $res->fetch_assoc()){
                $data[] = $row;
            }
        }
        return $data;
    }
    public function getHotel($hotel_id)
    {
        $sql="SELECT *,MIN(room.price) AS 'hotel_price',ROUND(AVG(room.price),2) AS 'medium_price',ROUND(AVG(room.starnum),1) AS 'hotel_point' FROM hotel INNER JOIN room ON hotel.hotel_id = room.hotel_id INNER JOIN city ON hotel.city_id = city.city_id WHERE hotel.hotel_id = $hotel_id";

       $res = $this->query($sql);
      
        $data = [];
        if($res->num_rows > 0){
            while($row = $res->fetch_assoc()){
                $data[] = $row;
            }
        }
        return $data;

    }
    public function getFacilities($hotel_id)
    {
      $sql="SELECT * FROM serviceconn INNER JOIN hotel ON serviceconn.room_id_or_hotel_id = hotel.hotel_id 
                                      INNER JOIN service ON serviceconn.service_id = service.service_id 

                                      WHERE serviceconn.type='hotel' AND hotel.hotel_id = $hotel_id  ";

       
       $res = $this->query($sql);
      
        $data = [];
        if($res->num_rows > 0){
            while($row = $res->fetch_assoc()){
                $data[] = $row;
            }
        }
        return $data;

    } 
    // end Manh
    // start Hoa
    public function getListRoom($hotel_id)
    {
        $sql = " SELECT * FROM room WHERE hotel_id = $hotel_id ";

        $res = $this->query($sql);

        $data = [];
        if($res->num_rows >0){
            while ($row = $res->fetch_assoc()) {
                $data[] = $row;
            }
        }
        return $data;
    }
    // end Hoa
       
   
   
   
   

}