<?php
require "simpleLogin.php";
$sl = new simpleLogin();
if ($HTTP_GET_VARS["login"])
{
	$sl->CheckLogin();
}
else
{
	$sl->CheckLogin(0,0);
}

if (!$sl->userIsLogged())
{
	echo "You are not identified <a href=?login=1>click here to identify</a>, or continue unidentified.";
}
else
{
	echo "You are identified as ".$sl->userName();
	echo " <a href=?simpleLogin_logOut=1>logout</a>";
}
?>
<br>
<br><a href=?random=<?=rand();?>>continue browsing <?=rand();?></a>
<br>
<br>
<br>
<br>

 
