<?php

//INIT file loads resources needed by pages in our project

/*
 * DTABASE CONNECTION
 *  */

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'barkb');
define('DB_PASSWORD', 'csci327');
define('DB_DATABASE', 'videostore');
$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
if ($mysqli->connect_errno) {
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
			exit;
}

session_start()
?>
<!doctype html>
<html lang="en">
<meta charset="utf-8"/>
<title>Video Store Admin</title>
<link rel="stylesheet" href="adminmenu.css"/>
<form>
<body>
	<div class="container">
		<?php 
			echo"<h1>Welcome ".$_SESSION['name']."</h1>" 
		?>
		<form action="adminmenu.php" method="GET">
			Add New Customer:
			Username:<input type="text" name="username"/>
			Password:<input type="text" name="password"/>
			Name:<input type="text" name="name"/>
			Address:<input type="text" name="address"/>
			<input type="submit" value="Add Customer" name="addcust"/>
			Movie title:<input type="text" name="title"/>
			<input type="submit" value="Search" name="search"/>
			<input type="submit" value="Print store info" name="info"/>
			<input type="submit" value="Print top 10 most frequent renters" name="toprenters"/>
			<input type="submit" value="Print top 10 most rented movies" name="toprented"/>
			<input type="submit" value="Print top 10 most popular movies of the year" name="yearly"/>
			<input type="submit" value="Print average fine per customer" name="avgfine"/>
			<input type="submit" value="Log Out" name"logout"/>
		</form>
		<button>Log Out</button>
	</div>
	<?php
		if(isset($_GET['info'])){
			$storeNo=$_SESSION['storeNo'];
			$sql = "SELECT SAddress as 'Address',SPhone as 'Phone number' FROM Store WHERE StoreNo=".$storeNo;
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
			$sql = $sql."WHERE StoreNo =  ".$_SESSION['storeNo'];
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
			getresult($sql,'add_dvd','add_bluray');
		}
		elseif(isset($_GET['add_dvd']) && !($_GET['btnrow']==null)){
			$btnrow = unserialize($_GET['btnrow']);
			echo "Added DVD copy of ".$btnrow[4];
			$sql = "INSERT INTO Copy(ObjectID,Type,CurrentStatus) VALUES (".$btnrow[0].",'DVD',0)";
			getresult($sql);
		}
		elseif(isset($_GET['add_bluray']) && !($_GET['btnrow']==null)){
			$btnrow = unserialize($_GET['btnrow']);
			echo "Added Blu Ray copy of ".$btnrow[4];
			$sql = "INSERT INTO Copy(ObjectID,Type,CurrentStatus) VALUES (".$btnrow[0].",'DVD',0)";
			getresult($sql);
		}
		elseif(isset($_GET['addcust']) && !($_GET['username']==null) && !($_GET['password']==null) && !($_GET['name']==null) && !($_GET['address']==null)){
			$username = $_GET['username'];
			$password = $_GET['password'];
			$name = $_GET['name'];
			$address = $_GET['address'];
			$sql = "INSERT INTO Member(Username,Passwd,MemberName,Address) VALUES ('".$username."','".$password."','".$name."','".$address."')";
			getresult($sql);
		}
		elseif(isset($_GET['logout'])){
			header('url: http://194.195.213.46');
			#session_unset();
			
		}

		function getresult($sql,$btntitle=null,$btntitle2=null) {
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
					echo "<input type='hidden' value='".serialize($row)."' name='btnpk'/>";
					echo "<input type='hidden' value='".$row[0]."' name='btnpk'/>";
					echo "<input type='submit' value='".$btntitle."' name='".$btntitle."' />";
					echo "</td>";
				}
				if(!($btntitle==null)){ 
					echo "<td>";
					echo "<form action='adminmenu.php' method='GET'>";
					echo "<input type='hidden' value='".serialize($row)."' name='btnpk'/>";
					echo "<input type='hidden' value='".$row[0]."' name='btnpk'/>";
					echo "<input type='submit' value='".$btntitle2."' name='".$btntitle2."' />";
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

