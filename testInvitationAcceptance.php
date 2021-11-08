<?php

$url = "https://a7a7703f-c03b-4667-958f-0d21e117ae57.webhook.eus.azure-automation.net/webhooks?token=L2B6S0NyD%2blhBTldnKYlYtIBz5omhMU6OomnJMVp1TU%3d";


$data = array("emailid" => "yuvraj.rathod@ironrim.com");                                                                    
$data_string = json_encode($data);                                                                                   

echo "SSS: " . $data_string;

die();
                                                                                                            
$ch = curl_init$url);                                                                      
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
    'Content-Type: application/json',                                                                                
    'message: 362059tydsagh')                                                                       
);                                                                                                                   
                                                                                                                     
$result = curl_exec($ch);

echo "SSS: " . $result;

die();


// $curl = curl_init($url);
// curl_setopt($curl, CURLOPT_URL, $url);
// curl_setopt($curl, CURLOPT_POST, true);
// curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

// $headers = array(
//    "Accept: application/json",
//    "Authorization: message="362059tydsagh"",
//    "Content-Type: application/json",
// );

// echo " headres : " . $headers;

// curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);


// $data = <<<DATA
// {
//   "emailid": "shankaran.sitarama@ironrim.com"
// }
// DATA;

// curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

// //for debug only!
// curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
// curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

// $resp = curl_exec($curl);
// $err = curl_error($curl);

// curl_close($curl);
// var_dump($resp);

?>

