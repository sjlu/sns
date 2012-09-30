<?php

class Users_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function encode_password($password)
	{
		$salt = $this->config->item('encryption_key');
		return sha1($password . $salt);
	}

	function get_user($id)
	{
		$this->db->select(array('id', 'email'))
			->where('id', $id)
			->from('users');

		$query = $this->db->get();

		return $query->result_row();
	}

	function email_exists($email)
	{
		$this->db->where('email', $email)
			->from('users');

		if (!$this->db->count_all_results())
			return false;
		
		return true;
	}

	function create($email, $password)
	{
		$this->load->library('encrypt');
		$password = $this->encode_password($password);

		$this->db->set('email', $email)
			->set('password', $password);

		$this->db->insert('users');

		return array('id' => $this->db->insert_id(), 'email' => $email);
	}

	function validate($email, $password)
	{
		$this->load->library('encrypt');

		$password = $this->encode_password($password);

		$this->db->select(array('id', 'email'))
			->where('email', $email)
			->where('password', $password)
			->from('users');

		$query = $this->db->get();

		if (!$query->num_rows())
			return false;

		return $query->row_array();
	}

}