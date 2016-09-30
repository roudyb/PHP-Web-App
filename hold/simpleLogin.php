<?php
//########################################################################################
// -------------- Summary
// Simple multi-user rights managment. Ask to login on protected pages.
// Admin manager interface included.
// No database. 1 line of code to insert at the top of protected pages.
//
// -------------- Author
// Logan Dugenoux - 2004
// logan.dugenoux@netcourrier.com
// http://www.peous.com/logan/
//
// -------------- License
// GPL
//
// -------------- Methods :
// checkLogin()			Ask user to login if not logged, and if logon is wrong, dont displays the page
// checkLogin(0)		Ask user to login if not logged, and if logon is wrong, displays the page anyway
// checkLogin(0,0)		Don't ask user to login if not logged, see userIsLogged()
//
// ManageUsers()		Displays Manager interface if user is admin
//
// userIsLogged()		Return true if user login is successfull (use with checkLogin(0,0))
// userName()			Return the userName the louser logged with
//
// LogOut()				Logs out current user.
//						Automatic if page.php?simpleLogin_logOut=1 is used.
//
// ------------- Example :
// < ?
// require "simpleLogin.php";
// $sl = new simpleLogin();
// $sl->CheckLogin();		// this will not display the page if not logged
// $sl->ManageUsers();		// Put this line if you wand the admin to see the manager interface
// ? >
// You are identified !<br><br>Your user name is < ?=$sl->userName();? >
// <br><br><a href=?simpleLogin_logOut=1>logout</a>
//
// Have fun !!!
//
//########################################################################################


				
	//			$f = fopen(dirname(__FILE__)."/click_ban_".$id.".txt", "w");
	//			if ($f)	{  @fwrite( $f, $nb ); @fclose( $f ); }


	class simpleLogin
	{
   		//---------- PUBLIC ----------------
		function simpleLogin() 
   		{
   		}
   		
		function userIsLogged() 
   		{
   			global $HTTP_SESSION_VARS;
   			return $HTTP_SESSION_VARS["simpleLogin_Logged"];
   		}
   		
		function userName() 
   		{
   			global $HTTP_SESSION_VARS;
   			return $HTTP_SESSION_VARS["simpleLogin_UserName"];
   		}


   		function LogOut() 
   		{
   			global $HTTP_SESSION_VARS;
   			$HTTP_SESSION_VARS["simpleLogin_UserName"] = "";
   			$HTTP_SESSION_VARS["simpleLogin_IsAdmin"] = 0;
   			$HTTP_SESSION_VARS["simpleLogin_Logged"] = 0;
   		}

		function checkLogin( $bExitIfNotIdentified=1, $bAskIfNotIdentified=1 ) 
   		{
   			session_start();
   			global $HTTP_SESSION_VARS, $HTTP_POST_VARS, $HTTP_GET_VARS;
   			
   			if ($HTTP_GET_VARS["simpleLogin_logOut"] == 1)
   				$this->LogOut();
   			
   			@ $users = file(dirname(__FILE__)."/simpleLogin_users.php");
   			if ((!$users)||(sizeof($users)<=2))
   			{
   				$this->ManageUsers();
   				exit();
   			}

   			if (($HTTP_POST_VARS["simpleLogin_login"]!="")&&(!$HTTP_SESSION_VARS["simpleLogin_Logged"]))
			{
				$HTTP_SESSION_VARS["simpleLogin_Logged"] = 0;
				$HTTP_SESSION_VARS["simpleLogin_UserName"] = "";

				if (($users)&&(sizeof($users)>2))
				{
					for($i=1;$i<sizeof($users)-1;$i++)
					{
						$users[$i] = trim($users[$i]);
						if (substr($users[$i],4)==$HTTP_POST_VARS["simpleLogin_login"].":".$HTTP_POST_VARS["simpleLogin_pass"])
						{
							$HTTP_SESSION_VARS["simpleLogin_IsAdmin"] = (substr($users[$i],2,1));
							$HTTP_SESSION_VARS["simpleLogin_Logged"] = 1;
							$HTTP_SESSION_VARS["simpleLogin_UserName"] = $HTTP_POST_VARS["simpleLogin_login"];
							break;
						}
					}
				}
			}
			
			if ((!$HTTP_SESSION_VARS["simpleLogin_Logged"])&&($bAskIfNotIdentified))
			{
				echo "<br><br>";
				$this->debut_tablo("You need to be identified to continue");
				if ($HTTP_POST_VARS["simpleLogin_login"]!="")
					echo "<font color=red size=+1>Login or password incorrect.</font>";
				echo "<br><form method=post><table border=0><tr><td>Login</td><td><input  name=simpleLogin_login></td></tr>";
				echo "<tr><td>Password</td><td><input type=password name=simpleLogin_pass></td></tr>";
				echo "<tr><td colspan=2 align=center><input type=submit value='Login'></td></tr>";
				echo "</table></form>";
				$this->fin_tablo();
				
				if ($bExitIfNotIdentified)
					exit();
				else
					return false;
			}
			return true;
   		}
   		
   		function ManageUsers()
   		{
   			global $HTTP_SERVER_VARS;
   			global $HTTP_GET_VARS;
   			$uri = $HTTP_SERVER_VARS["REQUEST_URI"];
   			$uri  = explode("?", $uri);$uri = $uri[0];
   			if ($this->configOK())
   			{
   				$this->checkLogin();
   				if (!$this->userIsAdmin())
   				{
   					return;		// no admin for "normal" user
   				}
   			}
   			
   			$this->debut_tablo("Manager interface");
   			
   			if ($HTTP_GET_VARS["action"])
   			{
				@ $users = file(dirname(__FILE__)."/simpleLogin_users.php");
				$creationInvalid = 0;
   			
				if (($HTTP_GET_VARS["action"] == "create")&&(strstr($HTTP_GET_VARS["createUser_login"],":")!==FALSE))					$creationInvalid = 1;
				if (($HTTP_GET_VARS["action"] == "create")&&(strstr($HTTP_GET_VARS["createUser_pass"],":")!==FALSE))					$creationInvalid = 1;
   			
				$outString = "<?\n";
				if ($users)
				{
					for($i=1;$i<sizeof($users)-1;$i++)
					{
						$users[$i] = trim($users[$i]);
						$info  = explode(":", substr($users[$i],4));$login = $info[0];$pass = $info[1];
						
						if (($HTTP_GET_VARS["action"] == "delete")&&($login==$HTTP_GET_VARS["user"]))
							continue;
							
						if ($login==$HTTP_GET_VARS["user"])
						{
							if ($HTTP_GET_VARS["action"] == "removeadmin")
								$users[$i] = "//0:".$login.":".$pass;
							if ($HTTP_GET_VARS["action"] == "addadmin")
								$users[$i] = "//1:".$login.":".$pass;
						}
						if (($HTTP_GET_VARS["action"] == "create")&&($HTTP_GET_VARS["createUser_login"]==$login))
							$creationInvalid = 1;
						$outString .= ($users[$i]."\n");
					}
				}
				if (($HTTP_GET_VARS["action"] == "create")&&(!$creationInvalid))
					$outString .= "//1:".$HTTP_GET_VARS["createUser_login"].":".$HTTP_GET_VARS["createUser_pass"]."\n";
				
				$outString .= "?>";
				$f = fopen(dirname(__FILE__)."/simpleLogin_users.php", "w");
				fwrite( $f, $outString );fclose( $f );
			}
   			
			echo "<br><br>";
			
			@ $users = file(dirname(__FILE__)."/simpleLogin_users.php");
			if ($users)
			{
				$this->debut_tablo("Manage existing users");
				if ($creationInvalid)
					echo "<font color=red size=+1>Already existant user name, or invalid character ':' found.</font>";
				
				echo "<table border=1 cellspacing=0 cellpadding=10><tr bgcolor=#AAAAAA><td>Login</td><td>Pass</td><td>is Admin</td><td>Actions</td></tr>";
				for($i=1;$i<sizeof($users)-1;$i++)
				{
					$users[$i] = trim($users[$i]);
					$isAdmin = 	(substr($users[$i],2,1));
					$info  = explode(":", substr($users[$i],4));
					$login = $info[0];
					$pwd = 	$info[1];
					echo "<tr><td>$login</td><td>$pwd</td><td>$isAdmin</td><td>";
					echo "<a href=".$uri."?action=delete&user=".$login.">[delete]</a>&nbsp;&nbsp;";
					if ($isAdmin)
						echo "<a href=".$uri."?action=removeadmin&user=".$login.">[remove admin rights]</a>&nbsp;&nbsp;";
					else
						echo "<a href=".$uri."?action=addadmin&user=".$login.">[add admin rights]</a>&nbsp;&nbsp;";
					echo "</td></tr>";
				}
				echo "</table>";
				$this->fin_tablo();
			}
			else
			{
				$this->debut_tablo("First run");
				echo "<font color=red size=+1>Please create a new admin user.</font>";
				$this->fin_tablo("");
			}
			
			echo "<br>";
			$this->debut_tablo("Create new user");
			echo "<br><form method=get><table border=0><tr><td>Login</td><td><input  name=createUser_login></td></tr>";
			echo "<tr><td>Password</td><td><input name=createUser_pass></td></tr>";
			echo "<tr><td colspan=2 align=center><input type=submit value='Create'></td></tr>";
			echo "</table><input type=hidden name='action' value='create'></form>";
			$this->fin_tablo();
			
			echo "<br><a href=?simpleLogin_logOut=1>[logout]</a>";
			
			$this->fin_tablo();
			exit();
   		}
   		
   		//---------- PROTECTED ----------------
   		
		function configOK()
		{
			@ $users = file(dirname(__FILE__)."/simpleLogin_users.php");
			$ok =  (($users)&&(sizeof($users)>3));
			return $ok;
		}

		function debut_tablo( $titre )
		{
		?>
			<table border=1 align=center bordercolor=#AAAAAA cellspacing=0 cellpadding=10>
			<tr width=100% height=100% ><td width=100% height=100% valign=top bgcolor=#AAAAAA>
			<b><font face=arial color=#000000><?=$titre?></font></b>
			</td></tr>
			<tr><td width=100% height=100% valign=top align=center>
		<?
		}
		
		function fin_tablo()
		{
		?>
			</tr></td>
			</table>
		<?
		}
   		
	}

?>