<?php
	include("others/functions.php");

	$_SESSION = array(); //empty the session variables
	session_unset();	//unset all session variables
	session_destroy(); //destroy the session variables
	unset($_SESSION);	//unset everything

	header("Location: index.php?logout");
