<?php
class Model_Scan extends \Orm\Model{
	
	protected static $_belongs_to = array('code','user');
	
	protected static $_properties = array(
		'id',
		'user_id',
		'code_id',
		'quantity',
		'quantity_less',
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
		$val->add_field('user_id', 'User Id', 'required|valid_string[numeric]');
		$val->add_field('code_id', 'Code Id', 'required|valid_string[numeric]');
		$val->add_field('quantity', 'Quantity', 'required|valid_string[numeric]');
		$val->add_field('quantity_less', 'Quantity Less', 'valid_string[numeric]');

		return $val;
	}

}
