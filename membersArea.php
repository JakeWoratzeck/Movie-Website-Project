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
   		
   		//NEED TO POPULATE COMING SOON
   		$( function() {
   			var comingSoonMovies = [
   				["jediPoster.jpg", "12/17", "Star Wars: The Last Jedi"],
   				["jumanjiPoster.jpg", "12/20", "Jumanji"],
   				["pitchPoster.png", "12/22", "Pitch Perfect 3"],
   				["pantherPoster.jpg", "2/16", "Black Panther"]
   			];
   			
   			
   			for(var i=0; i < $(comingSoonMovies).length; i++) {
   				$("#posterBox").append("<div class='sideBySide'> <img class='posterPic' src='Posters/" + comingSoonMovies[i][0] + "'> <p>" + comingSoonMovies[i][1] + "</p> <p>" + comingSoonMovies[i][2] + "</p> </div>");
   			}
   		});

   		
   		//Fetches getmovie.php which selects the movie selected from the dropdown and returns
   		//html to be inserted into "movieDisplay"
   		function getMovie(movieTitle) {
        	xmlhttp = new XMLHttpRequest();
        	xmlhttp.onreadystatechange = function() {
            	if (this.readyState == 4 && this.status == 200) {
                	document.getElementById("movieDisplay").innerHTML = this.responseText;
            	}
        	};
        	

        	document.getElementById('posterArea').innerHTML = "Loading...";
        	
        	xmlhttp.open("GET","getmovie.php?q="+movieTitle,true);
        	xmlhttp.send();
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
        				<option value="Coco">Coco</option>
        			</optgroup>
        			
        			<optgroup label="Thriller/Horror">
        				<option value="Murder on the Orient Express">Murder on the Orient Express</option>
        			</optgroup>
        			
        			<optgroup label="Action">
        				<option value="Darkest Hour">Darkest Hour</option>
        				<option value="Thor: Ragnarok">Thor: Ragnarok</option>
        			</optgroup>	
        			
        			<optgroup label="Drama">
        				<option value="Roman J Israel, ESQ.">Roman J Israel, ESQ.</option>
        				<option value="Call Me By Your Name">Call Me By Your Name</option>
        			</optgroup>
        			
        			<optgroup label="Comedy">
        				<option value="The Man Who Invented Christmas">The Man Who Invented Christmas</option>
        				<option value="Daddy''s Home 2">Daddy's Home 2</option>
        			</optgroup>
        			
        		</select>				
        	</form>
        </div> 
        
        
        <div id="movieDisplay" class="roundBox">
        	<div id="posterArea"><h2>Select a movie above to view information about it</h2></div>
                	
        </div>
        
        <br>
        
        <div id="posterBox" class="roundBox group">
        	<h2>Coming Soon</h2>
        	
        </div>
        
        <br>
        
        
		
       	<div class="logoutWrapper roundBox">
       		<?php echo  "<p>Logged in as: " . $loggedIn . "</p>"?>
       		<button class="logoutButton" onclick="location.href='getUser.php';">Account Details</button>
       		<br>
       		<br>
       		<button class="logoutButton" onclick="location.href='logout.php';">Log Out</button>

       	</div>
       
       
    </body>
</html>