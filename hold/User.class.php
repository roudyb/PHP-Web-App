<?php
// Start a new session
session_start();
// $_SESSION is the cookie and 'id' originates from the html form id="form" 
// if SESSION id is set (html form id="form" is set to the predefined var $uid defined to
//						 "1111" for the SESSION)
if (isset($_SESSION['id'])) {
	// Put stored session variables $_SESSION['id'] from index.php into local PHP variable
	// $uid
	$uid = $_SESSION['id'];
	$usname = $_SESSION['username'];
	// Create a $result var that will be echoed in the html body where $usname and $uid is
	// concatenated
	$result = "Test variables: <br> Username: ".$usname. "<br> Id: ".$uid;
	// If no $_SESSION is set then the $_result will be echoed
} else {
	$result = "You are not logged in yet";
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<!-- PHP is being used in the title echoing the current $usname and this will display in the tab/chrome of the browser -->
<title><?php echo $usname ;?> - Test Site</title>
</head>
 
<body>
<?php
echo $result;
?>
</body>
</html>