<?php
//start session
session_start();
//echo  "USERNAMEE" . $_SESSION['username'];

//check if user is logged in 
if(!isset($_SESSION["logged_in"] )){
	//redirect to loginpage if not logged in
//	header("Location: login.php");
	echo "i make";

}
//echo "    welcome, " . htmlspecialchars($_SESSION['username']) . "!";

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
</body>
</html>
