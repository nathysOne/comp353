<?php 
include_once("mySqlFunc.php");
session_start();


echo "<html>";
echo "<head>";
	echo "<title>Construction Inc.</title>";
	echo "<link rel='stylesheet' href='styles.css'>";
echo "</head>";
echo "<body>";
	echo "<h2>User Edit</h2>";
	
	$conn = connectDB();
	$UsersIDsuff = $_SESSION["workingUserID"];
	if (!empty($_GET["firstname"])) {
		$sql = "UPDATE Users SET " . 
		       		"FirstName ='" . $_GET["firstname"] . "' WHERE " . 
		       		"UsersIDsuff = '" . $UsersIDsuff . "'";
		mysqli_query($conn, $sql);
	}
	if (!empty($_GET["lastname"])) {
		$sql = "UPDATE Users SET " . 
		       		"LastName ='" . $_GET["lastname"] . "' WHERE " . 
		       		"UsersIDsuff = '" . $UsersIDsuff . "'";
		mysqli_query($conn, $sql);
	}
	if (!empty($_GET["address"])) {
		$sql = "UPDATE Users SET " . 
		       		"Address ='" . $_GET["address"] . "' WHERE " . 
		       		"UsersIDsuff = '" . $UsersIDsuff . "'";
		mysqli_query($conn, $sql);
	}
	if (!empty($_GET["phoneNumb"])) {
		$sql = "UPDATE Users SET " . 
		       		"PhoneNumb ='" . $_GET["phoneNumb"] . "' WHERE " . 
		       		"UsersIDsuff = '" . $UsersIDsuff . "'";
		mysqli_query($conn, $sql);
	}
	mysqli_close($conn);
	
	echo "<h3>User Edit Completed</h3>";
	
	echo "<a href=index.php>Return To Home</a>";
echo "</body>";
echo "</html>";

?>