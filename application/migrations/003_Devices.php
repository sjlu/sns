<?php

class Migration_Devices extends CI_Migration
{
	function up()
	{
		/**
		 * Devices table
		 */
		$fields = array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 5,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'user_id' => array(
				'type' => 'INT',
				'constraint' => 5,
				'unsigned' => TRUE,
			),
			'duid' => array(
				'type' => 'VARCHAR',
				'constraint' => 128
			),
			'push_key' => array(
				'type' => 'TEXT',
				'null' => true
			)
		);

		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->add_key('user_id', FALSE);
		$this->dbforge->add_key('duid', FALSE);
		$this->dbforge->create_table('devices');
	}

	function down()
	{
		$this->dbforge->drop_table('devices');
	}
}