<?php
	session_start();
	
	$taskNumb = $_COOKIE["taskNumb"];
	setcookie("taskNumb", "", time() - 3600);
	
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
			
		echo "<div class= 'infoField'>";
			echo "<form action='confirmAll.php'>";
				echo "<h5>Specify Items<h5>";
				//outer loop for task
				for($i = 0; $i<$taskNumb; $i++){
					echo "<div class='innerBox'>";
						echo "<dfn>Task #" . $i ." :</dfn><br><br>";
						$numbOfItems = (int)$_GET["itm".$i];
						//inner loop for items
						for($j = 0; $j<$numbOfItems; $j++){
							echo "<table>";
								
								echo "<tr>";
									echo "<td>";
										echo "<dfn>Item Name: </dfn>";
									echo "</td>";
										
									echo "<td>";
										echo "<input type='text' name='itm" . $j . "' value=''><br>";
									echo "</td>";
								echo "</tr>";
										
								echo "<tr>";
									echo "<td>";
										echo "<dfn>Cost($): </dfn>";
									echo "</td>";
												
									echo "<td>";
										echo "<input class='smallField' type='text' name='cst" . $j . "' value=''><br>";
									echo "</td>";
								echo "</tr>";
											
								echo "<tr>";
									echo "<td>";
										echo "<dfn>Delivery Days: </dfn>";
									echo "</td>";
																
									echo "<td>";
										echo "<input class='smallField' type='text' name='dlv" . $j . "' value=''><br>";
									echo "</td>";
								echo "</tr>";
								
								echo "<tr>";
									echo "<td>";
										echo "<dfn>Supplier: </dfn>";
									echo "</td>";
																
									echo "<td>";
										echo "<input type='text' name='spl" . $j . "' value=''><br>";
									echo "</td>";
								echo "</tr>";
								
								echo "<hr>";
								
							echo "</table>";
														
						}
					echo "</div><br>";
					
				}
				echo "<input type='submit' value='Submit'>";
			echo "</form>";
		echo "</div>";
		
		
		///TEST/////
		echo "<pre>";
			print_r($_SESSION);
		echo "</pre>";
		///TEST/////
		
		echo "</body>";
	echo "</html>";
			
?>