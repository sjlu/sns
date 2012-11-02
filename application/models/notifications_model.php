<?php

class Notifications_Model extends CI_Model {

	function __construct()
	{
		parent::__construct();

		$this->load->database();
	}

	function get_unread_count_by_uid($user)
	{
		$this->db->where('keys.user_id', $user)
			->where('notifications.read', 0)
			->join('notifications', 'keys.id = notifications.key_id', 'left')
			->from('keys');

		return $this->db->count_all_results();
	}

	function mark_read_by_duid($duid)
	{
		$this->db->select('keys.id')
			->where('devices.duid', $duid)
			->join('keys', 'devices.user_id = keys.user_id', 'left')
			->from('devices');

		$query = $this->db->get();

		$key_ids = array();
		foreach ($query->result_array() as $r)
			$key_ids[] = $r['id'];

		if (empty($key_ids))
			return true;

		$this->db->where_in('key_id', $key_ids)
			->where('read', 0)
			->set('read', 1)
			->update('notifications');

		return true;
	}

	function get_notifications_by_duid($duid, $limit = 50)
	{
		$this->db->where('devices.duid', $duid)
			->join('keys', 'devices.user_id = keys.user_id')
			->join('notifications', 'keys.id = notifications.key_id')
			->order_by('notifications.id', "desc")
			->select('notifications.id, notifications.subject, notifications.message, notifications.timestamp')
			->limit($limit)
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
         ->where('devices.push_key IS NOT NULL')
			->select('notifications.id, devices.user_id, notifications.subject, notifications.message, devices.push_key, keys.key')
			->join('keys', 'notifications.key_id = keys.id', 'left')
			->join('devices', 'keys.user_id = devices.user_id', 'left')
			->from('notifications');

		$query = $this->db->get();
		$results = $query->result_array();

		return array_unique($results);
	}

	function send()
	{
		$notifications = $this->dequeue();

		if (!count($notifications))
			return;

		$this->load->library('apns');

		foreach ($notifications as $n)
		{
			$unread = $this->notifications_model->get_unread_count_by_uid($n['user_id']);

			// if the message failed to send, place it back into the queue to try later
			if (!$this->apns->send_message($n['push_key'], $n['subject'].' - '.$n['message'], $unread))
				$this->enqueue($n['key'], $n['subject'], $n['message']);
		}
	}

}
