<?php
	
	if(!session_start()) {
		header("Location: error.php");
		exit;
	}
	
	$loggedIn = empty($_SESSION['loggedin']) ? false : $_SESSION['loggedin'];
	
	if ($loggedIn) {
		header("Location: membersArea.php");
		exit;
	}
	
	
	$action = empty($_POST['action']) ? '' : $_POST['action'];
	
	if ($action == 'do_login') {
		handle_login();
	} else {
		login_form();
	}
	
	function handle_login() {
	
		$username = empty($_POST['username']) ? '' : $_POST['username'];
		$password = empty($_POST['password']) ? '' : $_POST['password'];
		
		$con = mysqli_connect('sql303.epizy.com','epiz_20659255','nRTve1ctZW','epiz_20659255_MovieWebsite');
		
		if (!$con) {
		    die('Could not connect: ' . mysqli_error($con));
		}
		
		$sql="SELECT * FROM Users WHERE username = '" . $username . "'";
		
		$result = mysqli_query($con,$sql);
		
		
		$row = mysqli_fetch_array($result);
			
		$hashedPassword = hash('sha256', $password);
			if ($hashedPassword == $row['password'] && $password != "") {
				$_SESSION['loggedin'] = $username;
				header("Location: membersArea.php");
				
			} 
			else {	
				$error = 'Incorrect username or password';
				require "login_form.php";
				
			}	
		
		
	}
	
	function login_form() {
		$username = "";
		$error = "";
		require "login_form.php";
		return;
	}
	
	
?>