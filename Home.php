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
					<li><a href="">Sign/Log in</a></li>
					<li><a href="">PlayList</a></li>
					<li><a href="">About</a></li>
				</ul>
			</nav>
		</header>
		
		<!--Content Layout-->
		<div class= "container">	
				<div class= "col" id= "left">Left</div>
				
				<div class = "col" id= "center">
					<p id="welcome">WELCOME TO OUR <br>MUSIC LIBRARY</p>
					
					<!--Search form-->				
					<form method="POST" action="SearchResults.php" class= "searchForm">
						<input class = "searchBar" type= "text" name="Request" placeholder="Search Music">
						<input class = "submit" type="Submit" name= "SubmitSearch" value="Search">
					</form>			
					
					<!--Song list-->
					<div class= "songList">
							<?php
								// Connect to the database
								$db = mysqli_connect("localhost","root","!root","songs");
								if ($db === false)
									echo "<p>Connect error: " . mysqli_error() . "</p>\n";
							?>
							<table class="songTable">
							<?php
								include_once("getFunctions.php");
								GetFullSongList($db);
							?>
							</table>
					</div>
				</div>
				
				<div class= "col" id= "right">Right</div>
				
		</div>
		
		<!--Footer -->
		<footer  class="footer"></footer>
	</body>
	
</html>
