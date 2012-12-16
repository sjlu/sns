<?php

class Admin extends Web_Controller {

	private $user = null;

	function __construct()
	{
		parent::__construct();

		$this->user = $this->require_session();
		$this->load->model(array('keys_model', 'notifications_model'));
	}

	private function view()
	{
		$this->load->view('include/header');
		$this->load->view('admin/view', array(
			'keys' => $this->keys_model->get_keys($this->user),
			'notifications' => $this->notifications_model->get_notifications_by_user($this->user)
		));
		$this->load->view('include/footer');
	}

	function delete_key($key)
	{
		$this->keys_model->delete_key($this->user, $key);
		$this->view();
	}

	function create_key()
	{
		$this->keys_model->add_key($this->user);
		$this->view();
	}

	function index()
	{
		$this->view();
	}

}