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
	//If user didn't get to this page from registration_form.php, send them there	
	if ($action == 'do_registration') {
		handle_registration();
	} else {
		registration_form();
	}

	function handle_registration() {
		
		$firstName = empty($_POST['firstName']) ? '' : $_POST['firstName'];
		$lastName = empty($_POST['lastName']) ? '' : $_POST['lastName'];
		$username = empty($_POST['username']) ? '' : $_POST['username'];
		$password = empty($_POST['password']) ? '' : $_POST['password'];
		$passwordConfirm = empty($_POST['passwordConfirm']) ? '' : $_POST['passwordConfirm'];
		
	
		$con = mysqli_connect('sql303.epizy.com','epiz_20659255','nRTve1ctZW','epiz_20659255_MovieWebsite');
		
		if (!$con) {
		    die('Could not connect: ' . mysqli_error($con));
		}
		
		//Check if username is already in use
		$check_sql="SELECT * FROM Users WHERE username = '" . $username . "'";
		$result = mysqli_query($con,$check_sql);
		
		if($result && (mysqli_num_rows($result) > 0)) {
			$error = "Username is already in use.";
			require "registration_form.php";
			return;
		}
		
		if($username != "" && $password != "" && $firstName != "" && $lastName != "") {
			if($password != $passwordConfirm){
				$error = "Passwords do not match.";
				require "registration_form.php";
				return;
			}
			
			$hashedPassword = hash('sha256', $password);
			$insert_sql = "INSERT INTO Users (firstName, lastName, username, password) VALUES ('" . $firstName . "', '" . 
			$lastName . "', '" . $username . "', '" . $hashedPassword . "');";
			
			if(!mysqli_query($con,$insert_sql)){
				$error = "User could not be created";
				require "registration_form.php";
				return;
			}
			else {
				$_SESSION['loggedin'] = $username;
				header("Location: membersArea.php");
			}
			
		}
		else {
			$error = "Please fill out all fields.";
			require "registration_form.php";
			return;
		}
	}
				


	
	function registration_form() {
		$username = "";
		$error = "";
		require "registration_form.php";
		return;
	}
	
?>