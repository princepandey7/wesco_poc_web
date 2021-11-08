<?php
require_once '../simplesamlphp/lib/_autoload.php';
$as = new SimpleSAML_Auth_Simple('default-sp');
$as->requireAuth();

$attributes = $as->getAttributes();

echo '<pre>';
print_r($attributes);
echo '</pre>';


// foreach ($attributes as $key => $value) {
// 	echo '<pre>';print_r(array_values($value));
// }

// echo '<pre>';print_r($as->getAttributes('emailaddress'));

$url = $as->getLogoutURL();

// $_SESSION['saml_data'] =$attributes;
// $_SESSION['saml_logout_url'] = $url;

// header('Location: https://13.90.206.161/wesco_web_app/index.php');

echo '<a href="' . htmlspecialchars($url) . '">Logout</a>';

?>
