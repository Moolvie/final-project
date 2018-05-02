<?php
	session_start();
	session_unset();
	session_destroy();
	echo "Successfully logged out";
        echo '<meta http-equiv="refresh" content="0; ../pages/Home.php"/>';
	exit();
?>
