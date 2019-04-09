<?php 
  /**
  * 
  */
  class Model
  {
    public function __construct() {
    }
  	
  	function query($sql)
  	{
      global $wpdb;
      //$wpdb->query($sql);
      //$wpdb->get_results($sql);
    }
  }
 ?>