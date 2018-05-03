<html>
	<body>
		<!--Content Layout-->
		<div class= "container">	
				<div class= "col" id= "left"></div>
				<div class= "col" id= "right"></div>
				<div class = "col" id= "center">
					<p id="welcome">Your Playlists</p>
					
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
								
								define("endLayout", 
									"</div>\n".
									"</div>\n".
									"</div>\n".
									"<!--Footer -->\n".
									"<footer  class=\"footer\">\n".
									"<p>All music is within the public domain, ".
									"and downloaded from <a target= _blank href = http://freemusicarchive.org>FMA.org</a><br>".
									"Developed by Najee Minter, Doug Enos, and Gerald Bell</p>".
									"</footer>\n".
									"</body>\n".
									"</html>");
							?>
