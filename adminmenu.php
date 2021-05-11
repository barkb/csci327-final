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
else {
	echo "success";
}
?>

<!doctype html>

<html lang="en">

<meta charset="utf-8"/>

<title>Video Store Admin</title>
<link rel="stylesheet" href="adminmenu.css"/>

<form>

<body>
	<div class="container">
		<h1>Hello administrator</h1>
				<button>Add movie copy</button>
		<input value="Search for movie" ></input>
		<button>Add new customer</button>
		<form action="adminmenu.php" method="GET">
			<input type="submit" value="Print store info" name="info"/>
		</form>
		<button>print top 10 most frequest renters in a store</button>
		<button>print top 10 most rented movies in a store</button>
		<button>print top 10 most popular movies of the year</button>
		<button>Average fine per customer</button>
		<button>Log Out</button>
	</div>
	<?php
		if(isset($_GET['info'])){
			$sql = 'SELECT * FROM Employee';
			getresult($sql);
		}
		elseif(isset($_GET['toprenters'])){
			$sql = '';
			getresult($sql);
		}
		elseif(isset($_GET['toprented'])){
			$sql = '';
			getresult($sql);

		}
		elseif(isset($_GET['yearly'])){
			$sql = '';
			getresult($sql);
		}
		elseif(isset($_GET['avgfine'])){
			$sql = '';
			getresult($sql);		
		}
	
			
		function getresult($sql) {
			global $mysqli;
			$results = $mysqli->query($sql);
			#echo($mysqli->error);
			$fields = $results->fetch_fields();
			foreach ($fields as $field){
				echo $field->name;
			}
			
		}

		$mysqli->close();

	?>

</body>
</html>
