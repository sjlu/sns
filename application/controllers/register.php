<?php 

class Register extends Web_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->helper('form');
	}

	private function view($message = array())
	{
		$this->load->view('include/header');
      $this->load->view('register', $message);
      $this->load->view('include/footer');
	}

	function index()
	{
		if ($this->input->post("submit"))
		{
			$email = $this->input->post("email");
			$password = $this->input->post("password");
			$confirm_password = $this->input->post("confirm_password");

			if (empty($email) || empty($password) || empty($confirm_password))
				return $this->view(array('error' => 'Please provide all fields.'));

			if (strlen($password) < 6)
				return $this->view(array('error' => 'Password length is too short.'));

			if ($password !== $confirm_password)
				return $this->view(array('error' => 'Passwords do not match.'));

			$this->load->helper('email');
			if (!valid_email($email))
				return $this->view(array('error' => 'Not a valid email address.'));

			$this->load->model('users_model');
			if ($this->users_model->email_exists($email))
				return $this->view(array('error' => 'User account already exists.'));

			$this->users_model->create($email, $password);
			return redirect('login');
		}

		return $this->view();
	}

}