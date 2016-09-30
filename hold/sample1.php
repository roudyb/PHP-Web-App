<?php
require "simpleLogin.php";
$sl = new simpleLogin();
$sl->CheckLogin();		// this will not display the page if not logged
$sl->ManageUsers();		// Put this line if you wand the admin to see the manager interface
?>
You are identified !<br><br>Your user name is <?=$sl->userName();?>
<br><br><a href=?simpleLogin_logOut=1>logout</a>
