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
	$displayTextArray = array("Listen closely.");
	$speechTextArray= array("listen closely");
	
	for($x = 0; $x < $commandNum; $x++){
		$randomIndex = rand(0, 5);
		array_push($displayTextArray, "Google Says...", $array[$randomIndex], ", ");
		array_push($speechTextArray, "... ... ... ... ... ... ... ... ... ... Google Says...", $array[$randomIndex]); 
	}
	
	switch ($text){
		case 'hi':
			$randomIndex = rand(0, 5);
			array_push($displayTextArray, "Uh Oh,... did you ", $array[$randomIndex], "? If you did, you're out.");
			array_push($displayTextArray, "Do you want to keep playing? If you do, say ", $fruitArray[$randomIndex], ". To end the game, say stop.");
			
			array_push($speechTextArray, "... ... ... ... ... ... ... ...", $array[$randomIndex]);
			array_push($speechTextArray, "... ... ... ... ... Uh Oh,... ... did you ...", $array[$randomIndex], "? ... ... If you did, ... ... you're out.");
			array_push($speechTextArray, "... ... ... ... ... ... Do you want to keep playing? If you do, say ", $fruitArray[$randomIndex], "... ... To end the game, say stop.");

			$displayText = implode("", $displayTextArray);
			$speech = implode("... ...", $speechTextArray);
			break;
			
		case 'anything':
			$speech = "Yes, you can type anything here.";
			$displayText = "Yes, you can type anything here.";
			break;
			
		default:
			$speech = "Sorry, I didn't get that. Please ask me something else.";
			$displayText = "Sorry, I didn't get that. Please ask me something else.";
			break;	
		}
	
	$response = new \stdClass();
	$response->speech = $speech;
	$response->displayText = $displayText;
	$response->source = "webhook";
	echo json_encode($response);
}
else{
	echo "Method not allowed";
}


?>