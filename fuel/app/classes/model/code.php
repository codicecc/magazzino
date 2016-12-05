<?php
class Model_Code extends \Orm\Model
{
	
	protected static $_belongs_to = array('store');
	
	protected static $_has_many = array('scans');
	
	protected static $_properties = array(
		'id',
		'store_id',
		'code',
		'position',
		'active',
		'created_at',
		'updated_at',
	);

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_save'),
			'mysql_timestamp' => false,
		),
	);

	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('store_id', 'Store Id', 'required|valid_string[numeric]');
		$val->add_field('code', 'Code', 'required|max_length[255]');
		$val->add_field('position', 'Position', 'required|max_length[255]');
		$val->add_field('active', 'Active', 'valid_string[numeric]');
		return $val;
	}

}
