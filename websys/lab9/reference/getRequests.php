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
	$request = json_decode("$_GET[request]", true);

	$requestType = $request['requestID'];
	switch($requestType) {
        case 7:	
			echo "case 7"; 
			break;
		case 8:	
			echo "case 8";
			break;
		case 9:	
			echo "case 9";
			break;
		case 10:
			echo "case 10";	
            break;
        default:
            echo "error"
            break;
		}
	// creates and executes the update query
	//$query = 'insert into flashcards (`duedate`, `interval`, `easefactor`, `front`, `back`) values ("'. $today->format('Y-m-d H:i:s') . '", 0, 250, "' . $card['front'] . '", "'. $card['back'] .'")';
	
	//executes the query
	//$db->query($query);
}
?>

