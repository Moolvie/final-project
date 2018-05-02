<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Verify Returning User</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8849-1" />
<link rel="stylesheet" type="text/css" href="../layout/mainStyle.css">
<link href="https://fonts.googleapis.com/css?family=Roboto:100,400" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Black+Han+Sans" rel="stylesheet">		
	
</head>
<style>
    label {
        display: inline-block;
        width: 180px;
    }
</style>
<body>
<header class="header">
			<a href="Home.php" class="logo">MUSIC NOW</a>
			
</header>
<form method="post" action="../plug-ins/VerifyLogin.php">
<fieldset style= width:50%>
<legend>Returning User Login</legend>
<p>
<label>Enter your e-mail address:</label>
<input type="text" name="email" />
</p>
<p><label>Enter your password:</label>
<input type="password" name="password" />
</p>
<p><em>(Passwords are case-sensitive and
must be at least 6 characters long)</em></p>
<input type="reset" name="reset"
value="Reset Login Form" />
<input type="submit" name="login" value="Log In" />
</fieldset>
</form>

</body>
</html>
