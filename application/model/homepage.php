<?php
/**
 * Created by PhpStorm.
 * User: Jream
 * Date: 2/16/2019
 * Time: 1:52 PM
 */
class HomePage_Model extends Model {
	public function __construct() {
        parent::__construct();
        
	}

	// start Manh

    public function getHotel($limit = false,$values){
	    $sql = "SELECT *,MIN(room.price) AS 'hotel_price',ROUND(AVG(room.price),2) AS 'medium_price',ROUND(AVG(room.starnum),1) AS 'hotel_point' FROM hotel INNER JOIN room ON hotel.hotel_id = room.hotel_id INNER JOIN city ON hotel.city_id = city.city_id GROUP BY hotel_name ORDER BY $values  ";

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
    public function getCity($limit = false,$values)
    {
        $sql = "SELECT *,COUNT(hotel_name) AS 'column_hotel' FROM city INNER JOIN hotel ON city.city_id = hotel.city_id GROUP BY city.city_id ORDER BY $values DESC" ;
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
    // end Manh
    // Start Hoa
    public function getListCity()
    {
        $sql="SELECT * FROM city";
        $res = $this->query($sql);
        $data = [];

        if($res->num_rows > 0){
            while($row = $res->fetch_assoc()){
                $data[] = $row;
            }
        }
        return $data;
    
  }
  
  public function searchData($key, $offset = '', $limit = '')
    {
        $orderby = '';
        if (isset($_GET['optradio']))
            $orderby = $_GET['optradio'];
        $sql = "SELECT *,MIN(room.price)AS hotel_price,ROUND(AVG(room.starnum),1) AS 'hotel_point' FROM hotel  
                                       INNER JOIN city ON hotel.city_id = city.city_id
                                       INNER JOIN room ON hotel.hotel_id=room.hotel_id 
                                       WHERE city.city_id='$key'
                                       GROUP BY hotel.hotel_id";

        

        if (!empty($orderby)) {
            switch ($orderby) {
                case 'low':
                    $sql .= " ORDER BY hotel_price ASC";
                    break;

                case 'hight':
                    $sql .= " ORDER BY hotel_price DESC";
                    break;
                case 'name_az':

                    $sql .= " ORDER BY hotel.hotel_name ASC";
                    break;
                case 'name_za':
                    $sql .= " ORDER BY hotel.hotel_name DESC";
                    break;

            }
        }
        if ($limit != '') {
            $sql .= " LIMIT {$offset},{$limit}";
        }

        $res = $this->query($sql);

        $data = [];

        if ($res && $res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                $data[] = $row;

            }
        }

        return $data;
    }
    // end Hoa

}