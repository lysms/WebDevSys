<?php  
$dbOk = false;
@ $db = new mysqli('localhost', 'root', '', 'lingoland');
if($db->connect_error){
	echo json_encode(array("reviewCount" => "0"));
} 
else{
	$dbOk = true; 
}

if($dbOk){
	$today = new DateTime('now');
	$query = 'select * from flashcards where duedate <= "' . $today->format('Y-m-d H:i:s') . '" order by duedate';
	$result = $db->query($query);
	$reviewCount = $result->num_rows;

	echo "{\"reviewCount\": \"" . $reviewCount;
	echo "\", \"cards\":[";
	for ($i=0; $i < $reviewCount; $i++) {
		$card = $result->fetch_assoc();
		echo json_encode($card);
		if($i != $reviewCount-1)
			echo ",";
	}
	echo "]}";
}
?>