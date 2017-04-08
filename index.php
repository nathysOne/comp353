<?php 
include_once 'connection.php';
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
		<h4>Please Log-In</h4>
		<form action="login.php" method="get" id="chooseUser" >
		 <select name="confirmedUsr">
		  <option value="Director">Director</option>
		  <option value="Staff">Staff</option>
		  <option value="User">User</option>
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

