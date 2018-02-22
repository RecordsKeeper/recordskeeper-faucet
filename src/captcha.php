<?php

$post = [
   'secret' => '6LfcOEcUAAAAABldSkevRJL75VSrvheVbc_4z9wU',
   'response' => $_POST['googleResponse'],
   
];
$ch = curl_init();

echo 

curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
$response = curl_exec($ch);
var_export ($response);
// echo $response;
?>