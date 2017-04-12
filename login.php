<?php
	include_once("mySqlFunc.php");
	session_start();
	
	
 	$userID = $_GET["confirmedUsr"];
	
	if(!(isCustomer($userID))){
		header('Location: staffCP.php');
	}else{
		$_SESSION["currentUser"] = $userID;
		header('Location: customerPage.php');
	}
?>