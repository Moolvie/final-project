<!--Song list test-->

<html>
<head>
		<link rel="stylesheet" type="text/css" href="mainStyle.css">
		<link href="https://fonts.googleapis.com/css?family=Roboto:100,400" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Black+Han+Sans" rel="stylesheet">		
	</head>
	
	<body>
	<!--Header Content-->
	<header class="header">
			<a href="Home.php" class="logo">MUSIC NOW</a>
			<nav class= "nav">
				<ul class= "navList">
					<li><a href=""></a></li>
					<li><a href="">PlayList</a></li>
					<li><a href="">About</a></li>
				</ul>
			</nav>
		</header>
		<?php
			// Connect to the database
			$db = mysqli_connect("localhost","root","!root","songs");
			if ($db === false)
				echo "<p>Connect error: " . mysqli_error() . "</p>\n";
		?>
		<table border=1>
		<?php
			echo "<tr>".
				"<th>Track</th>".
				"<th>Artist</th>".
				"<th>Album</th>".
				"<th>Length</th>".
				"<th>Year</th>".
				"<th></th>".
				"</tr>";
			
			$sql = "SELECT SongTitle, ArtistName, AlbumTitle, SongLength, SongYear, SongFile ".
				"FROM song, artist, album ".
				"WHERE song.ArtistID = artist.ArtistID AND ".
					"song.AlbumID = album.ArtistID";
			
			$result = mysqli_query($db, $sql);
			if(!$result)
				die("Query Failed");
			else
			{
				while($row = mysqli_fetch_assoc($result))
				{
					echo "<tr>";
					foreach($row as $key=>$val)
					{
						if($key != "SongFile")
							echo "<td>{$val}</td>";
						else
							echo "<td>".
								"<audio id= \"song\" controls=control preload=\"none\">".
								"<source src= \"Upload/{$val}\" type='audio/mpeg'/>".
								"</audio>".
								"</td>";
					}
					echo "</tr>";
				}
			}
			mysqli_close($db);
		?>
		</table>
	</body>
</html>