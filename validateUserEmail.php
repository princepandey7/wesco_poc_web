<?php
	/* RECEIVED VALUE */
	$validateValue=$_REQUEST['fieldValue'];
	$validateId=$_REQUEST['fieldId'];

	$validateError= "This username is already taken";
	$validateSuccess= "This username is available";

	/* RETURN VALUE */
	$arrayToJs = array();
	$arrayToJs[0] = $validateId;
 
	require_once("web_admin/db.php");
 
 	$existUser = $connection->OneRowCondition("count(*) as COUNT", "user", "user_email='{$validateValue}' and user_type='Customer'");
 
	if($existUser['COUNT'] > 0){
		$arrayToJs[1] = false;
		echo json_encode($arrayToJs); // RETURN ARRAY WITH ERROR
	} else {
		$arrayToJs[1] = true;
		echo json_encode($arrayToJs); // RETURN ARRAY WITH success
	}
?>