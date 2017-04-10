<?php 
include_once("mySqlFunc.php");
session_start();
session_destroy();
?>

<html>
<head>
	<?php 
	//createAllTables(); 
	?>
	<title>Construction Inc.</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<h1>Welcome!</h1>
	<div>
		<h4>Please Log-In</h4>
		<form action="login.php" method="get" id="chooseUser" >
		 <select name="confirmedUsr">
		  <?php
		  	retrieveAll();
		  ?>
		</select>
		<button type="submit" form="chooseUser" value="Submit">Log In</button>
		</form>
	</div>
</body>
</html>

