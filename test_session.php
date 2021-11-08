<?php
	echo 'Before Session Path: ' . session_save_path().'<br/>';
	// ob_start();
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	// 13.90.206.161
    // $some_name = session_name("PHPSESSID");
    // session_set_cookie_params(0, '/', '.alidevops.tech');
    ini_set('session.cookie_domain', '.alidevops.tech');
    ///var/lib/php/session
	ini_set('session.save_path', '/mnt/user-session-data');
	session_start();

	if ( !is_writable(session_save_path()) ) {
	   echo '<br>Session save path "'.session_save_path().'" is NOT writable!'; 
	}
	else{
	    echo '<br>Session save path "'.session_save_path().'" is writable!';
	}

	// $_SESSION['username'] = 'Kuldeep Pandey';
 //    $_SESSION['email'] = 'kuldeep.pandey@xoriant.com';
    // ini_set('session.gc_probability', 1);

    echo '<pre>';print_r($_SESSION);

    echo session_id() .' ||==>>>>>>|| After Session Path: '.session_save_path();die;
    // print_r(phpinfo());die;