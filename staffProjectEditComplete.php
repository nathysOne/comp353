<?php 
include_once("mySqlFunc.php");
session_start();

$conn = connectDB();
echo "<html>";
echo "<head>";
	echo "<title>Construction Inc.</title>";
	echo "<link rel='stylesheet' href='styles.css'>";
echo "</head>";
echo "<body>";
	echo "<h3>Project Changes Complete</h3>";
	
	if (!empty($_GET["confirmedStatus"])) {
		$sql = "UPDATE Project SET " . 
		        "Status='" . $_GET["confirmedStatus"] . "' WHERE " . 
		        "ProjectIDsuff=" . $_SESSION["ProjectIDForEdit"] . ";";
		mysqli_query($conn, $sql);
	}
	if (!empty($_GET["confirmedPhase"])) {
		$sql = "UPDATE Project SET " . 
		        "Phase='" . $_GET["confirmedPhase"] . "' WHERE " . 
		        "ProjectIDsuff=" . $_SESSION["ProjectIDForEdit"] . ";";
		mysqli_query($conn, $sql);
	}
	
	echo "<a href=index.php>Return To Home</a>";
echo "</body>";
echo "</html>";

mysqli_close($conn);
session_unset();
session_destroy();
?>