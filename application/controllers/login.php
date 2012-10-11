<?php

class Login extends Web_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->helper('form');
	}

	private function view($message = array())
	{
		$this->load->view('include/header');
      $this->load->view('login', $message);
      $this->load->view('include/footer');
	}

	function index()
	{	
		if ($this->input->post("submit"))
		{
			$email = $this->input->post("email");
			$password = $this->input->post("password");

			if (empty($email) || empty($password))
				return $this->view(array('error' => 'Please provide all fields.'));

			$this->load->model('users_model');
			if (!$user = $this->users_model->validate($email, $password))
				return $this->view(array('error' => 'Email or password is invalid.'));

	      $this->load->library("session");
         $session = array('user' => $user['id']);
         $this->session->set_userdata($session);

			return redirect('admin');
		}

		$this->view(array('info' => 'Please login to continue.'));
	}

}