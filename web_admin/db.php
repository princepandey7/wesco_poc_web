<?php
// echo '<pre>'; print_r($_SERVER);die;
	//set timezone
	date_default_timezone_set("Asia/Kolkata");
	// foreach(PDO::getAvailableDrivers() as $driver)
    // echo $driver, '<br>';
	//database credentials
	// define('DBHOST','localhost');
	// define('DBUSER','root');
	// define('DBPASS','');
	// define('DBNAME','hlearning');

	// define('DBHOST','20.102.69.115');
	// define('DBUSER','lweb');
	// define('DBPASS','Br0nc0$7');
	// define('DBNAME','wesco_azure');

	define('INTERNAL_USERS','xoriant');
	define('REDIS_USERS','wesco-sso-poc.redis.cache.windows.net');
	define('REDIS_AUTH','U3N4FNOJd9TNwHPpdaP41ELa3q8NB0pPlPyqVtJ5X3k=');


	//lweb@//20.102.69.115:1521/oratest1
	$mydb = "
	(DESCRIPTION =
		(ADDRESS_LIST =
		(ADDRESS = (PROTOCOL = TCP)(HOST = 20.102.69.115)(PORT = 1521))
		)
		(CONNECT_DATA =
		(SERVICE_NAME = oratest1)
		)
	)
		";
	//application address
	//HTTP_REFERER
	//SERVER_NAME
	//REQUEST_SCHEME
	// HTTPS
	$strServerIp = $_SERVER['SERVER_NAME'];
	$strSsl = $_SERVER['REQUEST_SCHEME'];

	$strUrl = $strSsl.'://'.$strServerIp.'/wesco_web_app/';
	// define('DIR','https://13.90.206.161/wesco_web_app/');
	define('DIR',$strUrl);

	// try {
	// 	// $conn = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME, DBUSER, DBPASS);
	// 	$conn = new PDO("oci:dbname=".$mydb, DBUSER, DBPASS);
	// 	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 //    }
	// catch(PDOException $e)
 //    {
	// 	echo "Connection failed: " . $e->getMessage();
 //    }

	// include_once 'connect.php';
	// $connection = new Connect($conn);

	// $stmt = $connection->tableData("*","LWEB_USERS");
	// $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
	// echo '<pre>';print_r($results);
	// die;
?>
