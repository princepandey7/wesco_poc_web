<?php
	ob_start();
	session_start();
	require_once 'web_admin/db.php';
	$connection->logout();
	header("location:login.php");
?>