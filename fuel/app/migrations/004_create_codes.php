<?php

namespace Fuel\Migrations;

class Create_codes
{
	public function up()
	{
		\DBUtil::create_table('codes', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'store_id' => array('constraint' => 11, 'type' => 'int'),
			'position' => array('constraint' => 255, 'type' => 'varchar'),
			'active' => array('constraint' => 11, 'type' => 'int'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('codes');
	}
}