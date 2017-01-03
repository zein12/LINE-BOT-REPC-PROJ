<?php
$access_token = 'ziHTzV/2zzN+9EA0rEWnzfSBmoteGy4awfNS3TR3aJwttGI7gEfrbSJN1rWvcCpf+K7KU+YHLB6yVk27fM00JtycqpXEkPnRoJnUnOB91bqX3p9+U2mCdRHPP2Cd0ehAhkN4lL9tzrk4fhG31pC9ygdB04t89/1O/w1cDnyilFU=';

$url = '	https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer'. $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;
