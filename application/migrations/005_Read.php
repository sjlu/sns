<?php

class Migration_read extends CI_Migration
{
	function up()
	{
		$fields = array(
			'read' => array(
				'type' => 'INT',
				'constraint' => 1,
				'unsigned' => TRUE,
				'default' => 0
			)
		);

		$this->dbforge->add_column('notifications', $fields);
	}

	function down()
	{
		$this->dbforge->drop_column('notifications', 'read');
	}
}