<?php
require 'init.php'; //Database connection and other required classes.

$checked_out_sql = "SELECT * FROM Movie JOIN Copy ON Copy.ObjectId = Movie.ObjectId JOIN Transactions ON Copy.CopyNo = Transactions.CopyNo WHERE Copy.CurrentStatus = 0 AND Transactions.memberId = 1";

$result = lib::db_query($checked_out_sql);
$num_rows = $result->num_rows;

function getresult($sql) {
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
		echo "</tr>";
	}
	echo "</table>";
}

function generate_return_sql($copynum) {
	$sql = "UPDATE Copy SET CurrentStatus = 1 WHERE CopyNo = '%".$copynum."%'";
	return $sql;
}

$Title = "";
$Director = "";
$Genre = "";

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

		<form action="custmenu.php" method="GET">
			<!-- Movie search box -->
			<h4>Search by Movie Title</h4>
			<label for="Title">Title: </label>
			<input type="text" name="Title"><br>
			<input type="submit" value="submit" name="search"/>
			<br><br>	
		</form>
		<form action="custmenu.php" method=GET>
			<input type="submit" value="View Movies for Checkout" name="checkout"/>
			<br><br>
		</form>

	<?php
	if (isset($_GET['search']) && !($_GET['Title']==null)) {
		$Title = ($_GET['Title']);
		$sql = "SELECT * FROM Movie";
	       	$sql = $sql." WHERE Title LIKE '%".$Title."%'";
		getresult($sql);
	}
	elseif (isset($_GET['checkout'])) {
		$sql = "SELECT * FROM Movie JOIN Copy ON Copy.ObjectId = Movie.ObjectId WHERE Copy.CurrentStatus = 1";
		getresult($sql);
	}
	elseif (isset($_GET['return'])) {
		$sql = generate_return_sql(strval($row['CopyNo']));
		lib::db_query($sql);
	}
	elseif (isset($_GET['fine'])) {
		$sql = "SELECT MemberName as 'Customer', AVG(Amount) as 'Average Fine' ";
		$sql = $sql."FROM Transactions ";
		$sql = $sql."JOIN Member on Transactions.MemberId = Member.MemberID ";
		$sql = $sql."GROUP BY Transactions.MemberId";

		$result = lib::db_query($sql);
		var_dump($result);
	}
	elseif (isset($_GET['dname']) && !($_GET['Name']==null)) {
		$dname = ($_GET['dname'});
		$sql = "SELECT * FROM Movie WHERE Director LIKE '%".$dname."%'";
		$dresult = lib::db_query($sql);
		$dnum_rows = $dresult->num_rows;
		

	}
	
	$mysqli->close();	
?>

       <?php if ($num_rows == 0) { ?>
          <b>No records were found in the database.</b>
      <?php  } else { ?>
        
              <b>Listing of Customer  Records:</b>
	              
        <table width="" border="1" cellspacing="0" cellpadding="5">
          <tr  valign="top">
            <td>Title</td>
            <td>Director</td>
            <td>Date</td>
            <td>Type</td>
            <td>&nbsp;</td>
         </tr>
	 <?php while ( $row = $result->fetch_assoc() ) { ?>
            <tr  valign="top">
               <td><?= $row['Title'] ?></td>
               <td><?= $row['Director'] ?></td>
               <td><?= $row['DateAndTime'] ?></td>
                <td><?= $row['Type'] ?></td>
	       <td>
		<form action="custmenu.php" method="GET">
			<input type="submit" value="Return Movie" name="return"/>
			<input type="submit" value="Calculate Fine" name="fine"/>		  
	       </form>
		</td>
            </tr>
	 <?php }  ?>
	<?php } ?>
	 </table>
	<br><br><br>
	<form action="custmenu.php" method="GET">
		<h4>Find Movies By Director</h4>
		<label for="Name"><Director Name: </label>
		<input type="text" name="Name"/>
		<input type="submit" value="search" name="dname"/> 
	</form>
	<br><br><br>
	<button>Log Out</button>
	</body>
