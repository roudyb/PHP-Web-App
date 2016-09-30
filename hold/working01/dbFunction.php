<?php
require_once 'dbConnect.php';
session_start();
 	class dbFunction {
		  
		function __construct() {
			
			// connecting to database
			$db = new dbConnect();;
			 
		}
		// destructor
		function __destruct() {
			
		}
		public function UserRegister($username, $emailid, $password){
			 	$password = md5($password);
				$qr = mysql_query("INSERT INTO users(username, emailid, password) values('".$username."','".$emailid."','".$password."')") or die(mysql_error());
				return $qr;
			 
		}
		public function Login($emailid, $password){
				$emailid = "roudydesign@gmail.com";
				$password = "test1";
			 
				 
		}
		public function isUserExist($emailid){
			$qr = mysql_query("SELECT * FROM users WHERE emailid = '".$emailid."'");
			echo $row = mysql_num_rows($qr);
			if($row > 0){
				return true;
			} else {
				return false;
			}
		}
	}
?>