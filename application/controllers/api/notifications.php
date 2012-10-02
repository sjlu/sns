<?php

class Notifications extends API_Controller {

	function index_get()
	{
		$duid = $this->get('duid');

		if (empty($duid))
			$this->error_response(100);

		$this->load->model('notifications_model');

		$notifications = $this->notifications_model->get_notifications_by_duid($duid);
		foreach ($notifications as &$n)
			$n['timestamp'] = date('U', strtotime($n['timestamp']));

		$this->notifications_model->mark_read_by_duid($duid);
		$this->response($notifications);
	}

}