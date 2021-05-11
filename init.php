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

require_once 'lib.php';
