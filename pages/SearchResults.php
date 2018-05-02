<?php
	session_start();
	if(isset($_POST['SubmitSearch']))
	{
		// Connect to the database
		include("../plug-ins/connect_to_songs.php");
		
		if(isset($_SESSION['customerID']))
		{
			include("../layout/head.php");
			$links = "<link rel=stylesheet type=text/css href=../layout/mainStyle.css>".
					"<link href= https://fonts.googleapis.com/css?family=Roboto:100,400 rel=stylesheet>".
					"<link href= https://fonts.googleapis.com/css?family=Black+Han+Sans rel= stylesheet>";
			echo "$links";
			echo endHead;
			
			include_once("../layout/header.php");
			// Create Header
			$logo = "<a href= Home.php class=logo>MUSIC NOW</a>";
			echo "$logo";
			
			// Insert nav content
			$nav= "<ul class= navList>".
					"<li><a href= >Playlist</a></li>".
					"<li><a href= >About</a></li>".
					"<li><a href= ../plug-ins/logout.php>Log out</a></li>".
					"</ul>";
			echo "$nav";
			
			echo endHeader;
		
			// Include Home.php gain to access the $body variable
			include("../layout/Layout.php");
			include("../functions/getFunctions.php"); // Holds the requested search
			$request = $_POST['Request'];
		
			// Set body to the table of songs and print it 
			$body = GetSearchResults($db, $request);
			echo "$body";
			// End the layout
			echo endLayout;
		}
		else
		{
			include("../layout/head.php");
			$links = "<link rel=stylesheet type=text/css href=../layout/mainStyle.css>".
					"<link href= https://fonts.googleapis.com/css?family=Roboto:100,400 rel=stylesheet>".
					"<link href= https://fonts.googleapis.com/css?family=Black+Han+Sans rel= stylesheet>";
			echo "$links";
			echo endHead;
			
			include_once("../layout/header.php");
			// Create Header
			$logo = "<a href= Home.php class=logo>MUSIC NOW</a>";
			echo "$logo";
			
			// Insert nav content
			$nav= "<ul class= navList>".
					"<li><a href= >About</a></li>".
					"<li>".
					"<form class='loginForm' method='POST' action='../plug-ins/VerifyLogin.php'>".
					"<input class='em' type='text' name='email' placeholder='Email'>".
					"<input class='pw' type='password' name='password' placeholder='Password'>".
					"<input id='login' type='submit' name='login' value='Log In'>".
					"</form>".
					"</li>".
					"</ul>";
			echo "$nav";
			
			echo endHeader;
		
			// Include Home.php gain to access the $body variable
			include("../layout/Layout.php");
			include("../functions/getFunctions.php"); // Holds the requested search
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