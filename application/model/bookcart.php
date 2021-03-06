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
    public function taobang()
    {
        global $wpdb;
        $data = "SELECT table_name
                FROM information_schema.tables
                WHERE table_schema = 'wordpress'
                AND table_name = '{$wpdb->prefix}bill'";
        $res = $wpdb->query($data);
        if($res==0)
        {
            $sql = "CREATE table {$wpdb->prefix}bill(
            bill_id bigint(11) unsigned auto_increment primary key,
            user_id bigint(11) not null,
            room_id bigint(20) not null,
            checkin varchar(100) not null,
            checkout varchar(100) not null,
            totalmoney double not null,
            date_order varchar(100)
            )";
            $wpdb->query($sql);
        }
    }
    public function getUserId()
    {
        global $wpdb;
       $key = $_GET['bill_id'];
       $sql = "SELECT user_id from {$wpdb->prefix}bill where bill_id = $key";
       $key1= $wpdb ->get_var($sql);
       return $key1;
    }
    public function getFullBill()
    {
        global $wpdb;
       $key = $_GET['bill_id'];
       $sql = "SELECT * from {$wpdb->prefix}bill where bill_id = $key";
       return array_shift($wpdb->get_results($sql));
    }
    public function getDataUser($key)
    {
        global $wpdb;
        $data = "SELECT * from {$wpdb->prefix}users where ID = $key";
        //$res = $wpdb->get_results($data);
       $res = array_shift($wpdb->get_results($data));
       return $res;
    }
    public function getListBill($key)
    {
        global $wpdb;
       $sql = "SELECT * from {$wpdb->prefix}bill where user_id = $key";
       $res = $wpdb->get_results($sql);
       return $res;
    }

    public static function inst(){
        static $instane;
        if(is_null($instane)){
            $instane = new self();
        }
        return $instane;
    }
}