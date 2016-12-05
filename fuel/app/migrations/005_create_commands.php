<?php

namespace Fuel\Migrations;

class Create_commands
{
	public function up()
	{
		\DBUtil::create_table('commands', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'PID' => array('constraint' => 11, 'type' => 'int'),
			'completed' => array('constraint' => 11, 'type' => 'int'),
			'options' => array('type' => 'text'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('commands');
	}
}