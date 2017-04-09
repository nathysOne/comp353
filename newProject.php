<?php 
?>

<html>
<head>

	<title>Construction Inc.</title>
	<link rel='stylesheet' href='styles.css'>
</head>
<body>
	<h2>New Project</h2>
	
	<div class= 'infoField'>
		
		 <form action='development.php'>
			 <h5>Customer Info</h5>
		  		<dfn>First name:</dfn><br>
		  	  	<input type='text' name='firstName' value=''><br>
		  	  	<dfn>Last name:</dfn><br>
		  	  	<input type='text' name='lastName' value=''><br>
		  	  	<dfn>Address:</dfn><br>
  		  	  	<input type='text' name='address' value=''><br>
		 	   	<dfn>Phone Number</dfn><br>
  		  	  	<input type='text' name='phoneNumb' value=''><br>
		  	  	<br>
			<h5>Project Info ~ House/Condo</h5>
		  		<dfn>Estimated Total Cost:</dfn><br>
		  	  	<input type='text' name='estimatedTotCost' value=''><br>
		  		<dfn>Cost of Permit:</dfn><br>
		  	  	<input type='text' name='permitCost' value=''><br>
		  		<dfn>Number of Tasks:</dfn><br>
		  	  	<input type='text' name='taskNumb' value=''><br>
		  	  	<br><hr>
		  	  	<input type='submit' value='Submit'>
		</form>
	</div>
	
</body>
</html>

