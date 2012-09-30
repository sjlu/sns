<?php
require(APPPATH.'libraries/REST_Controller.php');

class API_Controller extends REST_Controller
{
	function __construct()
	{
		parent::__construct();
		
		$this->load->library('migration');
		
		if (!$this->migration->current())
		   show_error($this->migration->error_string());
	}

	function error_response($error_code)
	{
		$errors = array(
			'1' => 'Email is not registered or password is invalid.',
			'100' => 'Inputs are missing.',
			'101' => 'Email is invalid.',
			'102' => 'Email has already been used.',
			'103' => 'Password is too short.'
		);

		if (isset($errors[$error_code]))
			$this->response(array('error' => array('code' => $error_code, 'message' => $errors[$error_code])), 400);

		$this->response(array('error' => array('code' => 500, 'message' => 'Unknown error.')));
	}
}