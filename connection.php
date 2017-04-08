 <?php
 
function connect() {
	$servername = "localhost";
	$username = "root";
	$password = "password";

	// Create connection
	$conn = new mysqli($servername, $username, $password);

	// Check connection
	if ($conn->connect_error) {
	    die("<script>console.log( 'Connection failed: " . 
			$conn->connect_error . "' );</script>");
	}
	echo "<script>console.log( 'Connected successfully' );</script>";             
}
 
?> 