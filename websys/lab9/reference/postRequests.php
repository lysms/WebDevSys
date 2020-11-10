<!-- 
// How to use:

var cardFront = "This is the front of the card";
var cardBack = "This is the back of the card";

let cardInfo = new FormData();
cardInfo.append("request", "{\"front\":\""+cardFront+"\",\"back\":\""+cardBack+"\"}");

let cardAdd = new XMLHttpRequest();
cardAdd.open("post", "addCard.php", true);
cardAdd.send(cardInfo);
 -->

<?php

$dbOk = false;
@ $db = new mysqli('localhost', 'root', '', 'websyslab9');
if($db->connect_error){
	echo json_encode("error");
} 
else{
	$dbOk = true; 
}

if($dbOk){
	$request = json_decode("$_POST[request]", true);

	$requestType = $request['requestID'];
	switch($requestType) { 
		case 1:
			echo "case 1";
			break;
		case 2:
			echo "case 2"
			break;
		case 3:
			echo "case 3"
			break;
		case 4:
			echo "case 4"
			break;
		case 5:
			echo "case 5"
			break;
		case 6:
			echo "case 6";
			break;
		default:
			break;
		}
	// creates and executes the update query
	//$query = 'insert into flashcards (`duedate`, `interval`, `easefactor`, `front`, `back`) values ("'. $today->format('Y-m-d H:i:s') . '", 0, 250, "' . $card['front'] . '", "'. $card['back'] .'")';
	
	//executes the query
	//$db->query($query);
}
?>

