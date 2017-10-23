<?php
	session_start();
	session_destroy();
	header("location: login.htm");
	echo "<h1>Thank you Mr. ".$_GET['managername']."You have Sucessfully Logged out!<h1>";
?>