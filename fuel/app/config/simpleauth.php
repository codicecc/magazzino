<?php
/**
 * Fuel
 *
 * Fuel is a fast, lightweight, community driven PHP5 framework.
 *
 * @package    Fuel
 * @version    1.7
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2015 Fuel Development Team
 * @link       http://fuelphp.com
 */

/**
 * NOTICE:
 *
 * If you need to make modifications to the default configuration, copy
 * this file to your app/config folder, and make them in there.
 *
 * This will allow you to upgrade fuel without losing your custom config.
 */

return array(

	/**
	 * DB connection, leave null to use default
	 */
	'db_connection' => null,

	/**
	 * DB write connection, leave null to use same value as db_connection
	 */
	'db_write_connection' => null,

	/**
	 * DB table name for the user table
	 */
	'table_name' => 'users',

	/**
	 * Choose which columns are selected, must include: username, password, email, last_login,
	 * login_hash, group & profile_fields
	 */
	'table_columns' => array('*'),

	/**
	 * This will allow you to use the group & acl driver for non-logged in users
	 */
	'guest_login' => true,

	/**
	 * This will allow the same user to be logged in multiple times.
	 *
	 * Note that this is less secure, as session hijacking countermeasures have to
	 * be disabled for this to work!
	 */
	'multiple_logins' => false,

	/**
	 * Remember-me functionality
	 */
	'remember_me' => array(
		/**
		 * Whether or not remember me functionality is enabled
		 */
		'enabled' => false,

		/**
		 * Name of the cookie used to record this functionality
		 */
		'cookie_name' => 'rmcookie',

		/**
		 * Remember me expiration (default: 31 days)
		 */
		'expiration' => 86400 * 31,
	),

	/**
	 * Groups as id => array(name => <string>, roles => <array>)
	 */

	 
	'groups' => array(
      -1 => array('name' => 'Banned', 'roles' => array('banned')),
      0 => array('name' => 'User', 'roles' => array('user')),
      2 => array('name' => 'Scans', 'roles' => array('scan')),	//SCAN
      3 => array('name' => 'Partnes', 'roles' => array('partner')),	//PARTNER
      51 => array('name' => 'Operators', 'roles' => array('scan', 'partner', 'operator')),	//OPERATORS
      99  => array('name' => 'Superadmins', 'roles' => array('scan', 'partner', 'operator','superadmin')),
	),

	 'roles' => array(
	 	 'scan' => array(
			'Controller_Admin' => array('index'),
			'Controller_Admin_Users' => array(
				'viewprofile',
			),
			'Controller_Admin_Scans' => array(
				'index',
				'create',
				'read',
			),
		),
		 'partner' => array(
			'Controller_Admin' => array('index'),
			'Controller_Admin_Users' => array(
				'viewprofile',
			),
			'Controller_Admin_Quantities' => array(
				'index',
				'getcsv',
			),
		),
		 'operator'  => array(
		 	 'Controller_Admin' => array('index'),
				'Controller_Admin_Users' => array(
					'viewprofile',
					'index',
				), 	 
		 	 'Controller_Admin_Codes' => array(
		 	 	 'index',
		 	 	 'view',
		 	 	 'getcsv',
		 	 	 'qrcode',
		 	 	 'findingbyname',
		 	 	 'create',
		 	 	 'edit'
		 	 	),
		 	'Controller_Admin_Quantities' => array('super' => true),
			'Controller_Admin_Scans' => array(
				'index',
				'view',
				'find',
				'create',
				'edit'
			),
			'Controller_Admin_Stores' => array(
				'index',
				'create',
				'view',
				'read',
				'edit'
			),
			'Controller_Admin_Tools' => array(
				'index',
				'mageCheck_ecommerce_magazzino',
				'getcsv',
			),
			'Controller_Admin_Codesource' => array(
				'index',
			),
			'Controller_Admin_Codenew' => array(
				'index',
			),
			'Controller_Admin_Codeoem' => array(
				'index',
				'create',
				'view',
				'delete',
				'edit'				
			),
			'Controller_Admin_Codecompetitor' => array(
				'index',
				'create',
				'view',
				'delete',
				'edit'				
			),
		),
		'banned'     => false,
		'superadmin'      => true,
	),
	
	/**
	 * Salt for the login hash
	 */
	'login_hash_salt' => 'put_some_salt_in_here',

	/**
	 * $_POST key for login username
	 */
	'username_post_key' => 'username',

	/**
	 * $_POST key for login password
	 */
	'password_post_key' => 'password',
);
