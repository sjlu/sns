<?php

class Key extends API_Controller {

	private $USER = null;

	function __construct()
	{
		parent::__construct();

		/**
		 * Session is requried for all functions
		 * in this API controller.
		 */
   	$this->load->library('session');
   	$user = $this->session->userdata('user');
   	if (!$user)
   		$this->error_response(200);

   	$this->USER = $user;

		$this->load->model('keys_model');
	}

	function index_get()
	{
		$this->response($this->keys_model->get_keys($this->USER));
	}

	function index_post()
	{
		$this->response($this->keys_model->add_key($this->USER));
	}

	function index_delete()
	{
		$key = $this->delete('key');
		if (empty($key))
			$this->error_response(100);

		$deleted = $this->keys_model->delete_key($user, $key);

		if ($deleted)
			$this->response(array('success' => 'Key removed.'));
		else
			$this->response(array('success' => 'Key does not exist.'));
	}

}