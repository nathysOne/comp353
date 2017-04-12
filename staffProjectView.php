<?php 
include_once("mySqlFunc.php");
session_start();


echo "<html>";
echo "<head>";
	echo "<title>Construction Inc.</title>";
	echo "<link rel='stylesheet' href='styles.css'>";
echo "</head>";
echo "<body>";
	echo "<h3>Project Page</h3>";
	
	$ProjectIDsuff = $_GET["confirmedProject"];
	diplayProjectLine($ProjectIDsuff);
	$taskID = displayUserProject("prj".$ProjectIDsuff);
	displayUserTasks($taskID);
	
	echo "<a href=index.php>Return To Home</a>";
echo "</body>";
echo "</html>";

?>