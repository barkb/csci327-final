<?php

//INIT file loads resources needed by pages in our project

/*
 * DATABASE CONNECTION
 */
$servername ="194.195.213.46";
$username = "barkb";
$password = "csci327";
$dbnamer = "videostore";





$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
if ($mysqli->connect_errno) {
	echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	exit;
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
<<<<<<< HEAD
				<button>Add movie copy</button>
		<input value="Search for movie" ></input>
		<button>Add new customer</button>
		<form action="adminmenu.php" method="GET">
=======
		<form action="adminmenu.php" method="GET">
			Add New Customer:
			Username:<input type="text" name="username"/>
			Password:<input type="text" name="password"/>
			Name:<input type="text" name="name"/>
			Address:<input type="text" name="address"/>
			<input type="submit" value="Add Customer" name="addcust"/>
			Movie title:<input type="text" name="title"/>
			<input type="submit" value="Search" name="search"/>
>>>>>>> cf1fe5dab869d017f9f3392a917b5bb361c0f3e9
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
			$storeNo=1;
			$sql = "SELECT SAddress as 'Address',SPhone as 'Phone number' FROM Store WHERE StoreNo=".$storeNo;
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

<<<<<<< HEAD

		function getresult($sql) {
			global $mysqli;
			$results = $mysqli->query($sql);
			#echo($mysqli->error);
=======
			getresult($sql,'add_dvd','add_bd');
		}
		elseif(isset($_GET['add_dvd']) && !($_GET['btnrow']==null)){
			$btnrow = unserialize($_GET['btnrow']);
			echo "Added DVD copy of ".$btnrow[4];
			$sql = "INSERT INTO Copy(ObjectID,Type,CurrentStatus) VALUES (".$btnrow[0].",'DVD',0)";

			getresult($sql);
		}
		elseif(isset($_GET['add_bd']) && !($_GET['btnrow']==null)){
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

	
			
		function getresult($sql,$btntitle=null,$btntitle2=null) {
			global $mysqli;
			$results = $mysqli->query($sql);
			if($results->num_rows==0){
				return;
			}
>>>>>>> cf1fe5dab869d017f9f3392a917b5bb361c0f3e9
			$fields = $results->fetch_fields();
			foreach ($fields as $field){
<<<<<<< HEAD
				echo $field->name;
=======
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
					echo "<input type='hidden' value='".serialize($row)."' name='btnrow'/>";
					echo "<input type='submit' value='Add DVD' name='".$btntitle."' />";
					echo "</form>";
					echo "</td>";
				}
				if(!($btntitle==null)){ 
					echo "<td>";
					echo "<form action='adminmenu.php' method='GET'>";
					echo "<input type='hidden' value='".serialize($row)."' name='btnrow'/>";
					echo "<input type='submit' value='Add BD' name='".$btntitle2."' />";
					echo "</form>";
					echo "</td>";
				}

				echo "</tr>";
>>>>>>> cf1fe5dab869d017f9f3392a917b5bb361c0f3e9
			}

		}

		$mysqli->close();

	?>

</body>
</html>
