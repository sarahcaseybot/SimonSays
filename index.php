<?php

$method = $_SERVER['REQUEST_METHOD'];

// Process only when method is POST
if($method == "POST"){
	$requestBody = file_get_contents('php://input');
	$json = json_decode($requestBody);
	
	$text = $json->result->parameters->text;
	
	$commandNum = rand(2,5);
	
	$array = array("a", "b", "c", "d", "e", "f");
	$fruitArray = array("apple", "banana", "strawberry", "blueberry", "orange", "pineapple", "grapefruit", "lemon");
	$speechTextArray = array("<speak> Listen closely");
	
	for($x = 0; $x < $commandNum; $x++){
	$randomIndex = rand(0, 5);
		array_push($speechTextArray, "<break time=\"3s\"/> Google Says...", $array[$randomIndex]); 
	}
	
	switch ($text){
		case 'hi':
			$randomIndex = rand(0, 5);
			array_push($speechArray, "<break time=\"2s\"/> Uh Oh, <break time=\"1s\"/> did you ...", $array[$randomIndex], "? If you did, <break time=\"1s\"/> you're out.");
			array_push($speechArray, "<break time=\"2s\"/> Do you want to keep playing? If you do, say ", $fruitArray[$randomIndex], "<break time=\"2s\"/> To end the game, say stop. </speak>");
			
			$speech = implode("<break time=\"1s\"/>", $speechText);
			break;
			
		case 'anything':
			$speech = "Yes, you can type anything here.";
			break;
			
		default:
			$speech = "Sorry, I didn't get that. Please ask me something else.";
			break;	
		}
	
	$response = new \stdClass();
	$response->speech = $speech;
	$response->displayText = $speech;
	$response->source = "webhook";
	echo json_encode($response);
}
else{
	echo "Method not allowed";
}


?>