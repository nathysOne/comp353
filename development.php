<?php
	include_once("mySqlFunc.php");
	session_start();
	//session_destroy();

	$taskNumb = (int)htmlspecialchars($_GET["taskNumb"]);
	$_SESSION["numberOfTasks"] = $taskNumb; //FOR CONSIDERATION

	$estimatedTotCost = (int)htmlspecialchars($_GET["estimatedTotCost"]);
	$permitCost = (int)htmlspecialchars($_GET["permitCost"]);

	$projectID = insertProject("in progress", $estimatedTotCost, "planning", 0, $permitCost);
	echo "<h1>". $projectID . "</h1>";
	$_SESSION["workingProjectID"] = $projectID; //FOR CONSIDERATION
	
	$firstName = htmlspecialchars($_GET["firstName"]);
	$lastName = htmlspecialchars($_GET["lastName"]);
	$address = htmlspecialchars($_GET["address"]);
	$phoneNumb = htmlspecialchars($_GET["phoneNumb"]);
	
	insertUser($firstName, $lastName, $address, $phoneNumb, "Customer", $projectID);
	

	echo "<html>";
		echo "<head>";
			echo "<title>Construction Inc.</title>";
			echo "<link rel='stylesheet' href='styles.css'>";
		echo "</head>";
		echo "<body>";
			
		echo "<div class= 'infoField'>";
			echo "<form action='itemAddition.php'>";
				echo "<h5>Specify Tasks<h5>";
				
				for($i = 0; $i<$taskNumb; $i++){
				echo "<table>";
					echo "<tr>";	
						echo "<td>";
							echo "<dfn>Task #" . $i ." :</dfn>";
						echo "</td>";
						echo "<td>";
							echo "<input type='text' name='tsk" . $i . "' value=''>";
						echo "</td>";
					echo "</tr>";
					
					echo "<tr>";
						echo "<td>";
							echo "<dfn>items: </dfn>";
						echo "</td>";
						echo "<td>";
							echo "<input class='smallField' type='text' name='itm" . $i . "' value=''>";
						echo "</td>";
					echo "</tr>";
					
					echo "<tr>";
						echo "<td>";
							echo "<dfn>Time in hours: </dfn>";
						echo "</td>";
						echo "<td>";
							echo "<input class='smallField' type='text' name='hrs" . $i . "' value=''>";
						echo "</td>";
					echo "</tr>";
					
					echo "<tr>";
						echo "<td>";
							echo "<dfn>Cost per Hour: </dfn>";
						echo "</td>";
						echo "<td>";
							echo "<input class='smallField' type='text' name='csthr" . $i . "' value=''>";
						echo "</td>";
					echo "</tr>";
				echo "</table>";
				echo "<hr>";
				}
				
				echo "<input type='submit' value='Submit'>";
			echo "</form>";
		echo "</div>";
		
		
		echo "</body>";
	echo "</html>";
			
?>