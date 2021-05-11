<?php

$servername ="194.195.213.46";
$username = "barkb";
$password = "csci327";
$dbnamer = "videostore";

$conn = new mysqli($servername,$username,$password,$dbname);
if ($conn -> connect_error)
{
	die("Connection failed: " . $conn -> connect_error);
}
else
    {
				$userAdmin = $_POST["adminid"];
        $passwordAdmin = $_POST["adminPass"];

				$sql = "SELECT adminid, adminPass, from admins ";
				$sql = $sql . "where adminid = '" . $userAdmin . "' and adminPass= '". $passwordAdmin . "'";

				$result = $conn->query($swl);
				if (result->num-rows > 0)
        {
            header("Location: voideostore/adminmenu.php");

        }
        else
        {
            echo "error retry pasword"
            <input type="reset" value="Reset" onClick="window.location.reload()">

        }
