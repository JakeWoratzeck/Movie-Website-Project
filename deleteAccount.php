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
	
	$action = empty($_POST['action']) ? '' : $_POST['action'];
	
	if ($action == 'deleteAccount') {
		handle_deletion($loggedIn);
	} else {
		delete_form();
	}
	
	function handle_deletion($loggedIn) {
	
		$username = empty($_POST['username']) ? '' : $_POST['username'];
		$password = empty($_POST['password']) ? '' : $_POST['password'];
		
		$con = mysqli_connect('sql303.epizy.com','epiz_20659255','nRTve1ctZW','epiz_20659255_MovieWebsite');
		
		if (!$con) {
		    die('Could not connect: ' . mysqli_error($con));
		}
		
		$sql="SELECT * FROM Users WHERE username = '" . $loggedIn . "'";
		
		$result = mysqli_query($con,$sql);
		
		
		$row = mysqli_fetch_array($result);
			
			if ($password == $row['password'] && $password != "" && $username == $row['username']) {
				$delete_sql = "DELETE FROM Users WHERE username = '" . $loggedIn . "';";
				mysqli_query($con, $delete_sql);
				header("Location: logout.php");
				exit();
				
			} 
			else {	
				$error = 'Incorrect username or password';
				require "delete_form.php";
				
			}	
		
		
	}
	
	function delete_form() {
		$username = "";
		$error = "";
		require "delete_form.php";
	}
	
	
?>


