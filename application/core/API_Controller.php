<?php
require(APPPATH.'libraries/REST_Controller.php');

class API_Base_Controller extends REST_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->main = new MY_Controller();
	}
}