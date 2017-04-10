<?php
	include_once("mySqlFunc.php");
	session_start();
	
	$taskNumb = $_COOKIE["taskNumb"];
	setcookie("taskNumb", "", time() - 3600);
	
	$projectID =  $_COOKIE["projectID"];
	setcookie("projectID", "", time() - 3600);
	
	//saves all $_GET tasks into DATABASE
	$itemIncrementIndex = 0;
	for($i = 0; $i < $taskNumb; $i++){
		$tskIncrement = "tsk" . $i;
		$tskTitle = $_SESSION[$tskIncrement];
		$currentTaskID = $_SESSION[$tskTitle];

		$itemNumb = $_COOKIE[$tskIncrement];
		echo "item numb: " . $itemNumb . "<br>";
		setcookie($tskIncrement, "", time() - 3600);
		
		for($g = 0; $g < $itemNumb; $g++){
			$ItemName = $_GET["itm" . $itemIncrementIndex];
			$CostInDollars = $_GET["cst" . $itemIncrementIndex];
			$DeliveryDays = $_GET["dlv" . $itemIncrementIndex];
			$Supplier = $_GET["spl" . $itemIncrementIndex];
			$Quantity = $_GET["qnt" . $itemIncrementIndex];
			
			insertItemCost($ItemName, $Supplier, $CostInDollars);
			
			$ItemID = insertItem($ItemName, $CostInDollars, $DeliveryDays, $Supplier);
		
			insertQtyForItems($projectID, $currentTaskID, $ItemID, $Quantity);
			
			$itemIncrementIndex++;
		}


	}
	
	echo "<html>";
		echo "<head>";
			echo "<title>Construction Inc.</title>";
			echo "<link rel='stylesheet' href='styles.css'>";
		echo "</head>";
		echo "<body>";
			echo "<h2>Project Complete<h2>";
		
		
		
		///TEST/////
		echo "<pre>";
		echo "<h5>SESSION<h5>";
			print_r($_SESSION);
		echo "</pre>";
		///TEST/////
		///TEST/////
		echo "<pre>";
		echo "<h5>GET<h5>";
			print_r($_GET);
		echo "</pre>";
		///TEST/////
		
		echo "</body>";
	echo "</html>";
	
	// remove all session variables
	session_unset();
	session_destroy(); 
			
?>