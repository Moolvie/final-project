<?php
	// Purpose: Holds the Home page for the website

	// Connect to the database
	$db = mysqli_connect("localhost","root","!root","songs");
	if ($db === false)
		echo "<p>Connect error: " . mysqli_error() . "</p>\n";
	else
	{
		// Include the Website layout to gain access to the $body variable
		include("Layout.php");
		// Include getFunctions to gain access to all "Get" functions
		include_once("getFunctions.php");	
		// Set body to the table of songs and print it 
		$body = GetFullSongList($db);
		echo "$body";
		
		// End the layout
		echo endLayout;
	}
	
	
?>