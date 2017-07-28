<?php

$method = $_SERVER['REQUEST_METHOD'];

// Process only when method is POST
if($method == "POST"){
	$requestBody = file_get_contents('php://input');
	$json = json_decode($requestBody);
	
	$text = $json->result->parameters->text;
	
	$commandNum = rand(2,5);
	
	$array = array("a", "b", "c", "d", "e", "f");
	$responseArray = array("listen closely");
	
	for($x = 0; $x < $commandNum; $x++){
	$randomIndex = rand(0, 5);
		array_push($responseArray, "... ... ... ... ... ... ... ... ... ... Google Says...", $array[$randomIndex]); 
	}
	
	switch ($text){
		case 'hi':
			array_push($responseArray, "Did you lose?");
			$speech = implode("... ...", $responseArray);
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