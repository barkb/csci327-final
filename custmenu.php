<?php
require 'init.php'; //Database connection and other required classes.

$servername ="localhost";
$username = "MaxMel"
$password = "321"
$dbnamer = "videostore";


?>


<!DOCTYPE html>
<html>
	<head>
		<title>Video Store Customer</title>
		<meta charset="utf-8"/>
		<link rel="stylesheet" href="adminmenu.css"/>

	</head>

	<body>
		<h1>Welcome Customer</h1>

		<form action="moviesearch.php" method="POST">
			<input type="hidden" name="task" value="save">
			<input type="hidden" name="entry_id" value="<?=$entry_id?>">
			<!-- Movie search box -->
			<h4>Search by Movie Title, Director, or Genre</h4>
			<label for="Title">Title: </label>
			<input type="text" name="Title" value="<?= $Title?>"><br>
			<label for="Director">Director: </label>
			<input type="text" name="Director" value="<?= $Director?>"><br>
			<label for="Genre">Genre: </label>
			<input type="text" name="Genre" value="<?= $Genre?>"><br>
			<input type="submit" value="submit">
		</form>

	</body>
</html>
