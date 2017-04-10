<?php
	include_once("mySqlFunc.php");
	session_start();
	session_destroy();
	
	
 	$userID = $_GET["confirmedUsr"];
	
	if(!(isCustomer($userID))){
		header('Location: staffCP.php');
	}else{
		header('Location: '. $newURL);
	}
	
	
	
?>