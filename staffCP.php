<?php 
include_once("mySqlFunc.php");
session_start();
?>

<html>
<head>

	<title>Construction Inc.</title>
	<link rel='stylesheet' href='styles.css'>
</head>
<body>
	<h2>Director/Staff Control Panel</h2>
	<div>
		<div class='infoField'><a href='newProject.php'>Create a New Project</a></div>
		
		<div class='infoField'>
			<form action="staffProjectView.php" method="get">
			<select name="confirmedProject">
			  <?php
			  	retrieveAllProjects();
			  ?>
			</select>
			<br><br><br>
			<button type="submit" value="Submit">View Existing Project</button>
			</form>
		</div>
		
		
	</div>
</body>
</html>

