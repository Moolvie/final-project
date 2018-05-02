<?php

// Db connect variables
$host = "localhost";
$user = "root";
$password= "!root";
$dbName= "songs";

// Connect to the database
	$db = mysqli_connect($host, $user, $password, $dbName);
	if ($db === false)
		echo "<p>Connect error: " . mysqli_error() . "</p>\n";
?>