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
	<title>MovieInfo Login</title>
	<meta charset="UTF-8">
	<link href="app.css" rel="stylesheet" type="text/css">
    <script src="jquery-ui-1.12.1.custom/external/jquery/jquery.js"></script>
    <script src="jquery-ui-1.12.1.custom/jquery-ui.js"></script>
    <link rel="stylesheet" href="jquery-ui-1.12.1.custom/jquery-ui.css">
    
    <script>
        $(function(){
            $("input[type=submit]").button();
        });
    </script>

</head>
<body>
	<div id="mainContainer">
        	<div class="titleWrapper"><h1>MovieInfo</h1></div>
    <div id="loginWidget" class="ui-widget">
        
        <h1 class="ui-widget-header" style="border-radius: 10px 10px 0 0;">Confirm Account Deletion</h1>
        
        <?php
            if ($error) {
                print "<div class=\"ui-state-error\">$error</div>\n";
            }
        ?>
        
        <form action="deleteAccount.php" method="POST">
            
            <input type="hidden" name="action" value="deleteAccount">
            
            <div class="stack">
    			<h3>To delete your account, confirm your username and password.</h3>	
            </div>
            <div class="stack">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" class="ui-widget-content ui-corner-all" autofocus value="<?php print $username; ?>">
            </div>
            
            <div class="stack">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" class="ui-widget-content ui-corner-all">
            </div>
            
            <div class="stack">
                <input type="submit" value="Delete">
            </div>
        </form>
    </div>
    <div class="logoutWrapper"><button class="logoutButton" onclick="location.href='user_form.php';">Cancel</button></div>
</body>
</html>