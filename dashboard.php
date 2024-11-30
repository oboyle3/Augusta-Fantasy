<?php
//start session
session_start();
//database connection settings
$servername = "localhost";
$username = "oboyle3";
$db_password = "Larrybird33";
$dbname = "user_info";
//create connection
$conn = new mysqli($servername, $username, $db_password, $dbname);
//get the user id from the session
//$user_id = $_SESSION['user_id'];
//echo "user id" .  $user_id;
if(!isset($_SESSION["logged_in"] )){
	echo "user is not logged in";
}
$age = $_SESSION['age'];
echo $age;

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>dashboard</title>
<style>body {
background-color: Cornsilk;
}
</style>
</head>
<body>
	<h1> welcome you are logged in </h1>
	<p>hello , <?php echo ($_SESSION['username']) ?>!</p>
	<p>our records show you your age is  , <?php echo ($_SESSION['age'])  ?>!</p>

</body>
</html>
