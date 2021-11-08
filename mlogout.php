<?php

// use Beta\Microsoft\Graph\Model\User;
// use myPHPnotes\Microsoft\Auth;
use myPHPnotes\Microsoft\Handlers\Session;
// use myPHPnotes\Microsoft\Models\User;

session_start();
require "vendor/autoload.php";

// $auth = new Auth(Session::get("tenant_id"),Session::get("client_id"),  Session::get("client_secret"), Session::get("redirect_uri"), Session::get("scopes"));

$strLogoutUrl = 'https://login.microsoftonline.com/' . Session::get("tenant_id") . "/oauth2/v2.0/logout?post_logout_redirect_uri=http://localhost:81/microsoftlogin/index.php";

session_destroy();
unset($_SESSION);
// $tokens = $auth->revokeToken($_SESSION['token']);
header('Location: '. $strLogoutUrl);