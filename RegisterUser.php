<?php
$Body = "";

$errors = 0;
$email = "";
if (empty($_POST['email'])) {
	++$errors;
	$Body .= "<p>You need to enter an e-mail address.</p>\n";
}
else {
     $email = stripslashes($_POST['email']);
     if (preg_match("/^[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*@" .
	"[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,})$/i" ,
	$email) == 0) {
	++$errors;
	$Body .= "<p>You need to enter a valid " .
		"e-mail address.</p>\n";
	$email = "";
     }
}
if (empty($_POST['state'])){
	++$errors;
	$Body .= "<p>You need to select a state.</p>\n";
}

if (empty($_POST['password'])) {
	++$errors;
	$Body .= "<p>You need to enter a password.</p>\n";
	$password = "";
}
else
	$password = stripslashes($_POST['password']);
if (empty($_POST['password2'])){
	++$errors;
	$Body .= "<p>You need to enter a confirmation password.</p>\n";
	$password2 = "";
}
else 
	$password2 = stripslashes($_POST['password2']);
if ((!(empty($password))) && (!(empty($password2)))) {
	if (strlen($password) < 6) {
		++$errors;
		$Body .= "<p>The password is too short.</p>\n";
		$password = "";
		$password2 = "";
	}
	if ($password <> $password2) {
		++$errors;
		$Body .= "<p>The paswords do not match.</p>\n";
		$password = "";
		$password2 = "";
	}
}

if ($errors == 0) {
	$DBConnect = @mysqli_connect("localhost", "root", "!root");
	if ($DBConnect === false) {
		$Body .= "<p>Unable to connect to the database server" . 
		"Error code " . mysqli_errno() . ": " . mysqli_error() . "</p>\n";
		++$errors;
	}
	else {
		$DBName = "Songs";
		$result = @mysqli_select_db($DBConnect, $DBName);
		if ($result === false) {
			$Body .= "<p>Unable to select the database. " . 
		       	"Error code " . msqli_errno($DBConnect) .
			": " . mysqli_error($DBConnect) . "</p>\n";
			++$errors;
		}
	}
}

$TableName = "Customer";
if ($errors == 0) {
	$SQLstring = "SELECT count(*) FROM $TableName" . " WHERE email='" . $email. "'";
	$QueryResult = @mysqli_query($DBConnect, $SQLstring);
	if ($QueryResult !== false) {
		$Row = mysqli_fetch_row($QueryResult);
		if ($Row[0]>0) {
			$Body .= "<p>The email address entered (" .
			htmlentities($email) . 
			") is already registered.</p>\n";
			++$errors;
		}
	}
}

if ($errors > 0) {
	$Body .= "<p>Please use your browser's BACK button to return" . 
		" to the form and fix the errors indicated.</p>\n";
}

if ($errors == 0) {
	$first = stripslashes($_POST['first']);
	$last = stripslashes($_POST['last']);
	$address = stripslashes($_POST['address']);
	$city = stripslashes($_POST['city']);
	$state = stripslashes($_POST['state']);
	$zipcode = stripslashes($_POST['zipcode']);
	$wallet = 0.00;
	
	$SQLstring = "INSERT INTO $TableName " .
		"(CustomerID, FirstName, LastName, Email, StreetAddress, City, State, Zipcode,
		    Wallet, Password) " .
		" VALUES (NULL, '$first', '$last', '$email', '$address', '$city'," .
		" '$state', '$zipcode', $wallet," .
		" '" . md5($password) . "')";
	$QueryResult = @mysqli_query($DBConnect, $SQLstring);
	if ($QueryResult === false) {
		$Body .= "<p>Unable to save your registration " .
			" information. Error code " .
			mysqli_errno($DBConnect) . ": " .
			mysqli_error($DBConnect) . "</p>\n";
		++$errors;
	}
	else {
		$customerID = mysqli_insert_id($DBConnect);
	}
	setcookie("customerID", $customerID);
	//mysqli_close($DBConnect);
}
if ($errors == 0) {
	$CustomerName = $first . " " . $last;
	$Body .= "<p>Thank you for registering, $CustomerName.</p>\n";
}
if ($errors == 0) {
	$Body .= "<form method='post' " .
	" action='AvailableSongs.php'>\n";
	$Body .= "<input type='hidden' name='customerID' " .
	" value='$customerID'>\n";
	$Body .= "<input type='submit' name='submit' " .
	" value='View Available Songs'>\n";
	$Body .= "</form>\n";
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<title>User Registration</title>
</head>
<body>
<h1>Songs</h1>
<h2>User Registration</h2>
<?php
echo $Body;
?>
</body>
</html>
