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

function createAllTables(){
	$conn = connectDB();
	
	$sql = "CREATE TABLE Project (" . 
	        "ProjectIDpref varchar(3) DEFAULT 'prj', " . 
			"ProjectIDsuff int(10) NOT NULL AUTO_INCREMENT, " . 
		
	        "Status varchar(30) NOT NULL, " . 
	        "Estimated int(10) NOT NULL, " . 
	        "Phase varchar(20) NOT NULL, " . 
	        "Budget int(10), " . 
			"PermitCost int(10) NOT NULL, " . 
	        "PRIMARY KEY (ProjectIDsuff, ProjectIDpref)" . 
			"); ";
	mysqli_query($conn, $sql);


	$sql = "CREATE TABLE Construction (" . 
			"TaskIDpref varchar(3) DEFAULT 'tsk', " . 
			"TaskIDsuff int(10) NOT NULL AUTO_INCREMENT, " . 
		
	        "Task varchar(30) NOT NULL, " . 
	        "CostPerHrs int(10) NOT NULL, " . 
	        "TimeInHrs int(10) NOT NULL, " . 
	        "PRIMARY KEY (TaskIDsuff, TaskIDpref)" . 
			"); ";
	mysqli_query($conn, $sql);

	$sql = "CREATE TABLE Item (" . 
	    	"ItemIDpref varchar(3) DEFAULT 'itm', " . 
			"ItemIDsuff int(10) NOT NULL AUTO_INCREMENT, " . 
		
	        "ItemName varchar(30) NOT NULL, " . 
	        "CostInDollars int(10) NOT NULL, " . 
	        "DeliveryDays int(10) NOT NULL, " . 
	        "Supplier varchar(30) NOT NULL, " . 
	        "PRIMARY KEY (ItemIDsuff, ItemIDpref)" . 
			"); ";
	mysqli_query($conn, $sql);

	$sql = "CREATE TABLE Users (" . 
	    	"UsersIDpref varchar(3) DEFAULT 'usr', " . 
			"UsersIDsuff int(10) NOT NULL AUTO_INCREMENT, " . 
		
	        "FirstName varchar(30) NOT NULL, " . 
	        "LastName varchar(30) NOT NULL, " . 
	        "Address varchar(100) NOT NULL, " . 
	        "PhoneNumb varchar(20) NOT NULL, " . 
	        "Title varchar(30) NOT NULL, " . 
			"LinkingProject varchar(30), " . 
	        "PRIMARY KEY (UsersIDsuff, UsersIDpref)" . 
			"); ";
	mysqli_query($conn, $sql);

	$sql = "CREATE TABLE QtyForItems (" . 
			"ProjectIDpref varchar(3) NOT NULL, " . 
			"ProjectIDsuff int(10) NOT NULL, " . 
	
			"TaskIDpref varchar(3) NOT NULL, " . 
			"TaskIDsuff int(10) NOT NULL, " . 
				
	    	"ItemIDpref varchar(3) NOT NULL, " . 
			"ItemIDsuff int(10) NOT NULL, " . 
				
	        "Quantity int(10) NOT NULL, " . 
	       	"PRIMARY KEY (ProjectIDpref, ProjectIDsuff, TaskIDpref, " . 
				"TaskIDsuff, ItemIDpref, ItemIDsuff)" . 
			"); ";
	mysqli_query($conn, $sql);

	$sql = "CREATE TABLE ItemCost (" . 
		"ItemName varchar(30) NOT NULL, " . 
		"Supplier varchar(30) NOT NULL, " . 
		"CostInDollars int(10) NOT NULL, " . 
		"PRIMARY KEY (ItemName, Supplier)" . 
		"); ";
	mysqli_query($conn, $sql);

	#####LINKING TABLES#####
	$sql = "CREATE TABLE ProjectToConstruction (" . 
	    "ProjectIDpref varchar(3), " . 
		"ProjectIDsuff int(10), " . 
	
		"TaskIDpref varchar(3), " . 
		"TaskIDsuff int(10)" . 
		"); ";
	mysqli_query($conn, $sql);

	mysqli_close($conn);
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
	$conn = connectDB();
	
	$sql = "INSERT INTO Construction SET " .
	      		"Task= '" . $Task . "', " .
	      		"CostPerHrs= " . $CostPerHrs . ", " .
	      	  	"TimeInHrs= " . $TimeInHrs . ";";
	
	mysqli_query($conn, $sql);
	
	$sql = "SELECT @last_id := MAX(TaskIDsuff) FROM Construction;";
	mysqli_query($conn, $sql);
	$result = $conn->query($sql);
	
	$row = $result->fetch_array(MYSQLI_NUM);
	$taskIDsuff = (int)$row[0];
	
	$taskID = "tsk" . $taskIDsuff;
				
	mysqli_close($conn);
	return $taskID;
}

//insert item
function insertItem($ItemName, $CostInDollars, $DeliveryDays, $Supplier){
    
	$conn = connectDB();
	
	$sql = "INSERT INTO Item SET " .
	      		"ItemName= '" . $ItemName . "', " .
	      		"CostInDollars= " . $CostInDollars . ", " .
	      	  	"DeliveryDays= " . $DeliveryDays . ", " .
				"Supplier= " . $Supplier . 
				"; ";
	echo $sql;
	echo "<br>";
	mysqli_query($conn, $sql);
	
	$sql = "SELECT @last_id := MAX(ItemIDsuff) FROM Item;";
	mysqli_query($conn, $sql);
	$result = $conn->query($sql);
	
	$row = $result->fetch_array(MYSQLI_NUM);
	$itemIDsuff = (int)$row[0];
	
	$itemID = "itm" . $itemIDsuff;
				
	mysqli_close($conn);
	return $itemID;
}

function insertQtyForItems($ProjectID, $TaskID, $ItemID, $Quantity){
	
	$conn = connectDB();
	
	$Quantity = (int)$Quantity;
	
	$strLength = strlen($ProjectID) - 3;
	$ProjectIDsuff = substr($ProjectID , 3 ,$strLength);
	$ProjectIDpref = "prj";

	$strLength = strlen($TaskID) - 3;
	$TaskIDsuff = substr($TaskID , 3 ,$strLength);
	$TaskIDpref = "tsk";
	
	$strLength = strlen($ItemID) - 3;
	$ItemIDsuff = substr($ItemID , 3 ,$strLength);
	$ItemIDpref = "itm";
	
	$sql = "INSERT INTO QtyForItems SET " .
				"ProjectIDpref = 'prj', " .
				"ProjectIDsuff = " . $ProjectIDsuff . ", " .
				"TaskIDpref = 'tsk', " .
				"TaskIDsuff = " . $TaskIDsuff . ", " .
				"ItemIDpref = 'itm', " .
				"ItemIDsuff = " . $ItemIDsuff . ", " .
				"Quantity = " . $Quantity . ";";
	
	mysqli_query($conn, $sql);
	mysqli_close($conn);
}

function linkProjectToConstruction($ProjecID, $TaskID){
	$conn = connectDB();
	
	$strLength = strlen($ProjecID) - 3;
	$pIDsuff = substr($ProjecID , 3 ,$strLength);
	
	$strLength = strlen($TaskID) - 3;
	$tIDsuff = substr($TaskID , 3 ,$strLength);
	
	$sql = "INSERT INTO ProjectToConstruction SET " .
				"ProjectIDpref = 'prj', " .
				"ProjectIDsuff = " . $pIDsuff . ", " .
				"TaskIDpref = 'tsk', " .
				"TaskIDsuff = " . $tIDsuff . ";";
					
	mysqli_query($conn, $sql);
	mysqli_close($conn);
}

function insertItemCost($ItemName, $Supplier, $CostInDollars){
	
	$conn = connectDB();
	
	$sql = "INSERT INTO ItemCost SET " .
	      		"ItemName= '" . $ItemName . "', " .
	      		"Supplier= '" . $Supplier . "', " .
	      	  	"CostInDollars= " . $CostInDollars . ";";
	
	mysqli_query($conn, $sql);
	mysqli_close($conn);
}

function calculateBudget($ProjectID, $ItemID){
	$conn = connectDB();
	
	
	//multiply QtyForItems.qty and ItemID.CostInDollars where projID = 
	//+
	//sum(for each: projectID_A->task.CostPerHrs * projectID_A->task.TimeInHrs)
	//+
	//PermitCost.permit
	
	mysqli_query($conn, $sql);
	mysqli_close($conn);
}











?>