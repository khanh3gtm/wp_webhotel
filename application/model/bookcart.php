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
    	var_dump(444);
    	$sql = "create table wp_bill(
    		bill_id bigint(11) unsigned auto_increment primary key,
    		email varchar(100) not null,
    		room_id bigint(20) not null,
    		checkin varchar(100) not null,
    		checkout varchar(100) not null,
    		totalmoney double not null,
    		date_order varchar(100)
	    )";
	    $this->query($sql);
    }
}