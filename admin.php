<?php
//get the logged in users name
$username = $_SESSION["username"];
echo $username;
session_start();
if(!isset($_SESSION["username"] )){
        //check if user is logged in
        echo "user is not logged in";
}
else {
echo "successful login";
}
var_dump($_SESSION);

$user_id = $_SESSION['id'];
$username = $_SESSION['username'];
require_once('db_connection.php');
if($_SERVER['REQUEST_METHOD'] === 'POST'){
$name = $_POST['name'];
echo "name " . $name;
//$tier = $_POST['tier'];
//echo "tier " . $tier;
        //prepare the sql statement to insert the user data
        $sql ="INSERT INTO golfers (name) VALUES(?)";
        //prep sql statement
        $stmt = $conn->prepare($sql);
        //bind the parameters
        $stmt->bindParam("s",$name);
        
        //execute the sql
       if( $stmt->execute()) {
		echo "statment executed";
	} else {
		echo "statement error";
	}

        $_SESSION["message"] = "sucessfully registered please log in";
}
?>

<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.3">

        <head>
                <title>register page</title>
         </head>
<body>
 <h1> register </h1>
        <form action="admin.php" method="POST">
       <!--  <label for"tier">tier</label>
        <input type="number" id="tier" name="tier" required><br> -->
        <label for="name">TEST  Name:</label>
        <input type="text" id="name" name="name" required><br>
        

        <button type="submit">register</button>
<h4>back to dash</h4>
        <a href="dashboard.php">
                <button type="button">back to dashboard</button>
        </a>

</body>
</html>

