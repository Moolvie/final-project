<!DOCTYPE html>
<HTML>
<HEAD>
</HEAD>
<STYLE>
	LABEL {
		display: inline-block;
		width: 100px;
	}
</STYLE>
<BODY>

<?php
	
	$dbName = "songs";
	$showForm = false;
	
	// Connect to the database
	$dbConnect = mysqli_connect("localhost", "root", "!root", $dbName);
	if($dbConnect === false) // If it can't connect
		echo "<p>Connect error: " . mysqli_error() . "</p>\n";
	else
	{
		
		// Submission of new artist
		if(isset($_POST['SubmitArtist']))
		{
			// Add the new artist and display 
			// Hold's all of the entered data
			$artistName = stripcslashes($_POST['ArtistName']);
			$artistName = trim($artistName);
			global $showForm;
			
			// Adding the new artist
			if($artistName == '')	// If blank name
				echo '<p>You must enter an <u>artist name</u></p>';
			else
			{
				include_once("../functions/addFunctions.php");
				// Build query for artist Table
				$addArtist = @mysqli_query($dbConnect, "SELECT * FROM artist WHERE ArtistName = '$artistName'");
				
				// Add the new artist
				AddArtist($addArtist, $dbConnect, $artistName);
				echo "\"$artistName\" has been successfully added.";
			}
		}
		else
			$showForm = true;
		
		// Submission of new song
		if(isset($_POST['SubmitSong']))
		{
			// Add the new song and display 
			
			include_once("../functions/addFunctions.php");
			
			// Holds all of the entered data
			$artistID = (int)$_POST['ArtistID'];
			$albumID = (int)$_POST['AlbumID'];
			$songTitle = $_POST['SongTitle'];
			$songLength = $_POST['SongLength'];
			$songYear = (int)$_POST['SongYear'];
			$songGenre = $_POST['Genre'];
			$songFile = $_FILES['SongFile']['name'];
			$temp = $_FILES['SongFile']['tmp_name'];
			
			// Regex pattern for the duration entry
			$timePattern = '/^(?:(?:([01]?\d|2[0-3]):)?([0-5]?\d):)?([0-5]?\d)$/';
			global $showForm;
			
			
			if($songTitle =='') // If blank title
				echo "<p>You must enter a <u>song title</u></p>";
			
			elseif (!(preg_match($timePattern, $songLength,$matches)) ||
				$songLength == '') // If the entered data doesn't match the timePattern
				echo '<p>Enter duration in the following format:<br>'.
				'<u>hh:mm:ss</u></p>';
				
			elseif($songYear == '' || 
				(!($songYear >= 1860) ||
				(!($songYear <= date('Y'))))) // If the songYear is blank, or isn't btwn 1860 - current year
				echo "Must enter a valid year between 1860 and ".date('Y')."";
				
			elseif ($artistID == 'Select Artist' ||
				$artistID == '') // If blank ID
				echo '<p>You must select an <u>artist</u></p>';
			elseif($songGenre == '' ||
					$songGenre == 'Select Genre')
				echo '<p>You must select a genre</p>';
			elseif (!(validateFile("SongFile")) === true) // If valid 
				echo "<p>File not valid</p>";
			else
			{
				// Build query for artist Table
				$addSong = $dbConnect->query("SELECT * FROM song ".
					"WHERE ArtistID = $artistID AND ".
					"AlbumID = $albumID AND ".
					"SongTitle = '$songTitle' AND ".
					"SongLength= '$songLength' AND ".
					"SongYear= '$songYear' AND ".
					"SongFile= '$songFile' AND ".
					"SongGenre= '$songGenre'");
				
				// Add the new artist to the database
				AddSong($addSong, $dbConnect, 
						$artistID, $albumID, 
						$songLength, $songGenre, $songTitle,
						$songYear, $songFile);
				
				$dirName = "upload";	// Directory to create
				
				// If the directory doesn't exist, create it
				if(!is_dir($dirName))	
					mkdir("$dirName");	
				
				if(is_dir($dirName))	// If Upload directory exists
				{
					try	// Try to upload to Upload folder
					{
						// Upload Song file to "Upload" folder
						move_uploaded_file($temp, "../$dirName/".$songFile);
						echo "<p>\"$songTitle\" has been successfully uploaded</p>";
					} 
					catch(exception $e){
						echo "<p>$e</p>";
					}
					
				}
			}
		}
		else
			$showForm = true;	
	
		// Submit new Album
		if(isset($_POST['SubmitAlbum']))
		{
			global $showForm;
			//Add the new album and display
			
			// Hold's all entered data
			$artistID =(int)$_POST['ArtistID'];
			$albumTitle = $_POST['AlbumTitle'];
			$albumGenre = $_POST['Genre'];
			
			if($albumTitle == '') // If blank title
				echo '<p>You must select an <u>album title</u></p>';
			elseif ($artistID == 'Select Artist' ||
				$artistID == '') // If blank artist
				echo '<p>You must select an <u>artist</u></p>';
			else
			{
				include_once("../functions/addFunctions.php");
				// Build query for album Table
				$addAlbum = $dbConnect->query("SELECT * FROM album ".
					"WHERE ArtistID = $artistID AND ".
					"AlbumTitle = '$albumTitle' AND ".
					"AlbumGenre = '$albumGenre'");
					
				// Add the New Album
				AddAlbum($addAlbum, $dbConnect,
						$albumTitle, $albumGenre, $artistID);
				echo "\"$albumTitle\" has been successfully added.";
			}
		}
		else
			$showForm = true;
	}
	if ($showForm)
	{
		?>
			<!-- Submit New Artist-->
			<FORM METHOD="POST" ACTION="AddRecord.php">
				<fieldset style= width:25%>
					<legend><u><b>Add New Artist</b></u></legend>
					<P>
					<LABEL>Artist Name</LABEL>
					<INPUT TYPE="text" name="ArtistName">
					</P>
					<INPUT type="submit" name="SubmitArtist">
					<input type="reset">
				</fieldset>
			</FORM>
			
			<br>
			
			<!-- Submit New Song-->
			<form method="post" action="AddRecord.php" enctype="multipart/form-data">
				<?php
					include("../functions/getFunctions.php");
				?>
				<fieldset style= width:25%>
					<legend><b><u>Add New Song</u></b></legend>
					<p>
						<LABEL>Song Title</Label>
						<INPUT type="text" name="SongTitle">
					</p>
					<p>
						<LABEL>Song Duration (i.e. hh:mm:ss)</Label>
						<INPUT type="text" name="SongLength">
					</p>
					<p>
						<LABEL>Song Year</Label>
						<INPUT type="text" name="SongYear">
					</p>
					<p>
						<LABEL>Artist (Which artist?)</Label>
						<?php
							GetArtistList($dbConnect);
						?>
					</p>
					<p>
						<label>Album (optional)</label>
						<?php
							GetAlbumList($dbConnect);
						?>
					</p>
					<p>
						<label>Genre</label>
						<?php
							GetGenreList($dbConnect);
						?>
					</p>
					<p>
						<LABEL>Song File </Label>
						<INPUT type="file" name="SongFile">
					</p>
					<input type="submit" name="SubmitSong">
					<input type="reset"><br>
				</fieldset>
				
			</form>
			<br>
			
			<!-- Submit New Album-->
			<form method="post" action="AddRecord.php">
				<fieldset style= width:25%>
					<legend><b><u>Add New Album </u></b></legend>
					<p>
						<LABEL>Album Title</Label>
						<INPUT type="text" name="AlbumTitle">
					</p>
					<p>
					<LABEL>Artist (Which artist?)</Label>
						<?php
							GetArtistList($dbConnect);
						?>
					</p>
					<p>
						<label>Genre</label>
						<?php
							GetGenreList($dbConnect);
						?>
					</p>
					<input type="submit" name="SubmitAlbum">
					<input type="reset">
				</fieldset>
			</form>

		<?php	
	}
?>
</BODY>
</HTML>
