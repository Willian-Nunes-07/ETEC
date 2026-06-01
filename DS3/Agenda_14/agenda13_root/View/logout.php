<?php

	session_start();
	
	if(isset($_SESSION['Usuario']))
	{
	
	session_destroy();
	header("Location:../index.php");
	}
	else {
		echo "oi";
		
	}
		
?>