<?php
	//echo 'Hello ' . htmlspecialchars($_GET["confirmedUsr"]) . '!';
 	$userStr = substr($_GET["confirmedUsr"],0,1);
	
	if(strcmp($userStr, "U") == 0){
		header('Location: '.$newURL);
	}else{
		header('Location: staffCP.php');
	}
	
	
	
?>