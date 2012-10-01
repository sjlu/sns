<?php

class Notifications_Model extends CI_Model {

	function __construct()
	{
		parent::__construct();

		$this->load->database();
	}

	function enqueue($key, $subject, $message)
	{
		$this->db->set('key_id', $key)
			->set('subject', $subject)
			->set('message', $message);

		$this->db->insert('notifications');

		return true;
	}

	function dequeue($limit = 5)
	{
		$this->load->helper('string');
		$string = random_string('unique');

		$this->db->set('queue', $string)
			->limit($limit)
			->update('notifications');

		$this->db->where('queue', $string)
			->select('notifications.subject, notifications.message, devices.duid, devices.push_key')
			->join('keys', 'notifications.key_id = keys.id', 'left')
			->join('devices', 'keys.user_id = devices.user_id', 'left')
			->from('notifications');

		$query = $this->db->get();

		return $query->result_array();
	}

}