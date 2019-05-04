<?php 


/*
@package sunsettheme
===============================
Admin Page
===============================
 */

function hotel_add_admin_page()
{
	add_menu_page( 'Shinetheme option', 'Shinetheme', 'manage_option', 'custom-setting-hotel', 'hotel_custom_setting');
	add_action( 'admin_init','hotel_custom_setting' );
}
add_action('admin_menu','hotel_add_admin_page');


function hotel_custom_setting()
{

}

 ?>