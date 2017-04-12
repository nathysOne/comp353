<?php 
include_once("mySqlFunc.php");
session_start();


echo "<html>";
echo "<head>";
	echo "<title>Construction Inc.</title>";
	echo "<link rel='stylesheet' href='styles.css'>";
echo "</head>";
echo "<body>";
	echo "<h3>User Page</h3>";
	
	$projectID = displayUserRow($_SESSION["currentUser"]);
	$taskID = displayUserProject($projectID);
	displayUserTasks($taskID);
	
	echo "<a href=index.php>Return To Home</a>";
echo "</body>";
echo "</html>";

?>