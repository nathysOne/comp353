<?php
	$firstName = htmlspecialchars($_GET["firstName"]);
	$lastName = htmlspecialchars($_GET["lastName"]);
	$address = htmlspecialchars($_GET["address"]);
	$phoneNumb = htmlspecialchars($_GET["phoneNumb"]);
	
	$estimatedTotCost = (int)htmlspecialchars($_GET["estimatedTotCost"]);
	$permitCost = (int)htmlspecialchars($_GET["permitCost"]);
	$taskNumb = (int)htmlspecialchars($_GET["taskNumb"]);
	
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
  				echo "<dfn>Task #" . $i ." :</dfn>&nbsp;&nbsp;&nbsp;&nbsp;";
  	  			echo "<input type='text' name='tsk" . $i . "' value=''>&nbsp;&nbsp;&nbsp;&nbsp;";
				echo "<dfn>items: </dfn> &nbsp;&nbsp;&nbsp;&nbsp;";
				echo "<input class='smallField' type='text' name='itm" . $i . "' value=''>&nbsp;&nbsp;&nbsp;&nbsp;";
				echo "<br><br>";
			}
			echo "<input type='submit' value='Submit'>";
		echo "</form>";
	echo "</div>";
			
?>