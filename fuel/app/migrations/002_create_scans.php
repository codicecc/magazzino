<?php

namespace Fuel\Migrations;

class Create_scans
{
	public function up()
	{
		\DBUtil::create_table('scans', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'user_id' => array('constraint' => 11, 'type' => 'int'),
			'code_id' => array('constraint' => 11, 'type' => 'int'),
			'quantity' => array('constraint' => 11, 'type' => 'int'),
			'quantity_less' => array('constraint' => 11, 'type' => 'int'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('scans');
	}
}