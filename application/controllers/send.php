<?php

class Send extends Web_Controller {

	function index()
	{
		$this->load->library('apns');
		$this->load->model('notifications_model');

		$notifications = $this->notifications_model->dequeue();

		foreach ($notifications as $n)
		{
			$unread = $this->notifications_model->get_unread_count_by_uid($n['user_id']);
			$this->apns->send_message($n['push_key'], $n['subject'].' - '.$n['message']);
		}
	}

}