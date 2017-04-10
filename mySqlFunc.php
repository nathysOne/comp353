<?php


function connectDB(){
	$servername = "localhost";
	$username = "root";
	$password = "password";
	$dbms = "comp353Final";

	// Create connection
	$connection = new mysqli($servername, $username, $password, $dbms);

	// Check connection
	if ($connection->connect_error) {
	    die("Connection failed: ");
	}
	//echo "Connected successfully";
	
	return $connection;
}


//retrieve all users
function retrieveAll(){
	$conn = connectDB();
	
	$sql = "SELECT UsersIDpref, UsersIDsuff, FirstName FROM Users;";
	if(mysqli_query($conn, $sql)) echo "SUCCESS";
		else echo "FAIL";
			
	$result = $conn->query($sql);
	
	while($row = $result->fetch_array(MYSQLI_ASSOC)){
		echo "<option value='";
			echo $row["UsersIDpref"];
			echo $row["UsersIDsuff"];
		echo "'>";
			echo $row["FirstName"];
			echo "</option>";
	}
	
	mysqli_close($conn);	
}

//returns true if customer
function isCustomer($UsrID){
	$conn = connectDB();
	$strLength = strlen($UsrID) - 3;
	$usersIDsuff = substr($UsrID , 3 ,$strLength);
	
	$sql = "SELECT Title FROM Users " .
			"WHERE UsersIDpref = 'usr' " . 
			"AND UsersIDsuff = " . $usersIDsuff . ";";
	
	if(mysqli_query($conn, $sql)) echo "SUCCESS";
		else echo "FAIL";
	
	$result = $conn->query($sql);
	
	$row = $result->fetch_array(MYSQLI_NUM);
	$theTitle = $row[0];
	
	if(strcmp ($theTitle, "Customer") == 0) return true;
	
	return false;
}

//insert user
function insertUser($FirstName, $LastName, $Address, $PhoneNumb, $Title, $ProjectID){
	
	$conn = connectDB();
	
	$sql = "INSERT INTO Users SET " . 
        "FirstName = '" . $FirstName . "', " . 
        "LastName = '" . $LastName . "', " . 
        "Address = '" . $Address . "', " . 
        "PhoneNumb = '" . $PhoneNumb . "', " . 
        "Title = '" . $Title . "', " . 
		"LinkingProject = '" . $ProjectID . "';";
	
	mysqli_query($conn, $sql);
	
	$sql = "SELECT UsersIDpref,UsersIDsuff " .
		"FROM Users " .
		"WHERE FirstName = '" . $FirstName . "' AND " .
			  "LastName = '" . $LastName . "' AND " .
			  "PhoneNumb = '" . $PhoneNumb . "';";
	
	mysqli_query($conn, $sql);

	$result = $conn->query($sql);
	
	$row = $result->fetch_array(MYSQLI_NUM);
	$userID = $row[0] . $row[1];

	mysqli_close($conn);
	return $userID;
}


//insert project
function insertProject($Status, $Estimated, $Phase, $Budget, $PermitCost){
    
	$conn = connectDB();
	
	$sql = "INSERT INTO Project SET " .
        "Status = '" . $Status . "'," . 
        "Estimated = " . $Estimated . "," . 
        "Phase = '" . $Phase . "'," . 
        "Budget = " . $Budget . "," . 
        "PermitCost = " . $PermitCost . ";";
		
	mysqli_query($conn, $sql);
	
	$sql = "SELECT ProjectIDpref,ProjectIDsuff " . 
			"FROM Project " . 
			"WHERE Estimated = '" . $Estimated . "' AND " . 
			  	"PermitCost = '" . $PermitCost . "' AND " . 
			  	"Phase = '" . $Phase . "';";

	$result = $conn->query($sql);
	
	$row = $result->fetch_array(MYSQLI_ASSOC);

	$projectID = $row["ProjectIDpref"] . $row["ProjectIDsuff"];
	
	mysqli_close($conn);
	return $projectID;
}

//insert task
function insertTask($Task, $CostPerHrs, $TimeInHrs){
    
	return taskID;
}

//insert item
function insertItem($ItemName, $CostInDollars, $DeliveryDays, $Supplier){
    
	return itemID;
}


































?>