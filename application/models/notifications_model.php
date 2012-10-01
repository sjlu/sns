<?php

class Notifications_Model extends CI_Model {

	function __construct()
	{
		parent::__construct();

		$this->load->database();
	}

	function get_notifications_by_duid($duid, $limit = 100)
	{
		$this->db->where('devices.duid', $duid)
			->join('keys', 'devices.user_id = keys.user_id')
			->join('notifications', 'keys.id = notifications.key_id')
			->order_by('notifications.timestamp', "desc")
			->select('notifications.id, notifications.subject, notifications.message, notifications.timestamp')
			->limit(100)
			->from('devices');

		$query = $this->db->get();

		return $query->result_array();
	}

	private function queue_key_exists($key)
	{
		$this->db->where('queue', $key)
			->from('notifications');

		if (!$this->db->count_all_results())
			return false;
		
		return true;
	}

	function enqueue($key, $subject, $message)
	{
		$this->db->set('key_id', $key)
			->set('subject', $subject)
			->set('message', $message);

		$this->db->insert('notifications');

		return true;
	}

	function dequeue()
	{
		$this->load->helper('string');
		$string = random_string('unique');
		while($this->queue_key_exists($string))
			$string = random_string('unique');

		$this->db->set('queue', $string)
			// ->limit($limit)
			->where('queue', null)
			->update('notifications');

		$this->db->where('queue', $string)
			->select('notifications.subject, notifications.message, devices.push_key')
			->join('keys', 'notifications.key_id = keys.id', 'left')
			->join('devices', 'keys.user_id = devices.user_id', 'left')
			->from('notifications');

		$query = $this->db->get();

		return $query->result_array();
	}

}