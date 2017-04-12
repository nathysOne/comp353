<?php
	include_once("mySqlFunc.php");
	session_start();
	
	$taskNumb = $_SESSION["numberOfTasks"]; //FOR CONSIDERATION

	$projectID = $_SESSION["workingProjectID"]; //FOR CONSIDERATION
	echo "<h1>". $projectID . "</h1>";
	
	//saves all $_GET tasks name into $_SESSION
	for($i = 0; $i < $taskNumb; $i++){
		$_SESSION["tsk" . $i] = $_GET["tsk" . $i];
	}
	
	//saves all $_GET task objects into DATABASE
	for($i = 0; $i < $taskNumb; $i++){
		$Task = $_GET["tsk" . $i];
		$CostPerHrs = $_GET["csthr" . $i];
		$TimeInHrs = $_GET["hrs" . $i];
		
		$tskTitle = $_SESSION["tsk" . $i];
		$_SESSION[$tskTitle] = insertTask($Task, $CostPerHrs, $TimeInHrs);
		
		linkProjectToConstruction($projectID, $_SESSION[$tskTitle]);
	}
	
	echo "<html>";
		echo "<head>";
			echo "<title>Construction Inc.</title>";
			echo "<link rel='stylesheet' href='styles.css'>";
		echo "</head>";
		echo "<body>";
			
		echo "<div class= 'infoField'>";
			echo "<form action='confirmAll.php'>";
				echo "<h5>Specify Items<h5>";
				
				//outer loop for task
				$itemIncrementIndex = 0;
				for($i = 0; $i<$taskNumb; $i++){
					echo "<div class='innerBox'>";
						echo "<dfn>Task #" . $i ." : ";
						echo $_SESSION["tsk".$i] . "</dfn><br><br>";
						$numbOfItems = (int)$_GET["itm".$i];
						
						//COOKIE PROBLEM!!!
						//Set Cookie, each task has how many items?
						// $cookieTask = "tsk" . $i;
						// setcookie($cookieTask, $numbOfItems, time() + (86400 * 30), "/");
						$tskCount = "tskInc" . $i;
						$_SESSION[$tskCount] = $numbOfItems;
						
						
						//inner loop for items
						for($j = 0; $j<$numbOfItems; $j++){
							echo "<table>";
								
								echo "<tr>";
									echo "<td>";
										echo "<dfn>Item Name: </dfn>";
									echo "</td>";
										
									echo "<td>";
										echo "<input type='text' name='itm" . $itemIncrementIndex . "' value=''><br>";
									echo "</td>";
								echo "</tr>";
										
								echo "<tr>";
									echo "<td>";
										echo "<dfn>Cost($) per Item: </dfn>";
									echo "</td>";
												
									echo "<td>";
										echo "<input class='smallField' type='text' name='cst" . $itemIncrementIndex . "' value=''><br>";
									echo "</td>";
								echo "</tr>";
											
								echo "<tr>";
									echo "<td>";
										echo "<dfn>Delivery Days: </dfn>";
									echo "</td>";
																
									echo "<td>";
										echo "<input class='smallField' type='text' name='dlv" . $itemIncrementIndex . "' value=''><br>";
									echo "</td>";
								echo "</tr>";
								
								echo "<tr>";
									echo "<td>";
										echo "<dfn>Supplier: </dfn>";
									echo "</td>";
																
									echo "<td>";
										echo "<input type='text' name='spl" . $itemIncrementIndex . "' value=''><br>";
									echo "</td>";
								echo "</tr>";
								
								echo "<tr>";
									echo "<td>";
										echo "<dfn>Quantity: </dfn>";
									echo "</td>";
																
									echo "<td>";
										echo "<input class='smallField' type='text' name='qnt" . $itemIncrementIndex . "' value=''><br>";
									echo "</td>";
								echo "</tr>";								
								
								echo "<hr>";
								
							echo "</table>";
							
							$itemIncrementIndex++;
														
						}
					echo "</div><br>";
					
				}
				echo "<input type='submit' value='Submit'>";
			echo "</form>";
		echo "</div>";
		
		
		///TEST/////
		// echo "<pre>";
		// 	print_r($_GET);
		// echo "</pre>";
		///TEST/////
		
		///TEST/////
		// echo "<pre>";
		// 	print_r($_SESSION);
		// echo "</pre>";
		///TEST/////
		
		echo "</body>";
	echo "</html>";
			
?>