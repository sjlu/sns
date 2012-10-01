<?php

class Notifications extends API_Controller {

	function index_get()
	{
		$user = $this->require_session(); 
		$this->load->model('notifications_model');
		$this->response($this->notifications_model->get_notifications_by_user($user));
	}

}