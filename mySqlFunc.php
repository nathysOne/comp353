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
	
	
	#####ADD DIRECTOR#####
	$sql = "INSERT INTO Users SET " . 
	        "FirstName='Manny'," . 
	        "LastName='Derik'," . 
	        "Address='123 Widow Lane'," . 
	        "PhoneNumb='23984677'," . 
	        "Title='Director'," . 
			"LinkingProject= '';";
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
	
	
	$sql = "SELECT @last_id := MAX(ProjectIDsuff) FROM Project;";
	$result = $conn->query($sql);
	
	$row = $result->fetch_array(MYSQLI_NUM);
	$projectID = "prj" . (int)$row[0];
	
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
function insertItem($ItemName, $DeliveryDays, $Supplier){
    
	$conn = connectDB();
	
	$sql = "INSERT INTO Item SET " .
	      		"ItemName= '" . $ItemName . "', " .
	      	  	"DeliveryDays= " . $DeliveryDays . ", " .
				"Supplier= '" . $Supplier . 
				"'; ";

	if(!mysqli_query($conn, $sql)) echo "Fail";
	
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

function calculateBudget($ProjectID){
	
	//Transform $ProjectID into ProjectIDSuff
	$strLength = strlen($ProjectID) - 3;
	$ProjectIDsuff = substr($ProjectID , 3 ,$strLength);
	
	$conn = connectDB();
	
	//calculate total item cost for whole project.
	$totalItemSum = 0;
	
	$sql = "SELECT TaskIDsuff FROM ProjectToConstruction " . 
				"WHERE ProjectIDsuff = '" . $ProjectIDsuff . "';";
	mysqli_query($conn, $sql);
	$result = $conn->query($sql);
	
	while($get_TaskID = $result->fetch_array(MYSQLI_ASSOC)){
			$TaskIDsuff = $get_TaskID["TaskIDsuff"];
			
			$sqlInner = "SELECT ItemIDsuff, Quantity FROM QtyForItems " . 
							"WHERE TaskIDsuff = '" . $TaskIDsuff . "';";
			mysqli_query($conn, $sqlInner);
			$resultInner = $conn->query($sqlInner);
			
			while($get_ItemID_Qty = $resultInner->fetch_array(MYSQLI_ASSOC)){
				$ItemIDsuff = $get_ItemID_Qty["ItemIDsuff"];
				$Quantity = $get_ItemID_Qty["Quantity"];
				
				$sqlInnerInner = "SELECT ItemName, Supplier FROM Item " . 
									"WHERE ItemIDsuff = '" . $ItemIDsuff . "';";
				mysqli_query($conn, $sqlInnerInner);
				$resultInnerInner = $conn->query($sqlInnerInner);
				
				$get_ItemName_Supl = $resultInnerInner->fetch_array(MYSQLI_ASSOC);
				$ItemName = $get_ItemName_Supl["ItemName"];
				$Supplier = $get_ItemName_Supl["Supplier"];
					
				$sqlInnerInner = "SELECT CostInDollars FROM ItemCost " . 
									"WHERE ItemName = '" . $ItemName . "'" . 
									"AND Supplier = '" . $Supplier . "';";
				mysqli_query($conn, $sqlInnerInner);
				$resultInnerInner = $conn->query($sqlInnerInner);
				
				$get_CostInDollars = $resultInnerInner->fetch_array(MYSQLI_ASSOC);
				$CostInDollars = $get_CostInDollars["CostInDollars"];
				
				$totalItemSum = $totalItemSum + ($CostInDollars * $Quantity);
			}
	}
	
	
	
	//calculate labour cost for all tasks
	$totalLabourSum = 0;
	
	$sql = "SELECT TaskIDsuff FROM ProjectToConstruction " . 
			"WHERE ProjectIDsuff = " . $ProjectIDsuff . ";";
	mysqli_query($conn, $sql);
	$result = $conn->query($sql);
	
	while($get_TaskID = $result->fetch_array(MYSQLI_ASSOC)){
		
		$TaskIDsuff = $get_TaskID["TaskIDsuff"];
		
		$sqlInner = "SELECT CostPerHrs, TimeInHrs FROM Construction " . 
					"WHERE TaskIDsuff = " . $TaskIDsuff . ";";
		mysqli_query($conn, $sqlInner);
		$result = $conn->query($sqlInner);
		
		$get_Cost_Time = $result->fetch_array(MYSQLI_ASSOC);
		$CostPerHrs = $get_Cost_Time["CostPerHrs"];
		$TimeInHrs = $get_Cost_Time["TimeInHrs"];
		
		$totalLabourSum = $totalLabourSum + ($CostPerHrs * $TimeInHrs);
		
	}
	
	
	//PermitCost
	$sql = "SELECT PermitCost, Estimated FROM Project WHERE ProjectIDsuff = '" . $ProjectIDsuff . "'";
	mysqli_query($conn, $sql);
	$result = $conn->query($sql);
	$thePertmitCost = $result->fetch_array(MYSQLI_ASSOC);
	$Estimated = $thePertmitCost["Estimated"];

	$totalBudget = (int)$thePertmitCost["PermitCost"] + (int)$totalItemSum + (int)$totalLabourSum;
	
	//Estimated - ActualCost
	$estimSubBudget = $Estimated - $totalBudget;
	
	echo "<h4>Total Item Cost: " . $totalItemSum . "<h4>";
	echo "<h4>Total Labour Cost: " . $totalLabourSum . "<h4>";
	echo "<h4>Permit Cost: " . $thePertmitCost["PermitCost"] . "<h4>";
	echo "<h4>Project Total Cost: " . $totalBudget . "<h4>";
	echo "<h4>Surplus/Under: " . $estimSubBudget ."</h4>";

	$sql = "UPDATE Project SET " .
	        "Budget=" . $estimSubBudget . " WHERE " .
	        "ProjectIDsuff=" . $ProjectIDsuff . ";";
	mysqli_query($conn, $sql);
	
	mysqli_close($conn);
}



//////////////////USER FUNCTIONS//////////////////

function displayUserRow($UserID){
	
	$strLength = strlen($UserID) - 3;
	$UsersIDsuff = substr($UserID , 3 ,$strLength);
		
	$conn = connectDB();	
	
	$sql = "SELECT FirstName, LastName, Address, PhoneNumb, LinkingProject " . 
				"FROM Users WHERE UsersIDsuff = " . $UsersIDsuff . ";";
	mysqli_query($conn, $sql);
	$result = $conn->query($sql);
	$get_User = $result->fetch_array(MYSQLI_ASSOC);
	
	$FirstName = $get_User["FirstName"];
	$LastName = $get_User["LastName"];
	$Address = $get_User["Address"];
	$PhoneNumb = $get_User["PhoneNumb"];
	$LinkingProject = $get_User["LinkingProject"];
	mysqli_close($conn);
	
	
	echo "<div id='userDisplay'>";
		echo "<h5>User Information</h5>";
		
		echo "<form action='userEdit.php'>";
		echo "<table id='userDisplayTable'>";
			echo "<tr>";
				echo "<th>";
					echo "First Name";
				echo "</th>";
				echo "<th>";
					echo "Last Name";
				echo "</th>";
				echo "<th>";
					echo "Address";
				echo "</th>";
				echo "<th>";
					echo "PhoneNumb";
				echo "</th>";
			echo "</tr>";
			
			echo "<tr>";
				echo "<td>";
					echo $FirstName;
					echo "<input type='checkbox' name='firstNameEdit' value='" . $UsersIDsuff . "'> ";
				echo "</td>";
				echo "<td>";
					echo $LastName;
					echo "<input type='checkbox' name='lastNameEdit' value='" . $UsersIDsuff . "'> ";
				echo "</td>";
				echo "<td>";
					echo $Address;
					echo "<input type='checkbox' name='addressEdit' value='" . $UsersIDsuff . "'> ";
				echo "</td>";
				echo "<td>";
					echo $PhoneNumb;
					echo "<input type='checkbox' name='phoneEdit' value='" . $UsersIDsuff . "'> ";
				echo "</td>";
			echo "</tr>";
		echo "</table>";
		echo "<input type='submit' value='edit'>";
		echo "</form>";
		
	echo "</div>";
	
	return $LinkingProject;
}

function displayUserProject($ProjectID){
	$strLength = strlen($ProjectID) - 3;
	$ProjectIDsuff = substr($ProjectID , 3 ,$strLength);

	$conn = connectDB();

	$sql = "SELECT Status, Estimated, Phase, Budget, PermitCost " .
				"FROM Project WHERE ProjectIDsuff = " . $ProjectIDsuff . ";";
	mysqli_query($conn, $sql);
	$result = $conn->query($sql);
	$get_Project = $result->fetch_array(MYSQLI_ASSOC);
	
	
	$Status = $get_Project["Status"];
	$Estimated = $get_Project["Estimated"];
	$Phase = $get_Project["Phase"];
	$Budget = $get_Project["Budget"];
	$PermitCost = $get_Project["PermitCost"];
	
	
	echo "<div id='userDisplay'>";
		echo "<h5>Project Information</h5>";
		echo "<p>";
			echo "Your Project is currently: " . $Status . ", and is in phase: " . $Phase . ". <br>";
			echo "The projected Budget was: " . $Estimated . ", yet ";
			if($Budget < 0){
				echo "your are: " . abs($Budget) . " below budget.<br>";
			}else{
				echo "you have a surplus of: " . $Budget . ". <br>";
			}
			echo "The cost of the Permit is: " . $PermitCost . "<br>";
		echo "</p>";
	echo "</div>";
	
	//Retrieve All Tasks Linked to this Project
	$sql = "SELECT TaskIDsuff FROM ProjectToConstruction " . 
				"WHERE ProjectIDsuff = '" . $ProjectIDsuff . "';";
	mysqli_query($conn, $sql);
	$result = $conn->query($sql);
	
	$counter = 0;
	while($get_Task = $result->fetch_array(MYSQLI_ASSOC)){
		$taskStack[$counter] = $get_Task["TaskIDsuff"];
		$counter++;
	}
	
	mysqli_close($conn);
	return $taskStack;
}


function displayUserTasks($taskID){
	
	$conn = connectDB();
	
	echo "<div id='userDisplay'>";
	echo "<h5>Construction Information</h5>";
	
	echo "<table id='userDisplayTable'>";
		echo "<tr>";
			echo "<th>Task Name</th>";
			echo "<th>Labour Cost/hrs</th>";
			echo "<th>Required Labour/hrs</th>";
			echo "<th>Items <br>
				<span class='smallText'>Item Name | Delivery Days | Supplier</span></th>";
		echo "</tr>";
		
		for($i = 0; $i < sizeof($taskID); $i++){
			$taskID[$i];
		
			$sql = "SELECT Task, CostPerHrs, TimeInHrs FROM Construction " .
						"WHERE TaskIDsuff = " . $taskID[$i] . ";";
			mysqli_query($conn, $sql);
			$result = $conn->query($sql);
			$get_Task = $result->fetch_array(MYSQLI_ASSOC);
		
			echo "<tr>";
				echo "<td>" . $get_Task["Task"] . "</td>";
				echo "<td>" . $get_Task["CostPerHrs"] . "$</td>";
				echo "<td>" . $get_Task["TimeInHrs"] . "</td>";
				echo "<td>";
				//INNER TABLE TO DISPLAY EACH ITEMS
				$innerSql = "SELECT ItemIDsuff FROM QtyForItems " . 
								"WHERE TaskIDsuff = " . $taskID[$i] . ";";
				mysqli_query($conn, $innerSql);
				$result = $conn->query($innerSql);
				while($get_ItemID = $result->fetch_array(MYSQLI_ASSOC)){
					$currentItemID = $get_ItemID["ItemIDsuff"];
				
					$innerSql = "SELECT ItemName, DeliveryDays, Supplier FROM Item " . 
									"WHERE ItemIDsuff = " . $currentItemID . ";";
					mysqli_query($conn, $innerSql);
					$innerResult = $conn->query($innerSql);
					$get_ItemInfo = $innerResult->fetch_array(MYSQLI_ASSOC);
				
					
					echo "<table>";
						echo "<tr>";
							echo "<td>" . $get_ItemInfo["ItemName"] . "</td>";
							echo "<td>" . $get_ItemInfo["DeliveryDays"] . "</td>";
							echo "<td>" . $get_ItemInfo["Supplier"] . "</td>";
						echo "</tr>";
					echo "</table>";
					
				}
				echo "</td>";
				echo "</tr>";
		}//end of for loop
		echo "<tr>";
	echo "</table>";
	
	echo "</div>";
	mysqli_close($conn);
}

function retrieveAllProjects(){
	$conn = connectDB();
	
	$sql = "SELECT ProjectIDsuff FROM Project;";
	mysqli_query($conn, $sql);
			
	$result = $conn->query($sql);
	
	while($row = $result->fetch_array(MYSQLI_ASSOC)){
		echo "<option value='";
			echo $row["ProjectIDsuff"];
		echo "'>";
			echo "Project #" . $row["ProjectIDsuff"];
			echo "</option>";
	}
	
	mysqli_close($conn);	
}

function diplayProjectLine($ProjectIDsuff){
	$conn = connectDB();
	$_SESSION["ProjectIDForEdit"] = $ProjectIDsuff;
	
	$sql = "SELECT Status, Estimated, Phase, Budget, PermitCost FROM Project " . 
				"WHERE ProjectIDsuff = '" . $ProjectIDsuff . "';";
	mysqli_query($conn, $sql);
	$result = $conn->query($sql);
	$projectRow = $result->fetch_array(MYSQLI_ASSOC);
	
	$Status = $projectRow["Status"];
	$Estimated = $projectRow["Estimated"];
	$Phase = $projectRow["Phase"];
	$Budget = $projectRow["Budget"];
	$PermitCost = $projectRow["PermitCost"];
	
	$phaseArr[0] = "planning";
	$phaseArr[1] = "construction";
	$phaseArr[2] = "delivery";
	
	$statusArr[0] = "in progress";
	$statusArr[1] = "completed";
	
	echo "<div id='userDisplay'>";
	echo "<form action='staffProjectEditComplete.php' method='get'>";
		echo "<table id='userDisplayTable'>";
		echo "<tr>";
			echo "<th>Current Status</th>";
			echo "<th>Current Phase</th>";
			echo "<th>Estimated Cost</th>";
			echo "<th>Estimated - Actual</th>";
			echo "<th>Cost of Permit</th>";
		echo "</tr>";
			echo "<tr>";
				
				echo "<td>";
			    echo "<select name='confirmedStatus'>";
				for($i = 0; $i<sizeof($statusArr); $i++){
					
					if(strcmp($statusArr[$i], $Status) == 0){
						$selectStr = " selected='selected' ";
					}else{
						$selectStr = "";
					}
					
					echo "<option value='" . $statusArr[$i] . "'";
					echo $selectStr	. ">" . $statusArr[$i] ."</option>";
				}
			   	echo "</select>";
				echo "</td>";
				
				echo "<td>";
			    echo "<select name='confirmedPhase'>";
				for($i = 0; $i<sizeof($phaseArr); $i++){
					
					if(strcmp($phaseArr[$i], $Phase) == 0){
						$selectStr = " selected='selected' ";
					}else{
						$selectStr = "";
					}
					
					echo "<option value='" . $phaseArr[$i] . "'";
					echo $selectStr	. ">" . $phaseArr[$i] ."</option>";
				}
			   	echo "</select>";
				echo "</td>";
				echo "<td>" . $Estimated . "</td>";
				echo "<td>" . $Budget . "</td>";
				echo "<td>" . $PermitCost . "</td>";
			echo "</tr>";
		echo "</table>";
		echo "<br>";
		echo "<button type='submit' value='Submit'>Commit Changes</button>";
	echo "</form>";
	echo "</div>";
		
	
	mysqli_close($conn);
}



?>