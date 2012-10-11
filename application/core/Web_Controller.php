<?php

class Web_Controller extends CI_Controller
{
   function __construct()
   {
      parent::__construct();
   	
		$this->load->library('migration');
		
		if (!$this->migration->current())
		   show_error($this->migration->error_string());
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