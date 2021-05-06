<?php

//INIT file loads resources needed by pages in our project

/*
 * DATABASE CONNECTION
 */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'barkb');
define('DB_PASSWORD', 'csci327');
define('DB_DATABASE', 'videostore');

$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
if ($mysqli->connect_errno) {
	echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	exit;
}

/*
 * TABLES
 */
define('CUSTOMERS_TABLE', 'Member');
define('ADMIN_TABLE', 'Employee');
define('FULL_TIME_ADMIN_TABLE', 'Full_Time');
define('HOURLY_ADMIN_TABLE', 'Hourly');
define('COPY_TABLE', 'Copy');
define('MOVIES_TABLE', 'Movie');
define('PLAYER_TABLE', 'Player');
define('PLAYER_DEVICE_TABLE', 'Player_Device');
define('STORE_TABLE', 'Store');
define('SOBJECT_TABLE', 'Store_Object');
define('TRANSACTIONS_TABLE', 'Transactions');

/*
 * CLASSES
 */
//In web apps Knuckles gave us some useful classes for making data operations in PHP easier
//we could potentially use those here but I'm not sure if that would be allowed.
//I might email knuckels and ask him if he'd have a problem with it.
//-ben
