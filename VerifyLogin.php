<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Verify User Login</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8849-1" />
</head>

<body>
<h1>Songs</h1>
<h2>Verify User Login</h2>
<?php
$errors = 0;
$DBConnect = @mysqli_connect("localhost", "root", "!root");
if ($DBConnect === FALSE) {
    echo "<p>Unable to connect to the database server. " .
         "Error code " . mysqli_errno() . ": " .
         mysqli_error() . "</p>\n";
    ++$errors;
    }
    else {
         $DBName = "Songs";
         $result = @mysqli_select_db($DBConnect, $DBName);
		if ($result === FALSE) {
			echo "<p>Unable to select the database. " .
				"Error code " . mysqli_errno($DBConnect) .
				": " . mysqli_error($DBConnect) .
				"</p>\n";
		++$errors;
		}
	}
$TableName = "Customer";
$userEmail = stripslashes($_POST['email']);
$userPasswd = md5(stripslashes($_POST['password']));
if ($errors == 0) {
    $SQLstring = "SELECT CustomerID, FirstName, LastName FROM $TableName 
	 WHERE Email='$userEmail' AND Password='$userPasswd'";
    $QueryResult = @mysqli_query($DBConnect, $SQLstring);
    if (mysqli_num_rows($QueryResult) == 0) {
        echo "<p>The e-mail address/password " .
            " combination entered is not valid.
            </p>\n";
    ++$errors;
    }
    else {
        $Row = mysqli_fetch_assoc($QueryResult);
        $customerID = $Row['CustomerID'];
        $CustomerName = $Row['FirstName'] . " " .
        $Row['LastName'];
        echo "<p>Welcome back, $CustomerName!</p>\n";
    }
}
if ($errors > 0) {
    echo "<p>Please use your browser's BACK button
        to return " .
        " to the form and fix the errors
        indicated.</p>\n";
}
if ($errors == 0) {
	echo "<p><a href='AvailableSongs.php?" .
		"customerID=$customerID'>Available " .
		" Songs</a></p>\n";
}
?>
</body>
</html>
