<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php 
	$fiveResult = "";
	$sixResult = "";
	//echo ;
	$dbOk = false;
	@ $db = new mysqli('localhost', 'root', '', 'websyslab9');
	if($db->connect_error){
		echo "Couldn't connect to database";
	} 
	else{
		$dbOk = true; 
	}

	if($dbOk && $_SERVER['REQUEST_METHOD'] === 'POST'){
		$errorText = "";
		$requestType = $_POST["requestType"];
		switch($requestType) { 
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
				// checks if the input was valid
				if(empty($_POST["rin"]) || !ctype_digit($_POST["rin"])){
					$errorText = "A valid RIN is required";
				}
				else if(empty($_POST["rcsid"]) || !ctype_alnum($_POST["rcsid"])){
					$errorText = "A valid RCSID is required";
				}
				else if(empty($_POST["fname"]) || !ctype_alpha($_POST["fname"])){
					$errorText = "A valid First Name is required";
				}
				else if(empty($_POST["lname"]) || !ctype_alpha($_POST["lname"])){
					$errorText = "A valid Last Name is required";
				}
				else if(empty($_POST["alias"]) || !ctype_alpha($_POST["alias"])){
					$errorText = "A valid Alias is required";
				}
				else if(empty($_POST["phone"]) || !ctype_digit($_POST["phone"])){
					$errorText = "A valid Phone is required";
				}
				else if(empty($_POST["street"])){
					$errorText = "A valid Street is required";
				}
				else if(empty($_POST["city"])){
					$errorText = "A valid City is required";
				}
				else if(empty($_POST["state"])){
					$errorText = "A valid State is required";
				}
				else if(empty($_POST["zip"]) || !ctype_digit($_POST["zip"])){
					$errorText = "A valid Zip is required";
				}

				// checks if the query can be executed
				if($errorText == ""){
					//creates and executes the query
					$query = 'insert into `students` (`RIN`, `RCSID`, `first name`, `last name`, `alias`, `phone`, `street`, `city`, `state`, `zip`) values ('.$_POST["rin"].', "'.$_POST["rcsid"].'", "'.$_POST["fname"].'", "'.$_POST["lname"].'", "'.$_POST["alias"].'", '.$_POST["phone"].', "'.$_POST["street"].'", "'.$_POST["city"].'", "'.$_POST["state"].'", '.$_POST["zip"].')';
					$result = $db->query($query);

					// informs the user
					if($result == 1){
						$fiveResult = 'success, ('.$_POST["rin"].', "'.$_POST["rcsid"].'", "'.$_POST["fname"].'", "'.$_POST["lname"].'", "'.$_POST["alias"].'", '.$_POST["phone"].', "'.$_POST["street"].'", "'.$_POST["city"].'", "'.$_POST["state"].'", '.$_POST["zip"].') was added to students';
					}
					else{
						$fiveResult = "Invalid data";
					}
					
				}
				else{
					$fiveResult = $errorText;
				}
				break;
			case 6:
				// checks if the input was valid
				if(empty($_POST["id"]) || !ctype_digit($_POST["id"])){
					$errorText = "A valid ID is required";
				}
				else if(empty($_POST["crn"]) || !ctype_digit($_POST["crn"])){
					$errorText = "A valid CRN is required";
				}
				else if(empty($_POST["rin"]) || !ctype_digit($_POST["rin"])){
					$errorText = "A valid RIN is required";
				}
				else if(empty($_POST["grade"]) || !ctype_digit($_POST["grade"])){
					$errorText = "A valid Grade is required";
				}
				// checks if the query can be executed
				if($errorText == ""){
					//creates and executes the query
					$query = 'insert into `grades` (`id`, `crn`, `RIN`, `grade`) values ('.$_POST["id"].', '.$_POST["crn"].', '.$_POST["rin"].', '.$_POST["grade"].')';
					$result = $db->query($query);

					// informs the user of the result
					if($result == 1){
						$sixResult = 'success, ('.$_POST["id"].', '.$_POST["crn"].', '.$_POST["rin"].', '.$_POST["grade"].') was added to grades';
					}
					else{
						$sixResult = "Invalid data";
					}
				}
				else{
					$sixResult = $errorText;
				}
				break;
			default:
				break;
			}

	}
	 ?>

<form method="post">
	<input type="hidden" class="requestType" name="requestType" value=5>
	<label for="rin">RIN:</label>
	<input type="text" class="rin" name="rin"><br>
	<label for="">RCSID:</label>
	<input type="text" class="rcsid" name="rcsid"><br>
	<label for="">First Name:</label>
	<input type="text" class="fname" name="fname"><br>
	<label for="">Last Name:</label>
	<input type="text" class="lname" name="lname"><br>
	<label for="">Alias:</label>
	<input type="text" class="alias" name="alias"><br>
	<label for="">Phone:</label>
	<input type="text" class="phone" name="phone"><br>
	<label for="">Street:</label>
	<input type="text" class="street" name="street"><br>
	<label for="">City:</label>
	<input type="text" class="city" name="city"><br>
	<label for="">State:</label>
	<input type="text" class="state" name="state"><br>
	<label for="">Zip:</label>
	<input type="text" class="zip" name="zip"><br>
	<input type="submit">
</form>
<div id="fiveResult"><?php echo $fiveResult ?> </div>

<form method="post">
	<input type="hidden" class="requestType" name="requestType" value=6>
	<label for="">ID:</label>
	<input type="text" class="id" name="id"><br>
	<label for="">CRN:</label>
	<input type="text" class="crn" name="crn"><br>
	<label for="">RIN:</label>
	<input type="text" class="rin" name="rin"><br>
	<label for="">Grade:</label>
	<input type="text" class="grade" name="grade"><br>
	<input type="submit">
</form>
<div id="sixResult"><?php echo $sixResult ?> </div>
</body>
</html>