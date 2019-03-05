<?php
// copy this file to config.inc.php and fill in values

$servers = [
	1 => [
		'name' => 'srv1',
		//'type' => 'ispconfig',
		'db_host' => 'localhost',
		'db_port' => '3306',
		'db_name' => 'dbispconfig',
		'db_user' => 'dbispconfig',
		'db_password' => '',
		//'server_id' => 1,
		'server_name' => 'srv1.host.fr',
		'shell_host' => 'srv1.host.fr',
		'shell_user' => 'root',
	],
	2 => [
		'name' => 'srv2',
		//'type' => 'ispconfig',
		'db_host' => 'localhost',
		'db_port' => '3306',
		'db_name' => 'dbispconfig',
		'db_user' => 'dbispconfig',
		'db_password' => '',
		//'server_id' => 2,
		'server_name' => 'srv2.host.fr',
		'shell_host' => 'srv2.host.fr',
		'shell_user' => null,
	],
];
