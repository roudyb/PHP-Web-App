<?php
// Start a new session
session_start();
// $_POST (predefined variable) is looking for the vars from the html form method="post"
// and inside the [] is from the form Username: name="username" 
if (isset($_POST['username'])) {
    // Set variables to represent data from database - hardcoded vars
	$dbUsname = "Peter";
	$dbPassword = "test1";
	// This var is used for the SESSION cookie $uid
	$uid = "1111";
	
	// Set the posted data from the form into local variables
	// strip_tags function removes html tags
	$usname = strip_tags($_POST['username']);
	$paswd = strip_tags($_POST['password']);
	
	// Check if the username and the password they entered was correct
	// if the entered username == the hardcoded dbUsname && the entered password
	// == dbPassword, continue if statement
	if ($usname == $dbUsname && $paswd == $dbPassword) {
		// Set a session cookie from the html form Username: name="username"
		// The form element 'username' is defined to SESSION name $usname
		$_SESSION['username'] = $usname;
		// The html form id="form" is set to the predefined var $uid defined to "1111" for
		// the SESSION
		$_SESSION['id'] = $uid;
		// Now direct to users feed set in the user.php file
		header("Location: user.php");
	// If the information entered is incorrect display an error message
	} else {
		echo "<h2>The username or password combination that you entered is incorrect.
		<br /> Please try again.</h2>";
	}
	
}
?>
 
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Basic login system</title>
<!-- CSS included in <head> -->
<style type="text/css">
html {
	font-family: Verdana, Geneva, sans-serif;
}
h1 {
	font-size: 24px;
	text-align: center;
}
#wrapper {
	position: absolute;
	width: 100%;
	top: 30%;
	margin-top: -50px;/* half of #content height*/
}
#form {
	margin: auto;
	width: 200px;
	height: 100px;
}
</style>
</head>
 
<body>
<div id="wrapper">
<h1>Simple PHP Login</h1>
<form id="form" action="index.php" method="post" enctype="multipart/form-data">
<!-- Username field -->
Username: <input type="text" name="username" /> <br />
<!-- type="password" hides the character string on entering it -->
Password: <input type="password" name="password" /> <br />
<!-- Submit button -->
<input type="submit" value="Login" name="Submit" />
</form>
</body>
</html>