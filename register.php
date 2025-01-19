
<?php
//start session to handle potential redirects after registration
session_start();
error_reporting(E_ALL);
ini_set('display_errors' , 1);ini_set('display_startup_errors' ,1);
//check if form has been submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
        //COLLECT FORM DATA
        $username = $_POST['username'];
        $password = $_POST['password'];
        $age = $_POST['age'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $hometown = $_POST['hometown'];
        $email = $_POST['email'];
	//check if username exists
//	try
	{
//echo "l";
//	$new_stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = :username");
//	$new_stmt->bindParam("username", $username,PDO::PARAM_STR);
//	$new_stmt->execute();
//	$usernameExists = new_$stmt->fetchColumn();
	//if the usernameexists throw error
//	if($usernameExists >0){
		echo "user exists";
//	}
	}//end try
	//database connection settings
	$host = "localhost";
	$dbusername = "oboyle3";
	$dbpassword = "Larrybird33";
	$dbname = "user_info";
	$chrs =  "utf8mb4"; //characters in utf8
	$attr = "mysql:host=$host=$host;dbname=$dbname;charset=$chrs";

	try {
        //create a new pdo instance (connect to db)
        $conn  = new PDO("mysql:host=$host;dbname=$dbname",$dbusername,$dbpassword);
        //set pdo error mode to exception for better debugging
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	//prepare the sql statement to insert the user data
	$sql =("INSERT INTO users (username, password, age, first_name, last_name, hometown, email) VALUES (:username, :password, :age, :firstname, :lastname, :hometown, :email)");
	
	//prep sql statement
	$stmt = $conn->prepare($sql);
	//bind the parameters
	$stmt->bindParam(":username",$username);
	$stmt->bindParam(":password",$password);
	$stmt->bindParam(":age",$age);
	$stmt->bindParam(":firstname",$first_name);
	$stmt->bindParam(":lastname",$last_name);
	$stmt->bindParam(":hometown",$hometown);
	$stmt->bindParam(":email",$email);
	//execute the sql
	$stmt->execute();
	$_SESSION["message"] = "sucessfully registered please log in";
	$user_id = $conn->lastInsertID();

	echo "id:      " . $user_id;
	$golfer1 = 1;
	$golfer2 = 2;
	$golfer3 = 3;
	$golfer4 = 4;
	$golfer5 = 5;
	$sql_selections = "INSERT INTO selections (user_id, golfer_1, golfer_2, golfer_3, golfer_4, golfer_5) VALUES (:user_id, :golfer1, :golfer2, :golfer3, :golfer4, :golfer5)";
	$stmt_selections = $conn->prepare($sql_selections);
	$stmt_selections->bindParam(":user_id",$user_id);
$stmt_selections->bindParam(":golfer1",$golfer1);
$stmt_selections->bindParam(":golfer2",$golfer2);
$stmt_selections->bindParam(":golfer3",$golfer3);
$stmt_selections->bindParam(":golfer4",$golfer4);
$stmt_selections->bindParam(":golfer5",$golfer5);
$stmt_selections->execute();


	header("Location: index.html");
	exit();

	 }//end try
	catch (PDOException $e) {
        	echo "connection failed " . $e->getMessage();
	}//end catch

//end if
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
        <form action="register.php" method="POST">
	<label for="username">Username:</label>
	<input type="text" id="username" name="username" required><br>
	<label for="password">Password:</label>
	<input type="password" id="password" name="password" required><br>
	<label for"age">Age:</label>
        <input type="number" id="age" name="age" required><br>
        <label for="firstname">First Name:</label>
        <input type="text" id="first_name" name="first_name" required><br>
	<label for="lastname">Last Name:</label>
        <input type="text" id="last_name" name="last_name" required><br>
	<label for="hometown">hometown:</label>
        <input type="text" id="hometown" name="hometown" required><br>
	<label for="email">email:</label>
        <input type="email" id="email" name="email" required><br>
	
	<button type="submit">register</button>

	<a href="index.html">
		<button type="button"> go to login</button>
	</a>

</body>
</html>

