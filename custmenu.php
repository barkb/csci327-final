<?php
require 'init.php'; //Database connection and other required classes.

$checked_out_sql = "SELECT * FROM Movie JOIN Copy ON Copy.ObjectId = Movie.ObjectId JOIN Transactions ON Copy.CopyNo = Transactions.CopyNo WHERE Copy.CurrentStatus = 1 AND Transactions.memberId = 0";

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

		<form action="custmenu.php" method="GETT">
			<!-- Movie search box -->
			<h4>Search by Movie Title, Director, or Genre</h4>
			<label for="Title">Title: </label>
			<input type="text" name="Title" value="<?= $Title?>"><br>
			<label for="Director">Director: </label>
			<input type="text" name="Director" value="<?= $Director?>"><br>
			<label for="Genre">Genre: </label>
			<input type="text" name="Genre" value="<?= $Genre?>"><br>
			<input type="submit" value="submit" name="search"/>
			<br><br>
			<input type="submit" value="View Movies for Checkout" name="checkout"/>
			
				
		</form>

	<?php
	if (isset($_GET['search'])) {
		$Title = mysqli_real_escape_string($_REQUEST["Title"]);
		$Director = mysqli_real_escape_string($_REQUEST["Director"]);
		$Genre = mysqli_real_escape_string($_REQUEST["Genre"]);
		$sql = "SELECT * FROM Movie";
	       	$sql = $sql." WHERE Title LIKE '%".$Title."%'";
		$sql = $sql." OR Director LIKE '%".$Director."%'";
		$sql = $sql." OR Genre LIKE '%".$Genre."%'";
		$sql = $sql." ORDBER BY Title ASC";
		getresult($sql);
	}
	elseif (isset($_GET['checkout'])) {
		$sql = "SELECT * FROM Movie JOIN Copy ON Copy.ObjectId = Movie.ObjectId WHERE Copy.CurrentStatus = 1";
		getresult($sql);
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
            <td>Medium</td>
            <td>Date</td>
            <td>Type</td>
            <td>&nbsp;</td>
         </tr>
         <?php while ( $row = $result->fetch_assoc() ) { ?>
            <tr  valign="top">
               <td><?= $row['Movie.Title'] ?></td>
               <td><?= $row['Copy.Type'] ?></td>
               <td><?= $row['Transactions.DateAndTime'] ?></td>
                <td><?= $row['Transactions.Type'] ?></td>
               <td>
		<input type="submit" value="Return Movie" name="return"/>
		<input type="submit" value="Reserve Movie" name="reserve"/>		  
               </td>
            </tr>
	 <?php }  ?>
	<?php } ?>
         </table>

	</body>
</html>
