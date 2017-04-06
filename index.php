<?php 
include 'connection.php';
connect();
?>

<html>
<head>

	<title>Construction Inc.</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<h1>Welcome!</h1>
	<div>
		<h2>Please Log-In</h2>
		<form action="/control.php" method="get" id="chooseUser" >
		 <select name="confirmedUsr">
		  <option value="Director">Director</option>
		  <option value="Staff">Staff</option>
		  <?php
		  //retrieve all users and add to dropdown
		  //test();
		  ?>
		</select>
		<button type="submit" form="chooseUser" value="Submit">Log In</button>
		</form>
	</div>
</body>
</html>

