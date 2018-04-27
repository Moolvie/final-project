<?php
	if(isset($_POST['SubmitSearch']))
	{
		// Connect to the database
		$db = mysqli_connect("localhost","root","!root","songs");
		if ($db === false)
			echo "<p>Connect error: " . mysqli_error() . "</p>\n";
		else
		{
			// Include Home.php gain to access the $body variable
			include("Layout.php");
			include("getFunctions.php"); // Holds the requested search
			$request = $_POST['Request'];
		
			// Set body to the table of songs and print it 
			$body = GetSearchResults($db, $request);
			echo "$body";
			// End the layout
			echo endLayout;
		}
	
	}
	else
		header("Location: Home.php");
?>