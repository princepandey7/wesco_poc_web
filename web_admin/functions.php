<?php

function logEvent($message) {

    if ($message != '') {
        // Add a timestamp to the start of the $message
        $message = date("Y/m/d H:i:s").': '.$message.PHP_EOL;
        file_put_contents("logs/log.txt",$message, FILE_APPEND);
        // "======================================".PHP_EOL;
        // file_put_contents('logs/'.date('d-m-Y').'.txt',$message, FILE_APPEND);

        // $fp = fopen('logs/log.txt', 'a');
        // //echo $message;die;
        // fwrite($fp, $message."\n");
        // fclose($fp);
    }
}

?>