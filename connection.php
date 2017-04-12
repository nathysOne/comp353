 <?php
	$servername = "localhost";
	$username = "root";
	$password = "password";
	$dbms = "comp353Final";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbms);

	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: ");
	}
	echo "Connected successfully";
?> 