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
			Movie title:<input type="text" name="title"/>
			<input type="submit" value="Search" name="search"/>
			<input type="submit" value="Print store info" name="info"/>
			<input type="submit" value="Print top 10 most frequent renters" name="toprenters"/>
			<input type="submit" value="Print top 10 most rented movies" name="toprented"/>
			<input type="submit" value="Print top 10 most popular movies of the year" name="yearly"/>
			<input type="submit" value="Print average fine per customer" name="avgfine"/>
		</form>
		<button>Log Out</button>
	</div>
	<?php
		if(isset($_GET['info'])){
			$sql = 'SELECT * FROM Employee';
			getresult($sql);
		}
		elseif(isset($_GET['toprenters'])){
			$sql = "SELECT MemberName, COUNT(Transactions.memberId) as 'Rentals Made' ";
			$sql = $sql."FROM Transactions ";
			$sql = $sql."JOIN Member ON Member.MemberId = Transactions.MemberId ";
			$sql = $sql."WHERE StoreNo = 1 ";
			$sql = $sql."GROUP BY Transactions.MemberId ";
			$sql = $sql."ORDER BY COUNT(Transactions.MemberId) DESC ";
			$sql = $sql."LIMIT 10";
			getresult($sql);
		}
		elseif(isset($_GET['toprented'])){
			$sql = "SELECT Movie.Title ";
			$sql = $sql."FROM Transactions ";
			$sql = $sql."JOIN Copy ON Copy.CopyNo = Transactions.CopyNo ";
			$sql = $sql."JOIN Movie ON Copy.ObjectId = Movie.ObjectID ";
			$sql = $sql."WHERE StoreNo = 1 ";
			$sql = $sql."GROUP BY Copy.ObjectId ";
			$sql = $sql."ORDER BY COUNT(Copy.ObjectId) DESC ";
			$sql = $sql."LIMIT 10";
			getresult($sql);
	
		}
		elseif(isset($_GET['yearly'])){
			$sql = "SELECT Movie.Title ";
			$sql = $sql."FROM Transactions ";
			$sql = $sql."JOIN Copy ON Copy.CopyNo = Transactions.CopyNo ";
			$sql = $sql."JOIN Movie ON Copy.ObjectId = Movie.ObjectID ";
			$sql = $sql."WHERE YEAR(Transactions.DateAndTime)=YEAR(NOW()) ";
			$sql = $sql."GROUP BY Copy.ObjectId ";
			$sql = $sql."ORDER BY COUNT(Copy.ObjectId) DESC ";
			$sql = $sql."LIMIT 10";
			getresult($sql);
		}
		elseif(isset($_GET['avgfine'])){
			$sql = "SELECT MemberName as 'Customer', AVG(Amount) as 'Average Fine' ";
			$sql = $sql."FROM Transactions ";
			$sql = $sql."JOIN Member on Transactions.MemberId = Member.MemberID ";
			$sql = $sql."GROUP BY Transactions.MemberId";

			getresult($sql);		
		}
		elseif(isset($_GET['search']) && !($_GET['title']==null)){
			$title = $_GET['title'];
			$sql = "SELECT * FROM Movie WHERE Title LIKE '%".$title."%'";

			getresult($sql,'addcopy');
		}
		elseif(isset($_GET['addcopy']) && !($_GET['btnpk']==null)){
			$btnpk = $_GET['btnpk'];
			echo "Added copy of ".$btnpk;
		}
	
			
		function getresult($sql,$btntitle) {
			global $mysqli;
			$results = $mysqli->query($sql);
			$fields = $results->fetch_fields();
			echo "<table border='1'>";
			echo "<tr>";
			foreach ($fields as $field){
				echo "<td><b>".$field->name."</b></td>";
			}
			echo "</tr>";

			foreach ($results->fetch_all() as $row){
				echo "<tr>";
				foreach($row as $cell){
					echo "<td>".$cell."</td>";
				}
				if(!($btntitle==null)){ 
					echo "<td>";
					echo "<form action='adminmenu.php' method='GET'>";
					echo "<input type='hidden' value='".reset($row)."' name='btnpk'/>";
					echo "<input type='submit' value='Add copy' name='".$btntitle."' />";
					echo "</td>";
				}
				echo "</tr>";
			}
			echo "</table>";
			
		}

		$mysqli->close();

	?>

</body>
</html>
