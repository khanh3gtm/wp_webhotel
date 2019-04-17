<?php
if(!function_exists('convert_date_format')){
	function convert_date_format($date){
 		//YYYY-MM-DD
 		$format = 'd/m/Y';

 		$date_format = DateTime::createFromFormat($format, $date);
		return $date_format->format('Y-m-d');
 	}
}
if(!function_exists('getSiteURL')){
	function getSiteURL(){
 		$site_url = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/';
 		return $site_url;
 	}
 }
?>