<?php
	session_start();
	
	
	
	//saves all $_GET tasks into $_SESSION
	for($i = 0; $i < $taskNumb; $i++){
		$_SESSION["tsk" . $i] = $_GET["tsk" . $i];
	}
	
	echo "<html>";
		echo "<head>";
			echo "<title>Construction Inc.</title>";
			echo "<link rel='stylesheet' href='styles.css'>";
		echo "</head>";
		echo "<body>";
			echo "";
		
		///TEST/////
		echo "<pre>";
			print_r($_SESSION);
		echo "</pre>";
		///TEST/////
		
		echo "</body>";
	echo "</html>";
	
	// remove all session variables
	session_unset();
	session_destroy(); 
			
?>