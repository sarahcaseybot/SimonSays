<?php
$method = $_SERVER['REQUEST_METHOD'];
// Process only when method is POST
if($method == "POST"){
	$requestBody = file_get_contents('php://input');
	$json = json_decode($requestBody);
	
	$text = $json->result->parameters->text;
	
	$commandNum = rand(2,9);
	
	$array = array("touch your toes", "pat your head", "rub your tummy", "twirl around", "blink your eyes", "hop on one foot", "touch your nose", "clap your hands", "raise your hands to the sky", "put your hands on your hips", "touch your shoulders", "give yourself a hug", "make a funny face", "stand on one foot", "cover your eyes", "jump in the air", "do a jumping jack", "clap your hands", "Do a dab", "touch your ears");
	$fruitArray = array("apple", "banana", "strawberry", "blueberry", "orange", "pineapple", "grapefruit", "lemon");
	$displayTextArray = array("Listen closely. ");
	$speechTextArray= array("<speak> Listen closely ");
	
	for($x = 0; $x < $commandNum; $x++){
		$randomIndex = rand(0, 19);
		array_push($displayTextArray, "Google Says... ", $array[$randomIndex], ", ");
		array_push($speechTextArray, "<break time=\"1s\"/>  Google Says...", $array[$randomIndex], "."); 
	}
	
	switch ($text){
		case 'hi':
			$randomIndex = rand(0, 5);
			$randomCommandIndex = rand(0, 19);
			array_push($displayTextArray, " ", $array[$randomCommandIndex], ". ");
			array_push($displayTextArray, "Oh no!.. did you ", $array[$randomCommandIndex], "? If you did, you're out. ");
			array_push($displayTextArray, "Do you want to keep playing? If you do, say ", $fruitArray[$randomIndex], ". To end the game, say stop.");
			
			$concatString = "<break time=\"2s\"/> Oh no! <break time=\"1s\"/> did you ..." . $array[$randomCommandIndex];
			$concatString .= "? If you did, <break time=\"1s\"/> you're out.";
			$concatString2 = "If you do, say" . $fruitArray[$randomIndex];
			array_push($speechTextArray, " <break time=\"2s\"/> ", $array[$randomCommandIndex], ". ");
			array_push($speechTextArray, $concatString );
			array_push($speechTextArray, "<break time=\"1s\"/> Do you want to keep playing?", $concatString2, "<break time=\"1s\"/> To end the game, say stop. </speak>");
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
