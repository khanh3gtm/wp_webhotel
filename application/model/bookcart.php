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
                WHERE table_schema = 'wp_db'
                AND table_name = 'wp_bill'";
        $res = $wpdb->query($data);
       //var_dump($wpdb->get_var($data));
        if($res==0)
        {
            $sql = "CREATE table wp_bill(
            bill_id bigint(11) unsigned auto_increment primary key,
            user_id bigint(11) not null,
            room_id bigint(20) not null,
            checkin varchar(100) not null,
            checkout varchar(100) not null,
            totalmoney double not null,
            date_order varchar(100)
            )";   
            $this->query($sql);
        }
    }

    public static function inst(){
        static $instane;
        if(is_null($instane)){
            $instane = new self();
        }
        return $instane;

    }
}