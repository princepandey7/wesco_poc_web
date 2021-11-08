<?php
	ob_start();
    session_start();
    $sessionId = session_id();
	$dbHost     = "localhost";
	$dbUsername = "";
	$dbPassword = "";
	$dbName     = "";

	$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
	$userData = json_decode($_POST['userData']);
	
	if(!empty($userData)){

		// $oauth_provider = $_POST['oauth_provider'];

		// $_SESSION['get_user_id'] = $userData->id;
	 //    $_SESSION['user_full_name'] = $userData->first_name .' '. $userData->last_name;
	 //    $_SESSION['FACEBOOK_DETAILS'] = $userData;

		// $fullName = $userData->first_name .' '. $userData->last_name;
		// $random = md5(uniqid(rand(), true));

		// $prevQuery = "SELECT * FROM user WHERE oauth_provider = '".$oauth_provider."' AND oauth_uid = '".$userData->id."'";
		// $prevResult = $db->query($prevQuery);
		// $last_id = '';
	 //    if($prevResult->num_rows > 0){ 

	 //    } else {
	 //    	$query = "INSERT INTO user SET oauth_provider = '".$oauth_provider."', oauth_uid = '".$userData->id."', user_full_name = '".$fullName."', user_email = '".$userData->email."' user_type = 'Customer', user_status = 'Active',  user_random_code = '". $random ."' ,user_created_date = '".date("Y-m-d H:i:s")."'";
  //   		$insert = $db->query($query);
  //   		// $last_id = mysqli_insert_id($db);
		//  	$_SESSION['user_id'] = $userData->id;
	 //        $_SESSION['user_full_name'] = $userData->first_name .' '. $userData->last_name;
	 //        echo 'done';
	 //    }
	}
?>