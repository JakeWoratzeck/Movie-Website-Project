<?php
	
	if(!session_start()) {
		header("Location: error.php");
		exit;
	}
	
	$loggedIn = empty($_SESSION['loggedin']) ? false : $_SESSION['loggedin'];
	if (!$loggedIn) {
		header("Location: login.php");
		exit;
	}
?>


<!DOCTYPE html>
<html>
    <head>
        <title>MovieInfo App</title>
        <meta charset="UTF-8">
        <script src="jquery-ui-1.12.1.custom/external/jquery/jquery.js"></script>
        <script src="jquery-ui-1.12.1.custom/jquery-ui.js"></script>
        <link rel="stylesheet" href="jquery-ui-1.12.1.custom/jquery-ui.css">
        <link href="app.css" rel="stylesheet" type="text/css">
        
   		<script>
   		
   		$( function() {
   			$("#selectMenu").selectmenu({
   				change: function( event, ui ) { 
   				getMovie(ui.item.value)
   				}
   			})
   		});
   		
   		
   		$( function() {
   			var comingSoonMovies = [
   				["roguePoster.jpeg", "12/16", "Rogue One"],
   				["collateralPoster.jpg", "12/16", "Collateral Beauty"],
   				["assassinPoster.jpg", "12/21", "Assassin's Creed"],
   				["whyPoster.jpg", "12/23", "Why Him?"]
   			];
   			
   			
   			for(var i=0; i < $(comingSoonMovies).length; i++) {
   				$("#posterBox").append("<div class='sideBySide'> <img class='posterPic' src='Posters/" + comingSoonMovies[i][0] + "'> <p>" + comingSoonMovies[i][1] + "</p> <p>" + comingSoonMovies[i][2] + "</p> </div>");
   			}
   		});
   			
   			
   		function getMovie(movieTitle) {
                var xmlHttp = new XMLHttpRequest();
    
                xmlHttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                    	var movies = JSON.parse(xmlHttp.responseText);
                    	var i;
                    	for(i=0; i < movies.length; i++){
                    		if(movieTitle == movies[i].title){
                    			var selectedMovie = movies[i];
                    		}
                    	
                    	}
            
                    	document.getElementById("titleArea").innerHTML = selectedMovie.title;
                    	document.getElementById("posterArea").innerHTML = "<img class='posterPic' src='Posters/" + selectedMovie.poster + "' alt='" +selectedMovie.title + "'>";
                    	document.getElementById("descriptionArea").innerHTML = selectedMovie.description;
                    	document.getElementById("trailerArea").innerHTML = "<iframe id='video' src='https://www.youtube.com/embed/" + selectedMovie.trailer + "' frameborder='0' allowfullscreen></iframe>";
                    	document.getElementById("ratingArea").innerHTML = selectedMovie.rating;
                    }	 	
                }
                document.getElementById('titleArea').innerHTML = "Loading...";
                
                xmlHttp.open("GET", "movieData.json", true);
                
                xmlHttp.send();
                
        } 
            
            
   		</script>
   		
   		
    </head>
    
    <body>
        <div id="mainContainer">
        	<div class="titleWrapper"><h1>MovieInfo</h1></div>
        	
        	<br>
        	
        	<form method="GET">
        		<select name="selectMenu" id="selectMenu">
        			<option disabled selected>Current Movies</option>
        			<optgroup label="Family">
        				<option value="Moana">Moana</option>
        				<option value="Trolls">Trolls</option>
        			</optgroup>
        			
        			<optgroup label="Horror/Thriller">
        				<option value="Arrival">Arrival</option>
        				<option value="Incarnate">Incarnate</option>
        			</optgroup>
        			
        			<optgroup label="Action">
        				<option value="Fantastic Beasts and Where to Find Them">Fantastic Beasts and Where to Find Them</option>
        				<option value="Doctor Strange">Doctor Strange</option>
        				<option value="Allied">Allied</option>
        			</optgroup>	
        			
        			<optgroup label="Drama">
        				<option value="Hacksaw Ridge">Hacksaw Ridge</option>
        			</optgroup>
        			
        			<optgroup label="Comedy">
        				<option value="Almost Christmas">Almost Christmas</option>
        				<option value="Bad Santa 2">Bad Santa 2</option>
        			</optgroup>
        			
        		</select>				
        	</form>
        </div> 
        
        <div id="movieDisplay" class="roundBox">
        	<div id="titleArea"></div>
        	<div id="ratingArea"></div>
        	<div id="posterArea"><h2>Select a movie above to view information about it</h2></div>
        	<div id="descriptionArea"></div>
        	<div id="trailerArea"></div>
                	
        </div>
        
        <br>
        
        <div id="posterBox" class="roundBox group">
        	<h2>Coming Soon</h2>
        	
        </div>
        
        <br>
        
        
		
       	<div class="logoutWrapper roundBox">
       		<p>You are currently logged in</p>
       		<button class="logoutButton" onclick="location.href='logout.php';">Log Out</button>
       	</div>
       
       
    </body>
</html>