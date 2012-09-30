<?php

class Devices_model extends CI_Model {

	private function device_exists($user, $duid)
	{
		$this->db->where('user_id', $user)
			->where('duid', $duid)
			->from('devices');

		if (!$this->db->count_all_results())
			return false;

		return true;
	}

	function add_device($user, $duid, $push_key)
	{
		if ($this->device_exists($user, $duid))
			return false;

		$this->db->set('user_id', $user)
			->set('duid', $duid)
			->set('push_key', $push_key);

		$this->db->insert('devices');

		return true;
	}

	function remove_device($user, $duid)
	{
		if (!$this->device_exists($user, $duid))
			return false;

		$this->db->where('duid', $duid)
			->where('user_id', $user)
			->delete('keys');

		return true;
	}

}