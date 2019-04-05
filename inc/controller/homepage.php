<?php 
  /**
  * 
  */
  class HomePage extends Controller
  {
  	
  	public function view(){
  	 $res	 = $this->model->getHotel(4,'hotel_price');
     $data_city = $this->model->getCity(6,'city.city_id');
     $data = $this->model->getListCity();
  		$this->view->render('site/homepage',array('data' => $res,'data_city' => $data_city, 'dataListCity'=>$data));    
  	}
     public function search()
    {
        $key = $_GET['cityid'];
        $data = $this->model->getCity();
        if (!empty($key)) {
            $res = $this->model->searchData($key);
            $page = $this->model->slicePage($key);
        } else {
            $res = $this->model->getAllSearch();
            $page = $this->model->slicePage();
        }

        $count = count($res);

        $paged = isset($_GET['page']) ? $_GET['page'] : 1;
        $offset = ($paged - 1) * 12;
        if (empty($key)) {
            $result = $this->model->getAllSearch($offset, 12);
        } else {
            $result = $this->model->searchData($key, $offset, 12);
        }


        $this->view->render('site/slidebar_search', array('count' => $count, 'data' => $result, 'data_city' => $data, 'key' => $key, 'page' => $page));
    }


  }
 ?>