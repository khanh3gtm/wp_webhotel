<?php
/**
 * Created by PhpStorm.
 * User: Jream
 * Date: 2/16/2019
 * Time: 1:52 PM
 */
class bookcart_model extends Model {
    public function __construct() {
        parent::__construct();
    }
    public function getRoomDetal($key)
    {
        $sql = "SELECT * FROM hotel inner join room on hotel.hotel_id = room.hotel_id inner join city on hotel.city_id = city.city_id WHERE  room_id= '$key'";
        $res = $this->query($sql);
        $data = [];
        if($res->num_rows > 0){
            while($row = $res->fetch_assoc()){
                $data[] = $row;
            }
        }
        return $data;
    }
    public function getInfoUser($key)
    {
        $sql = "SELECT * from user where username = '$key' ";
        $res = $this->query($sql);
        $data = [];
        if($res->num_rows > 0){
            while($row = $res->fetch_assoc()){
                $data[] = $row;
            }
        }
        return $data;
    }
    public function getInfoEmail($key)
    {
        $sql = "SELECT * from user where email = '$key' ";
        
        $res = $this->query($sql);
        $data = [];
        if($res->num_rows > 0){
            while($row = $res->fetch_assoc()){
                $data[] = $row;
            }
        }
        return $data;
    }
    public function insertBill($bill_info)
    {
        $bill_info = implode(',', $bill_info);
        $sql_oder = "INSERT INTO bill(bill_id, email, room_id, checkin, checkout,totalmoney,date_order) VALUES (null,$bill_info)";
        $data = $this->query($sql_oder);
        
        return $data;
    }
    public function searchBill($key1,$key2)
    {
        $sql="SELECT * from bill inner join user on bill.email = user.email inner join room on bill.room_id = room.room_id where (bill.email = '$key1') and (bill.room_id='$key2')";
        $res = $this->query($sql);
        $data = [];
        if($res->num_rows > 0){
            while($row = $res->fetch_assoc()){
                $data[] = $row;
            }
        }
        return $data;
    }
    public function listBill($key)
    {
        // $sql="SELECT * from bill inner join user on bill.user_id = user.user_id inner join room on bill.room_id = room.room_id inner join promotion on bill.promotion_id = promotion.promotion_id";
        $sql="SELECT * from bill inner join user on bill.email = user.email inner join room on bill.room_id = room.room_id where bill.email = '$key' ";
        $res = $this->query($sql);

        $data = [];
        if($res&&$res->num_rows > 0){
            while($row = $res->fetch_assoc()){
                $data[] = $row;
            }
        }
        return $data;
    }
    public function updateUser($value1, $value2, $value3, $value4, $value5, $value6, $value7, $value8, $value9, $value10, $value11, $key)
    {
        $query = "UPDATE user SET first_name='$value1',last_name='$value2',email='$value3',phone_number='$value4',address1='$value5',address2='$value6',city='$value7',state_province_region='$value8',zipcode_or_postal_code='$value9',country='$value10',special='$value11' WHERE user.username='$key'";
        return $this->query($query);
    }
    public function insertUser($user_info)
    {
        $user_info = implode(',', $user_info);
        $sql_user = "INSERT INTO user(user_id, username, password, role, first_name, last_name, address1, address2, city, email, regisdate, state_province_region, zipcode_or_postal_code, country, special) VALUES (null,$user_info)";
        
        $data = $this->query($sql_user);
       
        return $data;
    }
}