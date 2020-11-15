<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab9</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <script src="https://kit.fontawesome.com/dbe3f5b73b.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <link href="https://fonts.googleapis.com/css?family=Merienda&display=swap" rel="stylesheet">
    <link href="./gradebook.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<?php 
    $oneResult = "";
	$twoResult = "";
	$fiveResult = "";
    $sixResult = "";
    
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
                if (isset($_POST['street'])) {
                    $query = "ALTER TABLE `students` ADD `street` VARCHAR(255) NOT NULL AFTER `phone`,";
                    $result = $db->query($query);
                    if($result == 1){
						$oneResult += 'success, add a street column\n';
					}
					else{
						$oneResult += "street column could not be added\n";
					}
                }
                if (isset($_POST['city'])) {
                    $query = "ALTER TABLE `students` ADD `city` VARCHAR(255) NOT NULL AFTER `street`";
                    $result = $db->query($query);
                    if($result == 1){
						$oneResult += 'success, add a city column\n';
					}
					else{
						$oneResult += "city column could not be added\n";
					}
                }
                if (isset($_POST['state'])) {
                    $query = "ALTER TABLE `students` ADD `state` VARCHAR(255) NOT NULL AFTER `city`";
                    $result = $db->query($query);
                    if($result == 1){
						$oneResult += 'success, add a state column\n';
					}
					else{
						$oneResult += "state column could not be added\n";
					}
                }
                if (isset($_POST['zip'])) {
                    $query = "ALTER TABLE `students` ADD `zip` INT(5) NOT NULL AFTER `state`";
                    $result = $db->query($query);
                    if($result == 1){
						$oneResult += 'success, add a zip column\n';
					}
					else{
						$oneResult += "zip column could not be added\n";
					}
                }
				break;
			case 2:
                if (isset($_POST['section'])) {
                    $query = "ALTER TABLE `courses` ADD `section` INT( 2 ) after `title`";
                    $result = $db->query($query);
                    if($result == 1){
						$twoResult += 'success, add a section column\n';
					}
					else{
						$twoResult += "section column could not be added\n";
					}
                }
                if (isset($_POST['year'])) {
                    $query = "ALTER TABLE `courses` ADD `year` INT( 10 ) after `section`";
                    $result = $db->query($query);
                    if($result == 1){
						$twoResult += 'success, add a year column\n';
					}
					else{
						$twoResult += "year column could not be added\n";
					}
                }
				break;
             case 3:
             echo "case 3";
             if (isset($_POST['createTable']))    {  
                $query = "CREATE TABLE grades (
                id INT(3) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                crn INT(5),
                RIN INT(7),
                FOREIGN KEY (crn, RIN) REFERENCES grades(id),
                grade INT(3) NOT NULL
                )";
                $result = $db->query($query);
                if ($result == 1) {
                 $oneResult += "success, create a grades table\n";
             }
             else{
                $oneResult += "fail, can not create the table\n"
            }       
        } 
        break;
            case 4:
                echo "case 4";
                // checks if the input was valid
                if(empty($_POST["crn"]) || !ctype_digit($_POST["crn"])){
                    $errorText = "A valid crn is required";
                }
                else if(empty($_POST["prefix"])){
                    $errorText = "A valid prefix is required";
                }
                else if(empty($_POST["number"])|| !ctype_digit($_POST["number"])){
                    $errorText = "A valid number is required";
                }
                else if(empty($_POST["title"])){
                    $errorText = "A valid title is required";
                }
                if($errorText == ""){
                    //creates and executes the query
                    $query = 'insert into `courses` (`crn`, `prefix`, `number`, `title`) values ('.$_POST["crn"].', "'.$_POST["prefix"].'", "'.$_POST["number"].'", "'.$_POST["title"].')';
                    $result = $db->query($query);
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

    <div class = "container">
    
    <h3>Update & Display the Database</h3>
    <form id="addform" name="addform" method="post"></form>
    <fieldset>
        <div class="formData">
            <label class="field" for="addField">Add address fields to the students table</label>
            <input type="submit" name="street" value="Street">
            <input type="submit" name="city" value="City">
            <input type="submit" name="state" value="State">
            <input type="submit" name="zip" value="Zip Code">
        </div>
        <br>
        <div class="formData">
            <label class="field" for="addField">Add section and year to the course table</label>
            <input type="submit" name="section" value="section">
            <input type="submit" name="year" value="year">
        </div>
    </fieldset>

    <div id="oneResult"><?php echo $oneResult ?> </div>
    <div id="twoResult"><?php echo $twoResult ?> </div>

    <!-- Yuhao case 3 & 4 -->

    <form method="post">
        <div><input type="submit" name="createTable" value="createTable" /></div>
    </form>
    <form>
        <label for="crn">crn:</label>
        <input type="text" class="crn" name="crn"><br>
        <label for="">prefix:</label>
        <input type="text" class="prefix" name="prefix"><br>
        <label for="">number:</label>
        <input type="text" class="number" name="number"><br>
        <label for="">title:</label>
        <input type="text" class="title" name="title"><br>
        <input type="submit">
    </form>


    <!-- Case 5 & 6 -->
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
    </div>

    <div class="container">
    <ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link getAvgStudents" href="#">Get Average of All Students</a>
    </li>
    <li class="nav-item">
        <a class="nav-link getListStudents" href="#">List # Students per Course</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
    </li>
    <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
    </li>
    </ul>
    <div id="results"></div>
    </div>


    <script src="./gradebook.js"></script>
</body>
</html>