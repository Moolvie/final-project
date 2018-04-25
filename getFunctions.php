
<?php
// This document holds all of the Get functions for the project

//////// START GET FUNCTIONS ////////
	// Displays a specific  song's info
	if(!function_exists('GetSong'))
	{			
		// Displays new song addition 
		function GetSong($db, $songTitle)
		{
			$sqlString = "SELECT SongID, ArtistID, SongTitle, SongLength, SongYear, SongFile ".
				"FROM song ".
				"WHERE SongTitle LIKE '$songTitle%'; ";
			
			$result = mysqli_query($db, $sqlString);
			if(!$result)
				die("displayNewSong Query Failed");
			
			echo "<p>Successfully added new song:</p>";
			while($row=mysqli_fetch_assoc($result)) // While fetching each table row
			{
				foreach($row as $key=>$val) // For each row
				
					if($val == "") // If there's no value, list as "NULL"
					{
						echo("{$key}: " . "NULL<br>");
					}
						
					else
						echo("{$key}: " . "{$val}<br>");
				// Making space for the next row
				echo("<br/><hr/><br/>");
			}
		}
	}
	
	// Display a specific artist's info
	if(!function_exists('GetArtist'))
	{
		function GetArtist($db, $artistName)
		{
			$sqlString = "SELECT ArtistID, ArtistName ".
				"FROM artist ".
				"WHERE ArtistName LIKE '$artistName%'; ";
			
			$result = mysqli_query($db, $sqlString);
			if(!$result)
				die("Query Failed");

			echo "<p>Successfully added new artist:</p>";
			while($row=mysqli_fetch_assoc($result)) // While fetching each table row
			{
				foreach($row as $key=>$val) // For each row
				
					if($val == "") // If there's no value, list as "NULL"
					{
						echo("{$key}: " . "NULL<br>");
					}
					else
						echo("{$key}: " . "{$val}<br>");
				// Making space for the next row
				echo("<br/><hr/><br/>");
			}
		}
	}
	
	// Display a specific album's info
	if(!function_exists('GetAlbum'))
	{
		function GetAlbum($db, $albumTitle)
		{
			$sqlString = "SELECT album.AlbumID, AlbumTitle, SongTitle AS Track ".
				"FROM album, song ".
				"WHERE AlbumTitle LIKE '$albumTitle%' AND
					album.ArtistID = song.ArtistID AND
					album.AlbumID = song.AlbumID; ";
			
			$result = mysqli_query($db, $sqlString);
			if(!$result)
				die("Query Failed");

			while($row=mysqli_fetch_assoc($result)) // While fetching each table row
			{
				foreach($row as $key=>$val) // For each row
				
					if($val == "") // If there's no value, list as "NULL"
					{
						echo("{$key}: " . "NULL<br>");
					}
					else
						echo("{$key}: " . "{$val}<br>");
				// Making space for the next row
				echo("<br/><hr/><br/>");
			}
		}
	}

//////// END GET FUNCTIONS ////////	

//////// START GETLIST FUNCTIONS ////////

	// Creates an html Select List of Albums
	if (!function_exists('GetAlbumList'))
	{
		function GetAlbumList($db)
		{
			$result = @mysqli_query($db, "select AlbumID, AlbumTitle from album");
			echo "<select name='AlbumID'>";
			echo '<option>Select Album</option>';
			while ($row = $result->fetch_assoc()) {              			 
					echo '<option value="'.$row['AlbumID'].'">'.$row['AlbumTitle'].'</option>';
			}
			echo "</select>";
		}
	}
	
	// Creates an html Select List of Artists
	if (!function_exists('GetArtistList'))
	{
		function GetArtistList($db)
		{
			$result = @mysqli_query($db, "select ArtistID, ArtistName from artist");
			echo "<select name='ArtistID'>";
			echo '<option>Select Artist</option>';
			while ($row = $result->fetch_assoc()) {              			 
					echo '<option value="'.$row['ArtistID'].'">'.$row['ArtistName'].'</option>';
			}
			echo "</select>";
		}
	}
//////// END GETLIST FUCTIONS ////////
?>