<?php

class Migration_Notifications extends CI_Migration
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
			'timestamp' => array(
				'type' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP'
			),
			'key_id' => array(
				'type' => 'INT',
				'constraint' => 5,
				'unsigned' => TRUE,
			),
			'subject' => array(
				'type' => 'VARCHAR',
				'constraint' => 128
			),
			'message' => array(
				'type' => 'TEXT'
			),
			'queue' => array(
				'type' => 'VARCHAR',
				'constraint' => 32,
				'null' => true
			),
		);

		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->add_key('key_id', FALSE);
		$this->dbforge->create_table('notifications');
	}

	function down()
	{
		$this->dbforge->drop_table('notifications');
	}
}