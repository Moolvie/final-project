
<?php
// This document holds all of the Get functions for the project

//////// START GET FUNCTIONS ////////
	// Displays a specific  song's info
	if(!function_exists('GetSong'))
	{			
		// Displays new song addition 
		function GetSong($db, $songTitle)
		{
			// Sql query to run
			$sqlString = "SELECT SongID, ArtistID, SongTitle, SongLength, SongGenre,SongYear, SongFile ".
				"FROM song ".
				"WHERE SongTitle LIKE '$songTitle%'; ";
			
			// Validate the query, and display the value for each column
			$result = mysqli_query($db, $sqlString);
			if(!$result)
				die("displayNewSong Query Failed");
			
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
			// Sql query to run
			$sqlString = "SELECT ArtistID, ArtistName ".
				"FROM artist ".
				"WHERE ArtistName LIKE '$artistName%'; ";
			
			// Validate the query, and display the value for each column
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
	
	// Display a specific album's info
	if(!function_exists('GetAlbum'))
	{
		function GetAlbum($db, $albumTitle)
		{
			// SQL query to run
			$sqlString = "SELECT album.AlbumID, AlbumTitle, SongGenre AS Genre, SongTitle AS Track ".
				"FROM album, song ".
				"WHERE AlbumTitle LIKE '$albumTitle%' AND
					album.ArtistID = song.ArtistID AND
					album.AlbumID = song.AlbumID; ";
			
			// Validate the query, and display the value for each column
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

	
	
	if(!function_exists('GetFullSongList'))
	{
		function GetFullSongList($db)
		{
			// Create table head
			echo "<tr>".
				"<th>Track</th>".
				"<th>Artist</th>".
				"<th>Album</th>".
				"<th>Length</th>".
				"<th>Genre</th>".
				"<th>Year</th>".
				"<th></th>".
				"</tr>";
			
			// SQL query to run
			// This query gets each song in the database once, 
			// regardless of it not being linked to an album
			$sql = "SELECT `SongTitle`, `ArtistName`, `AlbumTitle`, `SongLength`, `SongGenre`, `SongYear`, `SongFile`\n"
				. "FROM ((`song`\n"
				. "       LEFT JOIN `artist` ON `song`.`ArtistID` = `artist`.`ArtistID`)\n"
				. "       LEFT JOIN `album` ON `song`.`ArtistID` = `album`.`ArtistID`)\n"
				. "       ORDER BY `ArtistName` ASC, `SongTitle` ASC,`SongYear` ASC";

			// Validate the query, and print each row into a distinct table row
			$result = mysqli_query($db, $sql);
			if(!$result)
				die("Query Failed");
			else
			{
				while($row = mysqli_fetch_assoc($result)) // While still fetching rows
				{
					// Create a row new row
					echo "<tr>";
					foreach($row as $key=>$val) // Foreach key and value 
					{
						if($key == "SongFile")	// If this is the filename column
							
							// Create a new column displaying a audio tag to play the song
							echo "<td>".
								"<audio class=\"player\" controls= control >".
								"<source src= \"Upload/{$val}\" type='audio/mpeg'/>".
								"</audio>".
								"</td>";
						elseif($key == "SongLength")	// If this key is the song length column
						{
							// Strip all leading zeroes and colons and store into it's own column
							$val = ltrim($val, ":0");
							echo "<td>{$val}</td>";
						}
						elseif($key == "AlbumTitle")
						{
							// If the album is blank, then display as 'N\A'
							if($val == "")
							{
								$val = "N/A";
								echo "<td>{$val}</td>";
							}
							else
								// Otherwise just display the Title given
								echo "<td>{$val}</td>"; 
							
						}
						else
							// Else just put the value in the respective column
							echo "<td>{$val}</td>";
					}
					echo "</tr>";
				}
			}
		}
	}

	// Displays a list of songs based on a search
	if(!function_exists('GetSearchResults'))
	{
		function GetSearchResults($db, $request)
		{
			// Create table head
			echo "<tr>".
				"<th>Track</th>".
				"<th>Artist</th>".
				"<th>Album</th>".
				"<th>Length</th>".
				"<th>Genre</th>".
				"<th>Year</th>".
				"<th></th>".
				"</tr>";
			
			// SQL query to run
			// This query gets each song in the database once, 
			// regardless of it not being linked to an album
			$sql = "SELECT `SongTitle`, `ArtistName`, `AlbumTitle`, `SongLength`, `SongGenre`, `SongYear`, `SongFile`\n"
				. "FROM ((`song`\n"
				. "       LEFT JOIN `artist` ON `song`.`ArtistID` = `artist`.`ArtistID`)\n"
				. "       LEFT JOIN `album` ON `song`.`ArtistID` = `album`.`ArtistID`)\n"
				."		  WHERE `SongTitle` LIKE '$request%' OR\n"
				."			`SongGenre` LIKE '$request%' OR\n"
				."		  	`AlbumTitle` LIKE '$request%' OR\n"
				."			`ArtistName` LIKE '$request%'\n"
				. "       ORDER BY `ArtistName` ASC, `SongTitle` ASC,`SongYear` ASC";

			// Validate the query, and print each row into a distinct table row
			$result = mysqli_query($db, $sql);
			if(!$result)
				die("Query Failed");
			elseif($result->num_rows == 0)
				die("<h1>No results found</h1>");
			else
			{
				while($row = mysqli_fetch_assoc($result)) // While still fetching rows
				{
					// Create a row new row
					echo "<tr>";
					foreach($row as $key=>$val) // Foreach key and value 
					{
						if($key == "SongFile")	// If this is the filename column
							
							// Create a new column displaying a audio tag to play the song
							echo "<td>".
								"<audio class=\"player\" controls= control >".
								"<source src= \"Upload/{$val}\" type='audio/mpeg'/>".
								"</audio>".
								"</td>";
						elseif($key == "SongLength")	// If this key is the song length column
						{
							// Strip all leading zeroes and colons and store into it's own column
							$val = ltrim($val, ":0");
							echo "<td>{$val}</td>";
						}
						elseif($key == "AlbumTitle")
						{
							// If the album is blank, then display as 'N\A'
							if($val == "")
							{
								$val = "N/A";
								echo "<td>{$val}</td>";
							}
							else
								// Otherwise just display the Title given
								echo "<td>{$val}</td>"; 
							
						}
						else
							// Else just put the value in the respective column
							echo "<td>{$val}</td>";
					}
					echo "</tr>";
				}
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
	
	// Creates a list of genres to choose
	if(!function_exists('GetGenreList'))
	{
		function GetGenreList($db)
		{
				echo "<select name='Genre'>".
					"<option value=''>Select Genre</option>".
					"<option value='blues'>blues</option>".
					"<option value= 'electronic'>electronic</option>".
					"<option value='hip-hop'>hip-hop</option>".
					"<option value='jazz'>jazz</option>".
					"<option value=pop>pop</option>".
					"<option value=rock>rock</option>".
				"</select>";
		}
	}
//////// END GETLIST FUCTIONS ////////
?>