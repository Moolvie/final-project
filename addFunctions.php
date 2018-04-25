<?php

//////// START ADD FUNCTIONS ////////

	// Adds a new song to the database 
	if(!function_exists('AddSong'))
	{
		function AddSong($query, $db, $artistID, $albumID,$songLength, $songTitle, $songYear, $File)
		{
			// run query 
			if (!$query)
				die($db->error);
			else
			{
				$query = $db->query("INSERT IGNORE INTO song(ArtistID, AlbumID, SongID, SongLength, SongTitle, SongYear, SongFile)".
				"VALUES('".$artistID."', '".$albumID."','', '".$songLength."', '".$songTitle."', '".$songYear."', '".$File."')");
				
				if ($query === false)
					echo "SQL error:".$db->error;
			}
		}
	}
	
	if(!function_exists('AddArtist'))
	{
		// Adds a new artist to the database
		function AddArtist($query, $db, $artistName)
		{
			// run query 
				if (!$query)
					die($db->error);
				
				if($query->num_rows > 0)
					echo "duplicate artist name\n";
				else
				{
					$query = $db->query("INSERT IGNORE INTO artist(ArtistID, ArtistName)".
					"VALUES('', '".$artistName."')");
					
					if ($query === false)
						echo "SQL error:".$db->error;
				}
		}
	}
	
	// Adds a new album to the database
	if(!function_exists('AddAlbum'))
	{			
		// Adds new album
		function AddAlbum($query, $db, $albumTitle, $artistID)
		{
			// run query 
				if (!$query)
					die($db->error);
				
				if($query->num_rows > 0)
					echo "duplicate album title\n";
				else
				{
					
					$query = $db->query("INSERT IGNORE INTO album(AlbumID, AlbumTitle, ArtistID) ".
					"VALUES('', '".$albumTitle."', ".$artistID.")");
					
					if ($query === false)
						echo "SQL error:".$db->error;
				}
		}
	}

//////// END ADD FUNCTIONS ////////


	// Validates the file being uploaded
	if(!function_exists('validateFile'))
	{
		function validateFile($tagName)
		{
			$valid = false;
			try 
			{
				// Undefined | Multiple Files | $_FILES Corruption Attack
				// If this request falls under any of them, treat it invalid.
				if (!isset($_FILES["$tagName"]['error']) ||
					is_array($_FILES["$tagName"]['error'])) {
					throw new RuntimeException('Invalid parameters.');
					return $valid;
			}

				// Check $_FILES['upfile']['error'] value.
				switch ($_FILES["$tagName"]['error']) 
				{
					case UPLOAD_ERR_OK:
						break;
						return $valid;

					case UPLOAD_ERR_NO_FILE:
						throw new RuntimeException('No file sent.');
						return $valid;
						
					case UPLOAD_ERR_INI_SIZE:
					case UPLOAD_ERR_FORM_SIZE:
						throw new RuntimeException('Exceeded filesize limit.');
						return $valid;
						
					default:
						throw new RuntimeException('Unknown errors.');
						return $valid;
				}

				// You should also check filesize here *size in bytes* 
				if ($_FILES["$tagName"]['size'] > 100000000)
				{
					throw new RuntimeException('Exceeded filesize limit of 100,000,000 bytes.');
					return $valid;
				}

				// Check MIME Type.
				// This makes sure a valid file type is being uploaded
				$finfo = new finfo(FILEINFO_MIME_TYPE);
				if (false === $ext = array_search(
					$finfo->file($_FILES["$tagName"]['tmp_name']),
					array(
						'mp3' => 'audio/ogg',
						'mp3' => 'audio/mpeg'),true)) // If the file is an mp3 file
				{
					throw new RuntimeException('Invalid file format.');
					return $valid;
				}
				
				// If it passes all tests, return as valid
				$valid = true;
				return $valid;

			} catch (RuntimeException $e) {

				echo $e->getMessage();
			}
			
		}
	}
?>
