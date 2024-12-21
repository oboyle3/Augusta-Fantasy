<?php
//start session
session_start();
//database connection settings
//$servername = "localhost";
//$username = "oboyle3";
//$db_password = "Larrybird33";
//$dbname = "user_info";
//create connection
//$conn = new mysqli($servername, $username, $db_password, $dbname);
//get the user id from the session
//$user_id = $_SESSION['user_id'];
//echo "user id" .  $user_id;

if(!isset($_SESSION["username"] )){
	//check if user is logged in
	echo "user is not logged in";
}
else {
echo "successful login";
}
require_once('db_connection.php');
//get the logged in users name
$username = $_SESSION["username"];
//query the db to get user details
$sql = "SELECT age, hometown, email FROM users WHERE username = '$username'";
$result = $conn->query($sql);
//check if user was found
if ($result->num_rows > 0) {
	$row = $result->fetch_assoc();
	$age = $row['age']; //colum name in db age
	$hometown = $row['hometown'];
	$email = $row['email'];
}//end if
else {
$age = "age not found";
}
// $conn->close();
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
header {
	background-color: #666;
	padding: 30px;
	text-align: center;
	font-size: 20px;
	color: white;
}
 footer {
                   text-align: center;
                   padding: 20px;
                   background-color: LightGray;
                }

</style>
</head>
<body>
	<header>
	<h2>Baker Street Main Page</h2>
	</header>
	<h5> User logged in: <?php echo htmlspecialchars($username); ?> </h5>
	<h5> your age:  <?php echo htmlspecialchars($age); ?> </h5>
	<h5> your hometown:  <?php echo htmlspecialchars($hometown); ?> </h5>
	<h5> your email:  <?php echo htmlspecialchars($email); ?> </h5>
	<h1>---------------------------- </h1>


	<nav>
	   <ul>
		<li> <a href="index.html">Logout</a></li>
	   </ul>
	<ul>
		<li> <a href="golferselection.php">Select Golfers</a></li>
	</ul>
	</nav>
	<footer>
           <p> Standard Irishman 2024</p>
        </footer>

</body>
</html>
