<?php

class Migration_Initial extends CI_Migration
{
	function up()
	{
		/**
		 * Users table
		 */
		$fields = array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 5,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'email' => array(
				'type' => 'VARCHAR',
				'constraint' => 255,
			),
			'password' => array(
				'type' => 'TEXT'
			)
		);

		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->add_key('email', TRUE);
		$this->dbforge->create_table('users');

		/**
		 * Sessions table.
		 */
		$fields = array(
			'session_id' => array(
				'type' => 'VARCHAR',
				'constraint' => '32',
			),
			'user_agent' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => true,
			),
			'ip_address' => array(
				'type' => 'VARCHAR',
				'constraint' => '20',
				'null' => true,
			),
			'last_activity' => array(
				'type' => 'INT',
				'constraint' => '12',
				'null' => true,
			),
			'user_data' => array(
				'type' => 'TEXT',
			),
		);

		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('session_id', TRUE);
		$this->dbforge->create_table('ci_sessions');
	}

	function down()
	{
		$this->dbforge->drop_table('users');
		$this->dbforge->drop_table('ci_sessions');
	}
}