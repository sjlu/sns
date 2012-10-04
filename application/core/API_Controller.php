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
		$http_response = 402;

		$errors = array(
			'100' => 'Inputs are missing.',
			'101' => 'Email is invalid.',
			'102' => 'Email has already been used.',
			'103' => 'Password is too short.',
			'200' => 'User session is required.',
			'201' => 'API Key is not valid.',
			'300' => 'Email is not registered or password is invalid.'
		);

		// 400 - Inputs missing or bad inputs.
		if ($error_code < 200 && $error_code >= 100)
			$http_response = 400;

		// 401 - Unauthorized, bad session or bad API key.
		if ($error_code < 300 && $error_code >= 200)
			$http_response = 401;

		if (isset($errors[$error_code]))
			$this->response(array('error' => array('code' => $error_code, 'message' => $errors[$error_code])), $http_response);

		$this->response(array('error' => array('code' => 500, 'message' => 'Unknown error.')), 500);
	}

	function require_session()
	{
		/**
		 * Session is requried for all functions
		 * in this API controller.
		 */
   	$this->load->library('session');
   	$user = $this->session->userdata('user');
   	if (!$user)
   		$this->error_response(200);

   	return $user;
	}
}