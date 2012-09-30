<?php

class Keys_model extends CI_Model {

	function __construct()
	{
		parent::__construct();

		$this->load->database();
	}

	private function check_key_exists($key)
	{
		if (empty($key))
			return true;

		$this->db->where('key', $key)
			->from('keys');

		if (!$this->db->count_all_results())
			return false;
		
		return true;
	}

	private function generate_key()
	{
		$this->load->helper('string');
		$key = random_string('unique');
		return $key;
	}

	private function generate_secret()
	{
		$this->load->helper('string');
		$secret = random_string('alnum', 64);
		return $secret;
	}

	function add_key($user_id)
	{
		$key = null;
		while (check_key_exists($key))
			$key = $this->generate_key();

		$secret = $this->generate_secret();

		$this->db->set('user_id', $user_id)
			->set('key', $key)
			->set('secret', $secret)
			->insert('keys');

		return array('key' => $key, 'secret' => $secret);
	}

	function delete_key($user, $key)
	{
		if (!$this->check_key_exists($key))
			return false;

		$this->db->where('key', $key)
			->where('user_id', $user)
			->delete('keys');

		return true;
	}

	function get_keys($user)
	{
		$this->db->where('user_id', $user)
			->select(array('key', 'secret'))
			->from('keys');

		$query = $this->db->get();

		return $query->result_array();
	}

}