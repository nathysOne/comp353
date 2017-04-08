<?php
include_once 'connection.php';

//insert user
function insertUsr($FirstName, $LastName, $Address, $PhoneNumb, $Title, $LinkingProject){
	
	$sql = "INSERT INTO Users SET " .
        "FirstName = " . $FirstName . ", "
        "LastName = " . $LastName . ", "
        "Address = " . $Address . ", "
        "PhoneNumb = " . $PhoneNumb . ", "
        "Title = " . $Title . ", "
		"LinkingProject = " . $LinkingProject . ";";
			
	try{
		mysqli_query($conn, $sql);
	}catch(Exception $e){
		echo $e->getMessage();
	}
}


//insert project

//insert task

//insert item
?>