<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors' , 1);ini_set('display_startup_errors' ,1);
//database connection settings
$servername = "localhost";
$username = "oboyle3";
$db_password = "Larrybird33";
$dbname = "user_info";
//create connection
$conn = new mysqli($servername, $username, $db_password, $dbname);
//check connection
if ($conn->connect_error){
	die("connection failed" . $conn->connect_error);
echo "connectio is dead";

}
//get form data
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	$username = $_POST['username']; 
	$password = $_POST['password'];
//todo santizize the input to prevent sql injestion
//qery to check if user exists
$sql = "SELECT password FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
//bind paramters s indicates string type
if($stmt){
	$stmt->bind_param("s",$username);
	$stmt->execute();
	$stmt->bind_result($stored_password);
}

//echo "rocky road to dublin \n";
$stmt->fetch();
echo "stored pass " .  $stored_password;
if ($stored_password === $password){
	echo "kkkkkk";
	$_SESSION['username'] = $username;
        $_SESSION['logged_in'] = true;
	echo  "USERNAMEE" . $_SESSION['username'];
        header("Location: dashboard.php");
	

		
}
else{ 
	echo "outside";
}

}
$conn->close();
?>
