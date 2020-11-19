<?php

$dbOk = false;
@ $db = new mysqli('localhost', 'root', '', 'websys_auth');
if($db->connect_error){
    echo "Couldn't connect to database";
} 
else{
    $dbOk = true;
        
}
if ($dbOk && $_SERVER['REQUEST_METHOD']=='POST') {
    $password = $_POST['password'];

    $hash = hash('sha256', $password);
    $salt = hash('sha256',uniqid(mt_rand(), true));

    $query = "INSERT INTO users (username, password, salt) VALUES ('".$_POST['username']. "','". $hash.$salt."','".$salt."');";
    $db->query($query); 

    
}
?>

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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<div class= "container"> 
<div class = "card">
<div class="col-md-6 col-sm-12">
    <div class="login-form">
        <form action="register.php" method="post">
            <div class="form-group">
                <label for="username">User Name</label>
                <input type="text" name="username" class="form-control" placeholder="User Name" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Password">
            </div>
            <button type="submit" value="save" id="save" name="login" class="btn btn-primary">Register</button>
        </form>
    </div>
</div>
</div>
</div>
</body>
</html>