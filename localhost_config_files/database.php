<?php
defined('BASEPATH') or exit('No direct script access allowed');

$active_group = 'default';
$query_builder = TRUE;
$hostname = 'localhost';
// $username = 'u163220262_erp_dev';
// $password = '3OKi@wnGOU#b';
// $database = 'u163220262_erp_dev';

$username = 'root';
$password = '';
$database = 'erp_latest_new';

$db['default'] = array(
	'dsn'	=> '',
	'hostname' => $hostname,
	'username' => $username,
	'password' => $password,
	'database' => $database,
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);
