<?php

class User extends API_Controller {

	function index_post()
	{
		$email = $this->post('email');
		$password = $this->post('password');

		if (empty($email) || empty($password))
			$this->error_response(100);

		$this->load->helper('email');
		if (!valid_email($email))
			$this->error_response(101);

		$this->load->model('users_model');
		if ($this->users_model->email_exists($email))
			$this->error_response(102);

		if (strlen($password) < 6)
			$this->error_response(103);

		$user = $this->users_model->create($email, $password);

		$this->response(array('success' => 'User added successfully.', 'user' => $user));
	}

}