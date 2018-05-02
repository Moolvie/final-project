<?php
	session_start();
	session_unset();
	session_destroy();
	echo "Successfully logged out";
	header("Refresh: 2; ../pages/Home.php");
	exit();
?>