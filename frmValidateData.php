<?php
	// echo 'Before Session Path: ' . session_save_path().'<br/>';
	// die;
	// ini_set('session.save_handler', 'redis');
    // ini_set('session.name', 'session');
    ini_set('session.cookie_domain', '.alidevops.tech');
    // ini_set('session.save_path', '/mnt/user-session-data');
    // ini_set('session.save_path', 'tcp://wesco-sso-poc.redis.cache.windows.net:6379?auth=U3N4FNOJd9TNwHPpdaP41ELa3q8NB0pPlPyqVtJ5X3k=');
    
	session_start();
	require "vendor/autoload.php";
	require_once("web_admin/db.php");
	include("web_admin/functions.php");
	

	// require_once '../simplesamlphp/lib/_autoload.php';
	// $as = new SimpleSAML_Auth_Simple('default-sp');
	// $as->requireAuth();

	$strSsoEmail = $_POST['sso_email'];	

	logEvent('User try to login via email id :'. $strSsoEmail);

	$_SESSION['validate_sso_email'] = $strSsoEmail;
	$strExplode = end(explode('@', $strSsoEmail));
	$strGetClient = current(explode('.', $strExplode));
	
	$returnUrl['status'] = 'success';

	logEvent('Checking user in internal or external users.');

	if(strtolower($strGetClient) == INTERNAL_USERS ){
		logEvent('User is Internal user.');

		$returnUrl =  DIR.'signin.php';
	} else {
		$clientId = "f6a1dca4-5b3b-4fd5-b36e-dc8639c84e22";
		$clientSecret ="zsaf~Ub_Sg~gW-.S.s5NxP3H5Qw0M4JM9R";

		$tenantId = '7c10e4ef-1eb3-403a-9af7-c0aae38648ef';
		$guzzle = new \GuzzleHttp\Client();
		$url = 'https://login.microsoftonline.com/' . $tenantId . '/oauth2/v2.0/token';
		$token = json_decode($guzzle->post($url, [
		    'form_params' => [
		        'client_id' => $clientId,
		        'client_secret' => $clientSecret,
		        'scope' => 'https://graph.microsoft.com/.default',
		        'grant_type' => 'client_credentials',
		    ],
		])->getBody()->getContents());

		$accessToken = $token->access_token;

		// prashant.chawla@ironrim.com(P@ssword12), shankaran.sitarama@ironrim.com

		$filter = '$filter';
		$url = "https://graph.microsoft.com/v1.0/users/?$filter=mail eq '{$strSsoEmail}' and externalUserState eq 'PendingAcceptance'";
		$data = json_decode($guzzle->request('GET',$url, 
			// ['debug'   => true],
		   ['headers' => 
		        [
		            'Authorization' => "Bearer {$accessToken}"
		        ]
		    
			])->getBody()->getContents());

		// print_r($data->value);die;

		if(empty($data->value)){
			$returnUrl = DIR.'signin.php';
		} else{
			$returnUrl = DIR.'identity_validation.php?id='.base64_encode($strSsoEmail);
		}
	}

	echo $returnUrl;
?>