<?php
session_start();
//database connection file
require_once('db_connection.php');

if($_SERVER["REQUEST_METHOD"] == "POST"){
//GET FORM DATA
	$username = $_POST['username'];
	$password = $_POST['password'];
	//SANITIZE FOR SQL INGESTION
	$username = $conn->real_escape_string($username);
	$password = $conn->real_escape_string($password);
echo "user:  " . $username;
echo "pass:  " . $password;

	$sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
	$result =$conn->query($sql);

	if ($result->num_rows > 0) {
		$_SESSION['username'] = $username; //store info in session
	header('Location: dashboard.php');
	exit();
	}//end if
	else {
	$error_message = "invalid username or pass";
	}
}//end if for POST
$conn->close();


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Validate</title>
</head>
<body>
	<h2>Login Please</h2>
	<?php
	if(isset($error_message)) {
		echo "<p>$error_message</p>";
	}//end if
	?>
	<form method="POST" action="">
		<label for="username">Username:</label>
		<input type = "text" name="username" id="username" required><br><br>

        <form method="POST" action="">
                <label for="password">Password:</label>
                <input type = "text" name="password" id="password" required><br><br>

	<input type="submit" value="Login please">

	</form>
</body>
<html>
