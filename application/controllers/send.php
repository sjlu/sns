<?php

class Send extends Web_Controller {

	function index()
	{
		$this->load->model('notifications_model');
		$this->notifications_model->send();
	}

}