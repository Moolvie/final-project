<?php
	session_start();
	// Purpose: Holds the Home page for the website
	if(isset($_SESSION['customerID']) &&
		!($_SESSION["customerID"] == 0))
	{
		// Connect to the database
		include("../plug-ins/connect_to_songs.php");
		
		include("../layout/head.php");
		$links = "<link rel=stylesheet type=text/css href=../layout/mainStyle.css>".
				"<link href= https://fonts.googleapis.com/css?family=Roboto:100,400 rel=stylesheet>".
				"<link href= https://fonts.googleapis.com/css?family=Black+Han+Sans rel= stylesheet>";
		echo "$links";
		echo endHead;
		
		include_once("../layout/header.php");
		// Create Header
		$logo = "<a href= ../pages/Home.php class=logo>MUSIC NOW</a>";
		echo "$logo";
		
		// Insert nav content
		$nav= "<ul class= navList>".
				"<li><a href= >Playlist</a></li>".
				"<li><a href= >About</a></li>".
				"<li><a href= ../plug-ins/logout.php>Log out</a></li>".
				"</ul>";
		echo "$nav";
		
		echo endHeader;
		
		// Include the Website layout to gain access to the $body variable
		include("../layout/PlaylistLayout.php");

		// Include getFunctions to gain access to all "Get" functions
		include_once("../functions/getFunctions.php");	
		
		$userID = $_SESSION['customerID'];
		// Set body to the table of songs and print it 
		$body = GetPlaylists($db, $userID);
		echo "$body";
		
		// End the layout
		echo endLayout;	
	}
?>