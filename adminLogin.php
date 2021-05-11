<?php

session_start();

$servername ="localhost";
$username = "barkb";
$password = "csci327";
$dbname = "videostore";

$conn = new mysqli($servername,$username,$password,$dbname);
if ($conn -> connect_error){
	die("Connection failed: " . $conn -> connect_error);
}
else{
	$userAdmin = $_POST["adminid"];
        $passwordAdmin = $_POST["adminPass"];

	$sql = "SELECT * FROM Employee ";
	$sql = $sql . "WHERE Username='".$userAdmin."' AND Passwd='".$passwordAdmin."'";


	$result = $conn->query($sql);
	if ($result->num_rows > 0){
		$row = $result->fetch_assoc();

		$_SESSION['employeeID'] = $row['EmployeeID'];
		$_SESSION['username'] = $row['Username'];
		$_SESSION['name'] = $row['Name'];
		$_SESSION['address'] = $row['Address'];
		$_SESSION['phone'] = $row['Phone'];
		$_SESSION['storeNo'] = $row['StoreNo'];

		echo $_SESSION['name'];
		header("Location: adminmenu.php");

        }
        else
        {
        	echo "error retry password";
        	echo "<input type='reset' value='Reset' onClick='window.location.reload()'/>";

	}
}
