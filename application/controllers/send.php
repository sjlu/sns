<?php

class Send extends Web_Controller {

	function index()
	{
		$this->load->library('apns');
		$this->load->model('notifications_model');

		$notifications = $this->notifications_model->dequeue();

		print_r($notifications);

		foreach ($notifications as $n)
		{
			$this->apns->send_message($n['push_key'], $n['subject'].'-'.$n['message']);
			print_r($n);
		}
	}

}