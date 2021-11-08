<?php
// echo '<pre>';print_r($_SERVER);die;
    $url = trim(rawurldecode($_SERVER['REQUEST_URI']),'/');
    //echo '<pre>';print_r($url);die;
    // $getActiveUrl = explode('/', $url )[0];
    $getActiveUrl = '';
    if(!empty($url)){
        $strExplode = explode('/', $url );
        if(!empty($strExplode)){
            $getActiveUrl = isset($strExplode[1]) ? $strExplode[1] : '';
        }
    }
    //echo '<pre>';print_r($getActiveUrl);die;
    if(empty($url) || empty($getActiveUrl)){
        include('home.php');
    } else {
        if(preg_match('/'. $getActiveUrl .'/', $url)){
            include($getActiveUrl.'.php');
        }
    }
    
?>
