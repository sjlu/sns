<?php 

class Register extends Web_Controller {

	function index()
	{
		$this->load->view('include/header');
      $this->load->view('register');
      $this->load->view('include/footer');
	}

}