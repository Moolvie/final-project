<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Verify Returning User</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8849-1" />
</head>
<body>
<?php
<h3>Returning User Login</h3>
<form method="post" action="VerifyLogin.php">
<p>Enter your e-mail address:
<input type="text" name="email" /></p>
<p>Enter your password:
<input type="password" name="password" /></p>
<p><em>(Passwords are case-sensitive and
must be at least 6 characters long)</em></p>
<input type="reset" name="reset"
value="Reset Login Form" />
<input type="submit" name="login" value="Log In" />
</form>
<hr />
?>
</body>
</html>
