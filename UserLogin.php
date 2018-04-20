<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>User Login</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8849-1" />
<style>
	label {
		display: inline-block;
		width: 180px;
	}
</style>
</head>
<body>

<p>New users, please complete the form to
register as a user.</p>

<h3>New User  Registration</h3>
<form method="post" action="RegisterUser.php">
<fieldset style= width:50%>
<legend>Create New Account</legend>
<p>
<label>Enter your first name</label>
<input type="text" name="first" />
</p>
<p>
<label>Enter your last name:</label>
<input type="text" name="last" />
</p>
<p>
<label>Enter your street address</label>
<input type="text" name="address" />
</p>
<p>
<label>
Enter your City: 
</label>
<input type="text" name="city" />
</p>
<p>
<label>Enter your state: </label>
<select name="state">
	<option value="">Select a State</option>
	<option value="AL">Alabama</option>
	<option value="AK">Alaska</option>
	<option value="AZ">Arizona</option>
	<option value="AR">Arkansas</option>
	<option value="CA">California</option>
	<option value="CO">Colorado</option>
	<option value="CT">Connecticut</option>
	<option value="DE">Delaware</option>
	<option value="DC">District Of Columbia</option>
	<option value="FL">Florida</option>
	<option value="GA">Georgia</option>
	<option value="HI">Hawaii</option>
	<option value="ID">Idaho</option>
	<option value="IL">Illinois</option>
	<option value="IN">Indiana</option>
	<option value="IA">Iowa</option>
	<option value="KS">Kansas</option>
	<option value="KY">Kentucky</option>
	<option value="LA">Louisiana</option>
	<option value="ME">Maine</option>
	<option value="MD">Maryland</option>
	<option value="MA">Massachusetts</option>
	<option value="MI">Michigan</option>
	<option value="MN">Minnesota</option>
	<option value="MS">Mississippi</option>
	<option value="MO">Missouri</option>
	<option value="MT">Montana</option>
	<option value="NE">Nebraska</option>
	<option value="NV">Nevada</option>
	<option value="NH">New Hampshire</option>
	<option value="NJ">New Jersey</option>
	<option value="NM">New Mexico</option>
	<option value="NY">New York</option>
	<option value="NC">North Carolina</option>
	<option value="ND">North Dakota</option>
	<option value="OH">Ohio</option>
	<option value="OK">Oklahoma</option>
	<option value="OR">Oregon</option>
	<option value="PA">Pennsylvania</option>
	<option value="RI">Rhode Island</option>
	<option value="SC">South Carolina</option>
	<option value="SD">South Dakota</option>
	<option value="TN">Tennessee</option>
	<option value="TX">Texas</option>
	<option value="UT">Utah</option>
	<option value="VT">Vermont</option>
	<option value="VA">Virginia</option>
	<option value="WA">Washington</option>
	<option value="WV">West Virginia</option>
	<option value="WI">Wisconsin</option>
	<option value="WY">Wyoming</option>
</select>				
</p>
<p>
<label>Enter your zipcode: </label>
<input type="text" name="zipcode"/>
</p>
<p>
<label>Enter your e-mail address:</label>
<input type="text" name="email" />
</p>
<p>
<label>Enter a password for your account:</label>
<input type="password" name="password" />
</p>
<p><label>Confirm your password:</label>
<input type="password" name="password2" />
</p>
<p><em>(Passwords are case-sensitive and
must be at least 6 characters long)</em></p>

<input type="reset" name="reset"
value="Reset Registration Form" />
<input type="submit" name="register"
value="Register" />
</fieldset>
</form>

</body>
</html>