<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Confirmation</title>
</head>
<body>

<h1>save playlist</h1>
<?php 

session_start();
if(isset($_SESSION['customerID']) &&
		!($_SESSION["customerID"] == 0))
{
	if(isset($_POST['songsSubmit']))
	{
		include("../plug-ins/connect_to_songs.php");
		
		$query = 'SELECT * FROM song Where ';
		$song_count = count($_POST['pick']);

		for($i = 0; $i < $song_count; $i++) {
		  $songid = (int)mysqli_real_escape_string($db, $_POST['pick'][$i]); // Secures It
		  $query .= 'SongID = ' . $songid;
		  if($i+1 < $song_count) {
			$query .= ' OR ';
		  }
		  $_SESSION['songs'] = $query;
		}
		
		if ($r = mysqli_query($db, $query)) { 
		   echo "<table border=1>";
			while ($row = mysqli_fetch_array($r)) {
			   echo  "<tr> <td>{$row['SongID']}</td> <td>{$row['SongTitle']}</td> </tr>";
			}
			echo "</table>";
		
		echo 
		"<form method='POST' action='../plug-ins/savePlaylist.php'>".
		"<input type='text' name='PlaylistName' placeholder='Playlist Name'>".
		"<input type='submit' name='CreatePlaylist' value='Create'>";
		} else { 
			print '<p style="color: blue">Error!</p>';
		}
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
		}
	}
}	
?>
