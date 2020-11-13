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
@$db = new mysqli('localhost', 'root', '', 'websyslab9');
if ($db->connect_error) {
	echo json_encode("error");
} else {
	$dbOk = true;
}

if ($dbOk) {
	$request = json_decode("$_POST[request]", true);

	$requestType = $request['requestID'];
	switch ($requestType) {
		case 1:
			echo "case 1";
			break;
		case 2:
			echo "case 2";
			break;
		case 3:
			echo "case 3";
			break;
		case 4:
			echo "case 4";
			break;
		case 5:
			echo "case 5";
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

	if (isset($_POST['tsreet'])) {
		$query = "ALTER TABLE students ADD Street VARCHAR( 255 ) after phone";
		$db->query($query);
	}
	if (isset($_POST['city'])) {
		$query = "ALTER TABLE students ADD City VARCHAR( 255 ) after street";
		$db->query($query);
	}
	if (isset($_POST['state'])) {
		$query = "ALTER TABLE students ADD State VARCHAR( 255 ) after city";
		$db->query($query);
	}
	if (isset($_POST['zip'])) {
		$query = "ALTER TABLE students ADD Zip INT( 5 ) after state";
		$db->query($query);
	}

	if (isset($_POST['section'])) {
		$query = "ALTER TABLE courses ADD section INT( 2 ) after title";
		$db->query($query);
	}

	if (isset($_POST['year'])) {
		$query = "ALTER TABLE courses ADD year INT( 10 ) after section";
		$db->query($query);
	}
}
?>

<h3>Update & Display the Database</h3>
<form id="addform" name="addform" action="postRequests.php"></form>
<fieldset>
    <div class="formData">
        <label class="field" for="addField">Add address fields to the students table</label>
        <input type="submit" name="street" value="Street">
        <input type="submit" name="city" value="City">
        <input type="submit" name=state" value="State">
        <input type="submit" name="zip" value="Zip Code">
    </div>
    <br>
    <div class="formData">
        <label class="field" for="addField">Add section and year to the course table</label>
        <input type="submit" name="section" value="section">
        <input type="submit" name="year" value="year">
    </div>
</fieldset>