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
	     $userCust = $_POST["custid"];
        $passwordCust = $_POST["custPass"];

	$sql = "SELECT * FROM Member ";
	$sql = $sql . "WHERE Username='".$userCust."' AND Passwd='".$passwordCust."'";


	$result = $conn->query($sql);
	if ($result->num_rows > 0){
		$row = $result->fetch_assoc();

		$_SESSION['memberID'] = $row['MemberID'];
		$_SESSION['username'] = $row['Username'];
		$_SESSION['name'] = $row['Name'];
		$_SESSION['address'] = $row['Address'];
		$_SESSION['phone'] = $row['Phone'];
		$_SESSION['storeNo'] = $row['StoreNo'];

		echo $_SESSION['name'];
		header("Location: custmenu.php");

        }
        else
        {
        	echo "error retry password";
        	echo "<input type='reset' value='Reset' onClick='window.location.reload()'/>";

	}
}
