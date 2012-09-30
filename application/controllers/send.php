<?php

class Send extends Web_Controller {

	function index()
	{
		$this->load->library('apns');
		$this->load->model('notifications_model');

		$notifications = $this->notifications_model->dequeue(1);

		foreach ($notifications as $n)
			$this->apns->send_message($n['push_key'], $n['subject'].'-'.$n['message']);
	}

}