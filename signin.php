<?php
	
	// ini_set('session.save_handler', 'redis');
    // ini_set('session.name', 'session');
    ini_set('session.cookie_domain', '.alidevops.tech');
    // ini_set('session.save_path', '/mnt/user-session-data');
    // ini_set('session.save_path', 'tcp://wesco-sso-poc.redis.cache.windows.net:6379?auth=U3N4FNOJd9TNwHPpdaP41ELa3q8NB0pPlPyqVtJ5X3k=');
    
session_start();

// echo session_save_path();
// die;

require "vendor/autoload.php";
require_once("web_admin/db.php");
include("web_admin/functions.php");

logEvent('Redirect to microsoft page to login.');

use myPHPnotes\Microsoft\Auth;

$tenant = "7c10e4ef-1eb3-403a-9af7-c0aae38648ef";
$client_id = 'f6a1dca4-5b3b-4fd5-b36e-dc8639c84e22';
$client_secret='zsaf~Ub_Sg~gW-.S.s5NxP3H5Qw0M4JM9R';


//$tenant = "7c10e4ef-1eb3-403a-9af7-c0aae38648ef";
//$client_id = '9218fae8-6c1a-4eff-8c7c-3b02f8bd17f1';
//$client_secret='-bIuZb1sdvgsC74-pub2o_.9qLLkS68ks-';

// $tenant = "09a4816c-eb2a-4bf6-a398-90062f363b6c";
// $client_id = '35cbf79f-9bc5-48a5-861a-1c8f5360510c';
// $client_secret='Io.p~e_6-R~guisiO8Cl0Z-.tEt22CXvf1'; 

$callback = DIR .'callback.php';
$scopes=["User.Read"];

$microsoft = new Auth($tenant,$client_id, $client_secret, $callback, $scopes);

logEvent('Url :'. $microsoft->getAuthUrl());

header("location: ". $microsoft->getAuthUrl());
?>