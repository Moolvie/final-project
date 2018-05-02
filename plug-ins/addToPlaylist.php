<?php
	session_start();
	if(isset($_SESSION['customerID']) &&
			!($_SESSION["customerID"] == 0))
	{
		// Connect to the database
		include("../plug-ins/connect_to_songs.php");
		// Storing the customer's ID 
		$userID = $_SESSION['customerID'];
		// Holds alert message
		$message;
		
		// Query to get all playlists from the user
		$query = mysqli_query($db,"SELECT playlistID FROM playlist WHERE CustomerID = ".$userID);
		if(!$query)
			die($db->error);
		$row = mysqli_fetch_assoc($query);
		$playlistID = $row["playlistID"];
		
		echo "$playlistID";
		
		if(isset($_POST["submit"]))
		{
			$query = @mysqli_query("SELECT SongID FROM song WHERE SongFile = ".$_POST['Add']);
			if(!$query)
				die($db->error);
			$row = mysqli_fetch_assoc($query);
			$songID = $row['SongID'];
			
			$sqlString = "SELECT CustomerID, playlistID ".
						"FROM playlist ".
						"WHERE CustomerID = '$userID' AND ".
							"playListID = '$playListID'";
			
			$result = $db->query($sqlString);
			
			if($result === false)
				die("Query Failed");
			else
			{
				$result = $db->query("INSERT INTO playlist_songs(".
							"PlaylistID, SongID)".
							"VALUES('$playListID', '$songID.')");
			}
			$message = "Song added to playlist";
			echo $message;
			echo "<script type= 'text/javascript'>alert('$message')</script>";
			//header("Refresh: 0.001; ../pages/Home.php");
		}
		else
		{
			$message = "Couldn't add song to playlist";
			echo $message;
			echo "<script type= 'text/javascript'>alert('$message')</script>";
			//header("Refresh: 0.001; ../pages/Home.php");
		}
	}
	else
	{
		$message = "You must log in to add to playlist.";
		echo $message;
		echo "<script type= 'text/javascript'>alert('$message')</script>";
		//header("Refresh: 0.001; ../pages/Home.php");
	}
?>