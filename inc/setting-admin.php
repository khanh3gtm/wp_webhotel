<?php 

/*
@package shinetheme
 */
 
 function hotel_add_page_menu()
 {
  	add_menu_page( 'Shinetheme option','Shinetheme', 'manage_option','hotel-setting', 'hotel_custom_setting');

 }
 add_action('admin_menu','hotel_add_page_menu');


 


 ?>