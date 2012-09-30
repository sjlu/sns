<?php

class User_model extends CI_Model {

	function __construct()
	{
		$this->load->database();
	}

	private function email_exists($email)
	{
		$this->db->where('email', $email)
			->from('users');

		if (!$this->db->count_all_results())
			return true;
		
		return false;
	}

	function create($email, $password)
	{
		$this->load->libray('encrypt');
		$password = $this->encrypt->encode($password);

		$this->db->set('email', $email)
			->set('password', $password);

		$this->db->insert('users');

		return true;
	}

	function validate($email, $password)
	{
		$this->load->library('encrypt');

		$password = $this->encrypt->encode($password);

		$this->db->where('email', $email)
			->where('password', $password);

		if ($this->db->count_all_results())
			return true;

		return false;
	}

}