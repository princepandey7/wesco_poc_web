<?php

use myPHPnotes\Microsoft\Auth;
use myPHPnotes\Microsoft\Handlers\Session;
use myPHPnotes\Microsoft\Models\User;

// ini_set('session.save_handler', 'redis');
// ini_set('session.name', 'session');
ini_set('session.cookie_domain', '.alidevops.tech');
// ini_set('session.save_path', '/mnt/user-session-data');
// ini_set('session.save_path', 'tcp://wesco-sso-poc.redis.cache.windows.net:6379?auth=U3N4FNOJd9TNwHPpdaP41ELa3q8NB0pPlPyqVtJ5X3k=');

    
session_start();
require "vendor/autoload.php";
require_once("web_admin/db.php");
include("web_admin/functions.php");

logEvent('Getting response for users through microsoft.');

$auth = new Auth(Session::get("tenant_id"),Session::get("client_id"),  Session::get("client_secret"), Session::get("redirect_uri"), Session::get("scopes"));


logEvent('Access Code :'. $_REQUEST['code']).PHP_EOL;

$tokens = $auth->getToken($_REQUEST['code']);
// echo '<pre>';print_r($tokens);die;
$accessToken = isset($tokens->access_token) ? $tokens->access_token : '';

$url = "https://login.microsoftonline.com/common/v2.0/.well-known/openid-configuration";
$guzzle = new \GuzzleHttp\Client();
$data = json_decode($guzzle->request('GET',$url, 
	// ['debug'   => true],
   ['headers' => 
        [
            'Authorization' => "Bearer {$accessToken}"
        ]
    
	])->getBody()->getContents());
logEvent('Token :'. $accessToken).PHP_EOL;
if(!empty($data->claims_supported)){
	if(in_array('aud', $data->claims_supported)){
		
		logEvent('Validate Token :'. json_encode($data->claims_supported)).PHP_EOL;

		// echo '<pre>';print_r($data->claims_supported);die;
		

		$auth->setAccessToken($accessToken);

		$user = new User;
		$strName = $user->data->getDisplayName();
		$strGetMicrosoftEmail = $user->data->getUserPrincipalName();

		logEvent('User Data : '. json_encode($user));

		logEvent('User Name : '. $user->data->getDisplayName());
		logEvent('User Emails : '. $user->data->getUserPrincipalName());


		logEvent('User logged in through : '. $strGetMicrosoftEmail);

		$redis = new Redis();
		$redis->connect(REDIS_USERS, 6379);
		$redis->auth(REDIS_AUTH);

		$strRedisKey = "PHPREDIS_SESSION:". session_id();

		$arList = json_decode($redis->get($strRedisKey),true);

		logEvent('Connected to redis.');

		if(trim($strGetMicrosoftEmail) != trim($_SESSION['validate_sso_email'])){
			
			if(empty($arList)){
				$redis->set($strRedisKey, json_encode([
			           'sso_status' => 'failed'
			       ])
			   	);
			}
			
			header('Location: '. DIR .'mauth_logout.php');
		} else{
			
			if(empty($arList)){
				$redis->set($strRedisKey, json_encode([
			           'sso_status' => 'success',
			           'm_token' => $accessToken,
			           'm_user_name' => $strName,
			           'm_email' => $strGetMicrosoftEmail,
			           'login_type' => 'mauth',

			       ])
			   	);
			}

			logEvent('Stored data in redis.');

			header('Location: '. DIR .'home.php');	
		}
	}
} else {
	logEvent('Invalid Token').PHP_EOL;
	header('Location: '. DIR .'home.php');	
}
