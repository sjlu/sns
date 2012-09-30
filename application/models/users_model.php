<?php

class Users_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
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
		$password = $this->encrypt->encode($password);

		$this->db->set('email', $email)
			->set('password', $password);

		$this->db->insert('users');

		return array('id' => $this->db->insert_id(), 'email' => $email);
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