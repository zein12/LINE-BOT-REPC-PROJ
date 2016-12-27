<?php
$access_token = 'sqYdmIKK/35tvT/r+6l8npx4rv4FQAvdaXY8/biG7Kb7tmPn3jKfWRnNQvvDJe72+K7KU+YHLB6yVk27fM00JtycqpXEkPnRoJnUnOB91boOSx8R+sf1GoKyS2A4fuJ6nLwAhnuHndle0weoek4McQdB04t89/1O/w1cDnyilFU=';

$url = 'http://immense-chamber-72779.herokuapp.com/verify.php';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;
