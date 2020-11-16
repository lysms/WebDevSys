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
    $threeResult = "";
    $fourResult = "";
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
						$oneResult = 'Success, a street column was added\n';
					}
					else{
						$oneResult = "Error, a street column could not be added\n";
					}
                }
                if (isset($_POST['city'])) {
                    $query = "ALTER TABLE `students` ADD `city` VARCHAR(255) NOT NULL AFTER `street`";
                    $result = $db->query($query);
                    if($result == 1){
						$oneResult = 'Success, a city column was added\n';
					}
					else{
						$oneResult = "Error, a city column could not be added\n";
					}
                }
                if (isset($_POST['state'])) {
                    $query = "ALTER TABLE `students` ADD `state` VARCHAR(255) NOT NULL AFTER `city`";
                    $result = $db->query($query);
                    if($result == 1){
						$oneResult = 'Success, a state column was added\n';
					}
					else{
						$oneResult = "Error, a state column could not be added\n";
					}
                }
                if (isset($_POST['zip'])) {
                    $query = "ALTER TABLE `students` ADD `zip` INT(5) NOT NULL AFTER `state`";
                    $result = $db->query($query);
                    if($result == 1){
						$oneResult = 'Success, a zip column was added\n';
					}
					else{
						$oneResult = "Error, a zip column could not be added\n";
					}
                }
				break;
			case 2:
                if (isset($_POST['section'])) {
                    $query = "ALTER TABLE `courses` ADD `section` INT( 2 ) after `title`";
                    $result = $db->query($query);
                    if($result == 1){
						$twoResult = 'Success, a section column was added\n';
					}
					else{
						$twoResult = "Error, a section column could not be added\n";
					}
                }
                if (isset($_POST['year'])) {
                    $query = "ALTER TABLE `courses` ADD `year` INT( 10 ) after `section`";
                    $result = $db->query($query);
                    if($result == 1){
						$twoResult = 'Success, a year column was added\n';
					}
					else{
						$twoResult = "Error, a year column could not be added\n";
					}
                }
				break;
            case 3:
                if (isset($_POST['createTable'])){  
                    $query = "CREATE TABLE grades (
                    id INT(3) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    crn INT(5),
                    RIN INT(7),
                    FOREIGN KEY(crn) REFERENCES courses(crn),
                    FOREIGN KEY(RIN) REFERENCES students(RIN),
                    grade INT(3) NOT NULL
                    );";
                    $result = $db->query($query);
                    if ($result == 1) {
                        $threeResult = "Success, a grades table was created\n";
                    }
                    else{
                        $threeResult = "Invalid request, grades table already exists\n";
                    }    
                }   
                break;
            case 4:
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
                    $query = 'insert into `courses` (`crn`, `prefix`, `number`, `title`) values ('.$_POST["crn"].', "'.$_POST["prefix"].'", '.$_POST["number"].', "'.$_POST["title"].'")';
                    $result = $db->query($query);
                    // informs the user
					if($result == 1){
						$fourResult = 'Success, ('.$_POST["crn"].', "'.$_POST["prefix"].'", "'.$_POST["number"].'", "'.$_POST["title"].') was added to courses';
					}
					else{
                        $fourResult = "Invalid data";
					}
                }
                else{
                    $fourResult = $errorText;
				}
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
						$fiveResult = 'Success, ('.$_POST["rin"].', "'.$_POST["rcsid"].'", "'.$_POST["fname"].'", "'.$_POST["lname"].'", "'.$_POST["alias"].'", '.$_POST["phone"].', "'.$_POST["street"].'", "'.$_POST["city"].'", "'.$_POST["state"].'", '.$_POST["zip"].') was added to students';
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
						$sixResult = 'Success, ('.$_POST["id"].', '.$_POST["crn"].', '.$_POST["rin"].', '.$_POST["grade"].') was added to grades';
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
    <h3>Grade Book</h3>
    <div class="card" style="min-height: 500px;">
        <div class = "card-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="case-tab-1" data-toggle="tab" href="#case-1" role="tab" aria-controls="case-tab-1" aria-selected="true">Add Address Fields</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="case-tab-2" data-toggle="tab" href="#case-2" role="tab" aria-controls="case-tab-2" aria-selected="false">Add Section and Year</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="case-tab-4" data-toggle="tab" href="#case-3" role="tab" aria-controls="case-tab-3" aria-selected="false">Create Grades Table</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="case-tab-4" data-toggle="tab" href="#case-4" role="tab" aria-controls="case-tab-4" aria-selected="false">Insert Courses</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="case-tab-5" data-toggle="tab" href="#case-5" role="tab" aria-controls="case-tab-5" aria-selected="false">Insert Students</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="case-tab-6" data-toggle="tab" href="#case-6" role="tab" aria-controls="case-tab-6" aria-selected="false">Add Student's Grades</a>
            </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="case-1" role="tabpanel" aria-labelledby="case-tab-1">
                    <form id="case1" name="case1" method="post">
                        <input type="hidden" class="requestType" name="requestType" value=1>
                        <label class="field" for="addField">Add address fields to the students table</label>
                        <input type="submit" name="street" value="Street">
                        <input type="submit" name="city" value="City">
                        <input type="submit" name="state" value="State">
                        <input type="submit" name="zip" value="Zip Code">
                    </form>
                    <div id="oneResult"><?php echo $oneResult ?> </div>
                </div>
                <div class="tab-pane fade" id="case-2" role="tabpanel" aria-labelledby="case-tab-2">
                    <form id="case2" name="case2" method="post">
                        <input type="hidden" class="requestType" name="requestType" value=2>
                            <label class="field" for="addField">Add section and year to the course table</label>
                            <input type="submit" name="section" value="section">
                            <input type="submit" name="year" value="year">
                        </form>
                        <div id="twoResult"><?php echo $twoResult ?> </div>
                    </div>
                    <div class="tab-pane fade" id="case-3" role="tabpanel" aria-labelledby="case-tab-3">
                        <form id="case3" name="case3" method="post">
                                <input type="hidden" class="requestType" name="requestType" value=3>
                                <input type="submit" name="createTable" value="createTable"/>
                        </form>
                        <div id="threeResult"><?php echo $threeResult ?> </div>
                </div>
                <div class="tab-pane fade" id="case-4" role="tabpanel" aria-labelledby="case-tab-4">
                    <form id="case4" name="case4" method="post">
                    <input type="hidden" class="requestType" name="requestType" value=4>
                        <label for="crn">crn:</label>
                        <input type="text" class="crn" name="crn" required><br>
                        <label for="">prefix:</label>
                        <input type="text" class="prefix" name="prefix" required><br>
                        <label for="">number:</label>
                        <input type="text" class="number" name="number" required><br>
                        <label for="">title:</label>
                        <input type="text" class="title" name="title" required><br>
                        <input type="submit">
                    </form>
                    <div id="fourResult"><?php echo $fourResult ?> </div>
                </div>
                <div class="tab-pane fade" id="case-5" role="tabpanel" aria-labelledby="case-tab-5">
                    <form id="case5" name="case5" method="post">
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
                </div>
                <div class="tab-pane fade" id="case-6" role="tabpanel" aria-labelledby="case-tab-6">
                    <form id="case6" name="case6" method="post" >
                        <div class="form-group">
                            <h3>Submit Grade For Student</h3>
                            <input type="hidden" class="form-control requestType" name="requestType" value=6>
                            <label for="id">ID</label>
                            <input type="text" class="id form-control" name="id"><br>
                            <label for="crn">CRN</label>
                            <input type="text" class="crn form-control" name="crn"><br>
                            <label for="rin">RIN</label>
                            <input type="text" class="rin form-control" name="rin"><br>
                            <label for="grade">Grade</label>
                            <input type="text" class="grade form-control" name="grade"><br>
                            <input type="submit">
                        </div>
                    </form>
                    <div id="sixResult"><?php echo $sixResult ?> </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container">
    <div class="card" style="min-height: 500px;">
        <div class = "card-body">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link lexicographicalOrder" href="#">List Students in Lexicographical Order</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link getListStudentsOver90" href="#">List Students with grades over 90</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link getAvgStudents" href="#">Get Average of All Students</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link getListStudents" href="#">List # Students per Course</a>
                </li>
            </ul>
        <div id="results"></div>
        </div>
    </div>
</div>


    <script src="./gradebook.js"></script>
</body>
</html>