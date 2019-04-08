<?php

class Slidebar_Model extends Model {
    public function __construct() {
        parent::__construct();
        
    }
    // Start cuong
    public function getPage()
    {
      $sql="SELECT *, MIN(room.price)AS hotel_price,ROUND(AVG(room.starnum),1) AS 'hotel_point' FROM hotel  
      INNER JOIN city ON hotel.city_id = city.city_id
      INNER JOIN room ON hotel.hotel_id=room.hotel_id 
      GROUP BY hotel.hotel_id";

      $res = $this->query($sql);   
      $num = mysqli_num_rows($res);
      $page = ceil($num / 12);
      
      return $page;
  }

  public function sortHotel($offset='', $limit=''){
    $orderby = '';
    if(isset($_GET['optradio']))
        $orderby = $_GET['optradio'];
        $sql="SELECT *, MIN(room.price)AS hotel_price,ROUND(AVG(room.starnum),1) AS 'hotel_point' FROM hotel  
        INNER JOIN city ON hotel.city_id = city.city_id
        INNER JOIN room ON hotel.hotel_id=room.hotel_id 
        GROUP BY hotel.hotel_id ";
    
    if(!empty($orderby)){
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

             case 'new':
            $sql .= " ORDER BY hotel.hotel_id DESC";
            break;


        }
    }
    if (!empty($limit)) {
      $sql.=" LIMIT {$offset},{$limit}";
  }

    $res = $this->query($sql);   


    $data = [];

    if($res&&$res->num_rows > 0){
        while($row = $res->fetch_assoc()){
            $data[] = $row;

        }
    }

    return $data;
}
// end cuong
// 



// Start quan
 public function getCity()
    {
        $sql = "SELECT * FROM city";
        $res = $this->query($sql);


        $data = [];

        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                $data[] = $row;

            }
        }

        return $data;

    }

    public function getHotel($key)
    {
        $sql = "SELECT * FROM city c JOIN hotel h ON c.city_id=h.city_id WHERE c.city_id=$key";
        $res = $this->query($sql);


        $data = [];

        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                $data[] = $row;

            }
        }
        return $data;
    }

    public function slicePage($key = '')
    {
        if ($key != '') {

            $sql = "SELECT *,MIN(room.price)AS hotel_price,ROUND(AVG(room.starnum),1) AS 'hotel_point' FROM hotel  
                                       INNER JOIN city ON hotel.city_id = city.city_id
                                       INNER JOIN room ON hotel.hotel_id=room.hotel_id 
                                       WHERE city.city_id='$key'
                                       GROUP BY hotel.hotel_id";
        } else {
            $sql = "SELECT *, MIN(room.price)AS hotel_price,ROUND(AVG(room.starnum),1) AS 'hotel_point' FROM hotel  
                                       INNER JOIN city ON hotel.city_id = city.city_id
                                       INNER JOIN room ON hotel.hotel_id=room.hotel_id 
                                       GROUP BY hotel.hotel_id";
        }
        $res = $this->query($sql);
        $num = mysqli_num_rows($res);
        $page = ceil($num / 12);
        return $page;
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

    public function getAllSearch($offset = '', $limit = '')
    {
        $orderby = '';
        if (isset($_GET['optradio']))
            $orderby = $_GET['optradio'];
        $sql = "SELECT *, MIN(room.price)AS hotel_price,ROUND(AVG(room.starnum),1) AS 'hotel_point' FROM hotel  
        INNER JOIN city ON hotel.city_id = city.city_id
        INNER JOIN room ON hotel.hotel_id=room.hotel_id 
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

        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                $data[] = $row;

            }
        }

        return $data;

    }
    // end quan

}