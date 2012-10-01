<?php 

class Device extends API_Controller {

	private $USER = null;

	function __construct()
	{
		parent::__construct();
		$this->USER = $this->require_session();

		$this->load->model('devices_model');
	}

	function index_post()
	{
		$duid = $this->post('duid');
		$push_key = $this->post('push_key');

		if (empty($duid))
			$this->error_response(100);

		$added = $this->devices_model->add_device($this->USER, $duid, $push_key);

		if ($added)
			$this->response(array('success' => 'Device added.'));
		
		$updated = $this->devices_model->update_device($this->USER, $duid, $push_key);

		if ($updated)
			$this->response(array('success' => 'Device updated.'));

		$this->error_response(500);
	}

	function index_delete()
	{
		$duid = $this->delete('duid');

		if (empty($duid))
			$this->error_response(100);

		$deleted = $this->devices_model->remove_device($this->USER, $duid);

		if ($deleted)
			$this->response(array('success' => 'Device removed.'));
		else
			$this->response(array('success' => 'Device does not exist.'));
	}

}