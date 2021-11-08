<?php

session_start();
require_once '../simplesamlphp/lib/_autoload.php';
$as = new SimpleSAML_Auth_Simple('default-sp');
$as->requireAuth();

$attributes = $as->getAttributes();


$arrOutputLists = [];
foreach ($attributes as $key => $value) {
	$arrExplodeData = explode('/', $key);
	$arrOutputLists[end($arrExplodeData)] = $value[0];
}

$url = $as->getLogoutURL();

SimpleSAML_Session::getSessionFromRequest()->cleanup();

$_SESSION['token'] = $arrOutputLists['objectidentifier'];
$_SESSION['get_user_id'] = $arrOutputLists['displayname'];
$_SESSION['user_email'] = $arrOutputLists['emailaddress'];
$_SESSION['login_type'] = 'msaml';
$_SESSION['logout_url'] = $url;

header('Location: https://13.90.206.161/wesco_web_app/home.php');

// echo '<a href="' . htmlspecialchars($url) . '">Logout</a>';

?>
