<?php 
  /**
  * 
  */
  class Model extends mysqli
  {
  	
  	function __construct()
  	{
  		parent::__construct('localhost','root','','webtravel',3306,'');
    }
  }
 ?>