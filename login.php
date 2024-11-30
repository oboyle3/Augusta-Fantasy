<?php  //login.php
session_start();
error_reporting(E_ALL);
ini_set('display_errors' , 1);ini_set('display_startup_errors' ,1);
//database connection settings
$host = "localhost";
$username = "oboyle3";
$password = "Larrybird33";
$dbname = "user_info";
$chrs =  "utf8mb4"; //characters in utf8
$attr = "mysql:host=$host=$host;dbname=$db;charset=$chrs";

try 
{
	//create a new pdo instance (connect to db)
	$conn  = new PDO("mysql:host=$host;dbname=$dbname",$username,$password);

	//set pdo error mode to exception for better debugging
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
	echo "connection failed " . $e->getMessage();
}


$sql = SELECT username FROM users;

//prep sql statment
$stmt = $conn->prepare($sql);
//bind the username param to poboyle
$stmt->bindParam(':username', $username, PDO::PARAM_STR);
//set the username to poboyle
$username = 'poboyle';
//execute statement
$stmt->execute();
//fatch results
$user = $stmt->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html>
	<head>
		<title>helloworld</title>
	 </head>
<body>
	<h1> users </h2>

<?php
//check if user exists
if($user){
echo"username : " . htmlspecialchars($user['username']) . " ,good? ";
}//end if
else {
echo "user not found";
}//end else
?>
</body>
</html>
