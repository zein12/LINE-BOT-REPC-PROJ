<?php
$access_token = 'ziHTzV/2zzN+9EA0rEWnzfSBmoteGy4awfNS3TR3aJwttGI7gEfrbSJN1rWvcCpf+K7KU+YHLB6yVk27fM00JtycqpXEkPnRoJnUnOB91bqX3p9+U2mCdRHPP2Cd0ehAhkN4lL9tzrk4fhG31pC9ygdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
				// Get text sent
				$text = $event['message']['text'];
				// Get replyToken
				$replyToken = $event['replyToken'];
			
				// Build message to reply back
				$messages = [
					'type' => 'text',
					//'text' => $text
					'text' => 'ทดลองอยู่'
				];
			$jsonObj = json_decode($text);
			$textja = $jsonObj->{"result"}[0]->{"content"}->{"text"};
			$text_ex = explode(':', $textja);
			
			if($text_ex[0] == 'แชร์ดิ')
			{
				$ch1 = curl_init(); 
				curl_setopt($ch1, CURLOPT_SSL_VERIFYPEER, false); 
				curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true); 
				curl_setopt($ch1, CURLOPT_URL, 'https://th.wikipedia.org/w/api.php?format=json&action=query&prop=extracts&exintro=&explaintext=&titles='.$text_ex[1]); 
				
				$result = curl_exec($ch1); curl_close($ch1); 
				
				foreach($obj['query']['pages'] as $key => $val){ 
					$result_text = $val['extract']; 
				}
				
				$post_data = ["to"=>[$to],"toChannel"=>"1383378250","eventType"=>"138311608800106203","content"=>$response_format_text]; //ส่งข้อมูลไป 
				$ch = curl_init("https://trialbot-api.line.me/v1/events"); 
				curl_setopt($ch, CURLOPT_POST, true); 
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST'); 
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
				curl_setopt($ch, CURLOPT_POSTFIELDS, 
				json_encode($post_data)); 
				curl_setopt($ch, CURLOPT_HTTPHEADER, array( 
					'Content-Type: application/json; charser=UTF-8', 
					'X-Line-ChannelID: YOUR ChannelID', 
					'X-Line-ChannelSecret: YOUR ChannelSecret', 
					'X-Line-Trusted-User-With-ACL: YOUR MID' )); 
				$result = curl_exec($ch); 
				curl_close($ch); 
			}

				// Make a POST Request to Messaging API to reply to sender
				$url = 'https://api.line.me/v2/bot/message/reply';
				$data = [
					'replyToken' => $replyToken,
					'messages' => [$messages],
				];
				$post = json_encode($data);
				$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

				$ch = curl_init($url);
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
				curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
				$result = curl_exec($ch);
				curl_close($ch);

				echo $result . "\r\n";
		}
	}
}
echo "OK";
