<!DOCTYPE html>

<html>
	<head>
		<link href="app.css" rel="stylesheet" type="text/css">
	</head>

	<body>

	<?php
		
		
		$q = $_GET['q'];
		$con = mysqli_connect('sql303.epizy.com','epiz_20659255','nRTve1ctZW','epiz_20659255_MovieWebsite');
		if (!$con) {
		    die('Could not connect: ' . mysqli_error($con));
		}
		$sql="SELECT * FROM Movies WHERE title = '".$q."'";
		$result = mysqli_query($con,$sql);
				while($row = mysqli_fetch_array($result)) {
					echo "<div id='titleArea'>" . $row['title'] . "</div>";
		        	echo "<div id='ratingArea'>" . $row['rating'] . "</div>";
		        	echo "<div id='posterArea'> <img class='posterPic' src='Posters/" . $row['posterImage'] . "' alt='" . $row['title'] . "'> </div>";
		        	echo "<div id='descriptionArea'>" . $row['description'] . "</div>";
 			       	echo "<div id='trailerArea'> <iframe id='video' src='https://www.youtube.com/embed/" .  $row['trailerLink'] . "' frameborder='0' allowfullscreen></iframe>";
 			       	



				}
		mysqli_close($con);
	?>

	</body>

</html>