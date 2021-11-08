<?php

// use myPHPnotes\Microsoft\Auth;
use myPHPnotes\Microsoft\Handlers\Session;
use App\TokenStore\TokenCache;
// use myPHPnotes\Microsoft\Models\User;
 // ini_set('session.save_handler', 'redis');
    // ini_set('session.name', 'session');
    ini_set('session.cookie_domain', '.alidevops.tech');
    // ini_set('session.save_path', '/mnt/user-session-data');
    // ini_set('session.save_path', 'tcp://wesco-sso-poc.redis.cache.windows.net:6379?auth=U3N4FNOJd9TNwHPpdaP41ELa3q8NB0pPlPyqVtJ5X3k=');

session_start();
require "vendor/autoload.php";
require_once("web_admin/db.php");
include("web_admin/functions.php");

$strRedirectUrl = DIR .'home.php';
if($_SESSION['sso_status'] == 'failed'){
	$strRedirectUrl = DIR .'login.php?sso_status=failed';
}

logEvent('Logout user.');

$strLogoutUrl = 'https://login.microsoftonline.com/' . Session::get("tenant_id") . "/oauth2/v2.0/logout?post_logout_redirect_uri=". $strRedirectUrl;

logEvent('Logout Url : '. $strLogoutUrl);

$strRedisKey = "PHPREDIS_SESSION:". session_id();
$redis = new Redis();
$redis->connect(REDIS_USERS, 6379);
$redis->auth(REDIS_AUTH);

$redis->delete($redis->keys($strRedisKey));

session_destroy();
unset($_SESSION);

logEvent('Clear session data.');

// $redis->flushAll();

// $tokens = $auth->revokeToken($_SESSION['token']);
header('Location: '. $strLogoutUrl);