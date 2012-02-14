<?php
include '../mylib/connect.php';
/* RECEIVE VALUE */
$validateValue=$_GET['fieldValue'];
$validateId=$_GET['fieldId'];

Cn::conn();
Cn::selectdb();



	/* RETURN VALUE */
	$arrayToJs = array();
	$arrayToJs[0] = $validateId;
// Did this before, instead of a while, because I was getting parsererror when returning several values
// It didn't work using WHERE clause.	
$result = Cn::q("SELECT email FROM User WHERE email = '$validateValue' LIMIT 1");
while ($row = Cn::f($result, MYSQL_ASSOC)) {
	$dbvalue = $row['email'];
}

if($validateValue != $dbvalue){		// validate??
	$arrayToJs[1] = true;			// RETURN TRUE
	echo json_encode($arrayToJs);			// RETURN ARRAY WITH success
}else{
	for($x=0;$x<1000000;$x++){
		if($x == 990000){
			$arrayToJs[1] = false;
			echo json_encode($arrayToJs);		// RETURN ARRAY WITH ERROR
		}
	}
	
}



?>