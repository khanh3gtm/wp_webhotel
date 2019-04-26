<?php 
//load core
$arr_libfiles = array(
		'View',
		'Model',
		'Controller'
	);
	foreach ($arr_libfiles as $k=> $v) {
		$file = get_template_directory(). '/core/' . $v. '.php';
		if(file_exists($file)){
			include $file;
		}
	}
	//load model
	$arr_model = array(
		'bookcart',
		'homepage',
		'sorthotel',
		'hoteldetail'
	);
	foreach ($arr_model as $k=> $v) {
		$files = get_template_directory(). '/application/model/' . $v. '.php';
		if(file_exists($files)){
			include $files;
		}
	}
	//Size  of image
$arr_helper = array(
		
		'otf_regen_thumbs'
	);
	foreach ($arr_helper as $k=> $v) {
		$file = get_template_directory(). '/application/helpers/' . $v. '.php';
		if(file_exists($file)){
			include $file;
		}
	}

	//load controller
	$arr_admin_files = array(
		'admin' => array(
			'hotel',
			'room'
		),
		'frontend' => array(
			'homepage',
			'bookcart',
			'sorthotel',
			'hoteldetail'
		)		
	);

	foreach ($arr_admin_files as $k=> $v) {
		$file_path = '';
		if($k == 'admin'){
			$file_path = 'admin/';
		}
		foreach ($v as $key => $value) {
			$file = get_template_directory(). '/application/controller/'. $file_path . $value. '.php';
			
			if(file_exists($file)){
				include $file;
			}
		}
		/*$file = get_template_directory(). '/inc/controller/admin/' . $v. '.php';
		if(file_exists($file)){
			include $file;
		}*/
	}

 ?>