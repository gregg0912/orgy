<?php
	session_start();   //  Must start a session before destroying it
	// if(isset($_SESSION["username"])){ //if login in session is not set
  	   	session_unset();
		session_destroy();
		header('Location:login.php');
		exit();	
	 // }
?>