<?php

require_once '../simplesamlphp/lib/_autoload.php';
$as = new SimpleSAML_Auth_Simple('default-sp');

// $as->requireAuth();

// $attributes = $as->getAttributes();


// echo '<pre>';
// print_r($attributes);
// echo '</pre>';
// die;

// $strLogoutUrl = $as->getLogoutURL();

// session_destroy();
// unset($_SESSION);
$auth->logout([
    'ReturnTo' => 'https://sp.example.org/logged_out.php',
    'ReturnStateParam' => 'LogoutState',
    'ReturnStateStage' => 'MyLogoutState',
]);
SimpleSAML_Session::getSessionFromRequest()->cleanup();

header('Location: '. $_COOKIE['logout_url']);