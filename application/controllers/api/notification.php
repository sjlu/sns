<?php

class Notification extends API_Controller {

	function index_post()
	{
		$key = $this->post('key');
		$subject = $this->post('subject');
		$message = $this->post('message');

		if (empty($key) || empty($subject) || empty($message))
			$this->error_response(100);

		$this->load->model('keys_model');
		if (!$key_id = $this->keys_model->get_key_id($key))
			$this->error_response(201);

		$this->load->model('notifications_model');
		$this->notifications_model->enqueue($key_id, $subject, $message);

		if (isset($_SERVER['SEND_ON_RECEIVE']) && $_SERVER['SEND_ON_RECEIVE'])
			exec('cd ~/www/ && ~/php/bin/php index.php send > /dev/null 2>/dev/null &');
			// $this->notifications_model->send();

		$this->response(array('success' => 'Notification queued.'));
	}

}