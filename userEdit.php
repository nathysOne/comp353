<?php 
include_once("mySqlFunc.php");
session_start();

echo "<html>";
echo "<head>";
	echo "<title>Construction Inc.</title>";
	echo "<link rel='stylesheet' href='styles.css'>";
echo "</head>";
echo "<body>";
	echo "<h3>User Edit</h3>";
	
	echo "<form action='userEditComplete.php'>";
		if (!empty($_GET["firstNameEdit"])) {
			if(empty($_SESSION["workingUserID"])) $_SESSION["workingUserID"] = $_GET["firstNameEdit"];
		    echo "<input type='text' name='firstname' value='First Name'><br>";
		}
		if (!empty($_GET["lastNameEdit"])) {
			if(empty($_SESSION["workingUserID"])) $_SESSION["workingUserID"] = $_GET["lastNameEdit"];
		    echo "<input type='text' name='lastname' value='Last Name'><br>";
		}
		if (!empty($_GET["addressEdit"])) {
			if(empty($_SESSION["workingUserID"])) $_SESSION["workingUserID"] = $_GET["addressEdit"];
		    echo "<input type='text' name='address' value='Address'><br>";
		}
		if (!empty($_GET["phoneEdit"])) {
			if(empty($_SESSION["workingUserID"])) $_SESSION["workingUserID"] = $_GET["phoneEdit"];
		    echo "<input type='text' name='phoneNumb' value='Phone Number'><br>";
		}
		echo "<input type='submit' value='Submit Change'>";
	echo "</form>";
	
	echo "<a href=index.php>Return To Home</a>";
echo "</body>";
echo "</html>";

?>