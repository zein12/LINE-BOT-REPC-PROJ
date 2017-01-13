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
			$text_ex = "กล้วย";
			// Build message to reply back
			$messages = [
				'type' => 'text',
				'text' => $text
			];
			//$jsonObj = json_decode($content);
			//$textja = $jsonObj->{"result"}[0]->{"content"}->{"text"};
			if($event['message']['text'] == 'จัดไป'){
				$messages = [
				'type' => 'text',
				'text' => 'เดี๋ยวจัดให้'
			];	
				$ch1 = curl_init(); 
				curl_setopt($ch1, CURLOPT_SSL_VERIFYPEER, false); 
				curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true); 
				curl_setopt($ch1, CURLOPT_URL, 'https://th.wikipedia.org/w/api.php?format=json&action=query&prop=extracts&exintro=&explaintext=&titles='.$text_ex); 
				$result1 = curl_exec($ch1); 
				curl_close($ch1); 
				$obj = json_decode($result1, true); 
				
				foreach($obj['query']['pages'] as $key => $val){ 
					$result_text = $val['extract']; 
				}
				if(empty($result_text)){//หาจาก en ไม่พบก็บอกว่า ไม่พบข้อมูล ตอบกลับไป 
					$result_text = 'ไม่พบข้อมูล'; 
				} 
					$response_format_text = ['contentType'=>1,"toType"=>1,"text"=>$result_text];
				
				$post_data = $response_format_text; //ส่งข้อมูลไป 
				$url = 'https://api.line.me/v2/bot/message/reply';
				$ch = curl_init($url);
				$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);
				
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST'); 
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
				curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data)); 
				curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
				
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
