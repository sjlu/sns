<?php

class Migration_Keys extends CI_Migration
{
	function up()
	{
		/**
		 * Keys table
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
			'key' => array(
				'type' => 'VARCHAR',
				'constraint' => 32
			),
			// 'secret' => array(
			// 	'type' => 'TEXT'
			// )
		);

		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->add_key('user_id', FALSE);
		$this->dbforge->add_key('key', TRUE);
		$this->dbforge->create_table('keys');
	}

	function down()
	{
		$this->dbforge->drop_table('keys');
	}
}