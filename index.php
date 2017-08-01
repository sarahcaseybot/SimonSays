<?php
$method = $_SERVER['REQUEST_METHOD'];
// Process only when method is POST
if($method == "POST"){
	$requestBody = file_get_contents('php://input');
	$json = json_decode($requestBody);
	
	$text = $json->result->parameters->text;
	
	$commandNum = rand(2,5);
	
	$array = array("Touch your toes!", "Pat your head!", "Rub your tummy!", "Twirl around!", "Blink your eyes!", "Hop on one foot!", "Touch your nose!", "Clap your hands!", "Raise your hands to the sky!", "Put your hands on your hips!", "Touch your shoulders!", "Give yourself a hug", "Make a funny face!", "Stand on one foot!", "Cover your eyes!", "Jump in the air!", "Do a jumping jack!", "Clap your hands!", "Snap your fingers!", "Touch your ears!");
	$fruitArray = array("apple", "banana", "strawberry", "blueberry", "orange", "pineapple", "grapefruit", "lemon");
	$displayTextArray = array("Listen closely. ");
	$speechTextArray= array("<speak> Listen closely ");
	
	for($x = 0; $x < $commandNum; $x++){
		$randomIndex = rand(0, 19);
		array_push($displayTextArray, "Google Says... ", $array[$randomIndex], ", ");
		array_push($speechTextArray, "<break time=\"3s\"/>  Google Says...", $array[$randomIndex]); 
	}
	
	switch ($text){
		case 'hi':
			$randomIndex = rand(0, 5);
			$randomCommandIndex = rand(0, 19);
			array_push($displayTextArray, " ", $array[$randomCommandIndex], ". ");
			array_push($displayTextArray, "Oh, no!.. did you ", $array[$randomCommandIndex], "? If you did, you're out. ");
			array_push($displayTextArray, "Do you want to keep playing? If you do, say ", $fruitArray[$randomIndex], ". To end the game, say stop.");
			
			$concatString = "<break time=\"2s\"/> Oh, no! <break time=\"1s\"/> did you ..." . $array[$randomCommandIndex];
			$concatString .= "? If you did, <break time=\"1s\"/> you're out.";
			array_push($speechTextArray, " <break time=\"2s\"/> ", $array[$randomCommandIndex], ". ");
			array_push($speechTextArray, $concatString );
			array_push($speechTextArray, "<break time=\"2s\"/> Do you want to keep playing? If you do, say ", $fruitArray[$randomIndex], "<break time=\"2s\"/> To end the game, say stop. </speak>");
			$displayText = implode("", $displayTextArray);
			$speech = implode("<break time=\"1s\"/>", $speechTextArray);
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
