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
	$requestType = $_GET['requestId'];
	switch($requestType) {
		case 7:	
			$sql = "SELECT * FROM `students` ORDER BY `RIN`, `last name`, `RCSID`, `first name`;";
			break;
		case 8:	
			$sql = "SELECT 
			s.RIN, 
			CONCAT(s.`first name`,' ', s.`last name`) as name, 
			CONCAT(s.street, ', ', s.city, ', ', s.state, ', ', s.zip) as address
		FROM 
			`grades` g
			INNER JOIN `students` s
			ON g.RIN = s.RIN 
		WHERE 
			grade > 90;";
			break;
		case 9:	
			$sql = "SELECT 
						c.crn,
						AVG(g.grade) as avg_grade 
					FROM 
						`grades` g 
						INNER JOIN `courses` c
						ON g.crn = c.crn
					GROUP BY
						c.crn; ";
			break;
		case 10:
			$sql = "SELECT
						g.crn,
						COUNT(*) as num_students 
					FROM 
						`grades` g
						INNER JOIN `students` s
						ON g.RIN = s.RIN 
					GROUP BY
						g.crn;";
            break;
        default:
            echo "error";
            break;
		}
		$result = $db->query($sql);
			if($result->num_rows > 0){
				$resultArray = array();
				while($row = $result->fetch_array(MYSQLI_ASSOC)) {
					$resultArray[] = $row;
				}
				$resultJSON = json_encode($resultArray);
				echo $resultJSON;

			} else {
				echo "{}";
			}
	// creates and executes the update query
	//$query = 'insert into flashcards (`duedate`, `interval`, `easefactor`, `front`, `back`) values ("'. $today->format('Y-m-d H:i:s') . '", 0, 250, "' . $card['front'] . '", "'. $card['back'] .'")';
	
	//executes the query
	//$db->query($query);
}
?>