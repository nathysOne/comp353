<?php
include_once 'connection.php';

//retrieve all users
function retrieveAll(){
	
}

//insert user
function insertUser($FirstName, $LastName, $Address, $PhoneNumb, $Title, $LinkingProject){
	
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
function insertProject($Status, $Estimated, $Phase, $Budget, $PermitCost){
    
}

//insert task
function insertTask($Task, $CostPerHrs, $TimeInHrs){
    
}

//insert item
function insertItem($ItemName, $CostInDollars, $DeliveryDays, $Supplier){
    
}


































?>