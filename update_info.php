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
//get current email
$somesql = "SELECT email FROM users WHERE username = '$username'";
$theresult = $conn->query($somesql);
if($theresult->num_rows > 0) {
	$row = $theresult->fetch_assoc();
	$current_email = $row['email'];
}


//end get current email
//updates
if($_SERVER['REQUEST_METHOD'] === 'POST'){
	//collect form date
	$newEmail = $_POST['email'];

	$sql = "UPDATE users SET email = ? WHERE id = ?";

	$stmt = $conn->prepare($sql);

	$stmt->bind_param("si", $newEmail, $user_id);

	if($stmt->execute()) {
		echo "succesfully";
	} else {
		echo "error updating";
	}

}//end if

//end update
?>

//html
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
        <h2>Baker Street Golfer Selection</h2>
        </header>

<h5> User logged in: <?php echo htmlspecialchars($username); ?> </h5>
<h5> check the main page! </h5>
<form action="update_info.php" method="post">
	<label for="email">new email:</label>
	<input type="email" name="email" value="enter email here">
	<button type="submit">update email</button>
</form>
<nav>
           <ul>
                <li> <a href="index.html">Logout</a></li>
           </ul>
        <ul>
                <li> <a href="dashboard.php">Back to Dasboard</a></li>
        </ul>
        </nav>
        <footer>
           <p> Standard Irishman 2024</p>
        </footer>

</body>
</html>

