<?php
session_start();
?>
<!---<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Confirmation</title>
</head>
<body>

<h1>save playlist</h1>-->

<?php

if(isset($_SESSION['customerID']) &&
		!($_SESSION["customerID"] == 0))
{
	if(isset($_POST['songsSubmit']))
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
				"<li>Hello, ".$_SESSION['name']."</li>".
				"<li><a href= 'Playlists.php'>Playlist</a></li>".
				"<li><a href= >About</a></li>".
				"<li><a href= ../plug-ins/logout.php>Log out</a></li>".
				"</ul>";
		echo "$nav";
		
		echo endHeader;
		
		// Include the Website layout to gain access to the $body variable
		include("../layout/PlaylistLayout.php");
		
		include("../functions/getFunctions.php");
		$body = GetSongsToAddList($db);
		echo "$body";
		
		// End the layout
		echo endLayout;	
	}
	
	if(isset($_POST['CreatePlaylist']))
	{
		$playlistName = $_POST['PlaylistName'];
		
		if($playlistName === "")
			echo "Must enter a name for the playlist";
		else
		{
			// Connect to database
			include("../plug-ins/connect_to_songs.php");
			$songsToAdd = mysqli_query($db,$_SESSION['songs']);
			$userID = $_SESSION['customerID'];
			
			include("../functions/addFunctions.php");
			// Add playlist to the db
			AddPlaylist($db, $playlistName, $userID);
			
			// Get the playlist's ID
			$playlistID = $db->insert_id;
			// Add songs to the playlist
			AddPlaylistSongs($songsToAdd, $db, $playlistID);
			
			// Redirect to the playlists pages/Home
			header("Location: ../pages/Playlists.php");
		}
	}
}	
else
{
	$message = "You must log in to add to playlist.";
	echo $message;
	echo "<script type= 'text/javascript'>alert('$message')</script>";
	header("Refresh: 0.001; ../pages/Home.php");
}
?>
