<?php
$access_token = 'HpLOpVyrFwl3Dxb8nSD2iaXdKNJWcThMXb1nC7k1f6Ka/PlEj/K9VHHJch4j8UN5+K7KU+YHLB6yVk27fM00JtycqpXEkPnRoJnUnOB91brS+WF9CTfrPKV11VNQmJrjGmKsVpSMpb1jiFDcap9dmwdB04t89/1O/w1cDnyilFU=';

$url = '	https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer '. $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;
