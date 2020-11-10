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
	$card = json_decode("$_POST[request]", true);
	$today = new DateTime('now');

	// creates and executes the update query
	$query = 'insert into flashcards (`duedate`, `interval`, `easefactor`, `front`, `back`) values ("'. $today->format('Y-m-d H:i:s') . '", 0, 250, "' . $card['front'] . '", "'. $card['back'] .'")';

	$db->query($query);
}
?>

