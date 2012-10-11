<?php

class Logout extends Web_Controller {

	function index()
	{
		$this->load->library("session");
      $this->session->sess_destroy();

      return redirect('/');
	}

}