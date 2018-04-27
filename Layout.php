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
				<div class= "col" id= "left"></div>
				<div class= "col" id= "right"></div>
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
								// Hold the content written in the center column
								$body;
								
								define("endLayout", "</div>\n".
									"</div>\n".
									"</div>\n".
									"<!--Footer -->\n".
									"<footer  class=\"footer\">\n".
									"All music within the public domain <br>\n".
									"Programmed by Najee Minter, Gerald Bell, and Doug Enos\n".
									"</footer>\n".
									"</body>\n".
									"</html>");
							?>
