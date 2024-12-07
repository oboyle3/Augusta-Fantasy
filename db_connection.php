
<?php  //login.php
session_start();
error_reporting(E_ALL);
ini_set('display_errors' , 1);ini_set('display_startup_errors' ,1);
//database connection settings
$host = "localhost";
$username = "oboyle3";
$password = "Larrybird33";
$dbname = "user_info";
//$chrs =  "utf8mb4"; //characters in utf8

$conn = new mysqli($host, $username, $password, $dbname);

//check connection
if($conn->connect_error){
	die("connection failed: " . $conn->connect_error);
}//end if
else{
	echo "connection successful";
}
//$sql = "SELECT username FROM users";
//$result = $conn->query($sql);
//check if returns results
//if ($result->num_rows > 0) {
//	while($row = $result->fetch_assoc()) {
//	echo "username : ". $row["username"]. "<br>";
//	}//end while

//}//end if
//else {
//echo "no results";
//}
//$conn->close();
?>

