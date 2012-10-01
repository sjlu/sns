<?php

class Notifications extends API_Controller {

	function index_get()
	{
		$duid = $this->get('duid');

		if (empty($duid))
			$this->error_response(100);

		$this->load->model('notifications_model');
		$this->response($this->notifications_model->get_notifications_by_duid($duid));
	}

}