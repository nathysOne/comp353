<?php
	include_once("mySqlFunc.php");
	session_start();
	
	$taskNumb = $_SESSION["numberOfTasks"]; //FOR CONSIDERATION
	
	$projectID = $_SESSION["workingProjectID"]; //FOR CONSIDERATION
	
	//saves all $_GET tasks into DATABASE
	$itemIncrementIndex = 0;
	for($i = 0; $i < $taskNumb; $i++){
		//$tskIncrement = "tsk" . $i;
		$tskIncrement = "tskInc" . $i;
		
		$tskTitle = $_SESSION["tsk" . $i];
		$currentTaskID = $_SESSION[$tskTitle];

		//COOKIE PROBLEM!!!
		$itemNumb = $_SESSION[$tskIncrement];
		
		for($g = 0; $g < $itemNumb; $g++){
			$ItemName = $_GET["itm" . $itemIncrementIndex];
			$CostInDollars = $_GET["cst" . $itemIncrementIndex];
			$DeliveryDays = $_GET["dlv" . $itemIncrementIndex];
			$Supplier = $_GET["spl" . $itemIncrementIndex];
			$Quantity = $_GET["qnt" . $itemIncrementIndex];
			
			insertItemCost($ItemName, $Supplier, $CostInDollars);
			
			$ItemID = insertItem($ItemName, $DeliveryDays, $Supplier);
		
			insertQtyForItems($projectID, $currentTaskID, $ItemID, $Quantity);
			
			$itemIncrementIndex++;
		}
		
	}
	
	calculateBudget($projectID);
	
	echo "<html>";
		echo "<head>";
			echo "<title>Construction Inc.</title>";
			echo "<link rel='stylesheet' href='styles.css'>";
		echo "</head>";
		echo "<body>";
			echo "<h2>Project Complete<h2>";
		
		
		
		///TEST/////
		// echo "<pre>";
		// echo "<h5>SESSION<h5>";
		// 	print_r($_SESSION);
		// echo "</pre>";
		///TEST/////
		// ///TEST/////
		// echo "<pre>";
		// echo "<h5>GET<h5>";
		// 	print_r($_GET);
		// echo "</pre>";
		// ///TEST/////
		
		echo "</body>";
	echo "</html>";
	
	// remove all session variables
	session_unset();
	session_destroy();
	
	echo "<a href=index.php>Return To Home</a>";
			
?>