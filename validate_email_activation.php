<?php
    // ini_set('session.save_handler', 'redis');
    // ini_set('session.name', 'session');
    ini_set('session.cookie_domain', '.alidevops.tech');
    // ini_set('session.save_path', '/mnt/user-session-data');
    // ini_set('session.save_path', 'tcp://wesco-sso-poc.redis.cache.windows.net:6379?auth=U3N4FNOJd9TNwHPpdaP41ELa3q8NB0pPlPyqVtJ5X3k=');
    
    session_start();
    require_once("web_admin/db.php");
    
    require "vendor/autoload.php";

    // require_once '../simplesamlphp/lib/_autoload.php';
    // $as = new SimpleSAML_Auth_Simple('default-sp');
    // $as->requireAuth();

    $strSsoEmail = $_POST['emailid'];


    $guzzle = new \GuzzleHttp\Client();
    $url = 'https://a7a7703f-c03b-4667-958f-0d21e117ae57.webhook.eus.azure-automation.net/webhooks?token=L2B6S0NyD%2blhBTldnKYlYtIBz5omhMU6OomnJMVp1TU%3d';

    $arrResponce = json_decode($guzzle->post($url, [
        'headers' => [
            'content-type' => 'application/json',
            'Accept'     => 'application/json',
            'message' => "362059tydsagh"
        ],
        'json' => [
            'emailid' => $strSsoEmail,
        ]

    ])->getBody()->getContents());

    //print_r($arrResponce);
    // $strDecode = json_decode($arrResponce, true);
    $arrGetJobId = $arrResponce->JobIds;

    echo json_encode($arrGetJobId);
?>
