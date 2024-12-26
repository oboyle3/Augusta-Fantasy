<?php
//start session
session_start();


if(!isset($_SESSION["username"] )){
	//check if user is logged in
	echo "user is not logged in";
}
else {
echo "successful login";
}

require_once('db_connection.php');

var_dump($_SESSION);
$user_id = $_SESSION['id'];
$username = $_SESSION['username'];
//echo "user id in the database" .  $user_id;
//start query for user selections
$golfer_query = "SELECT g1.name AS golfer_1_name, g2.name AS golfer_2_name, g3.name AS golfer_3_name, g4.name AS golfer_4_name, g5.name AS golfer_5_name FROM selections ugs LEFT JOIN golfers g1 ON ugs.golfer_1 = g1.golfer_id LEFT JOIN golfers g2 ON ugs.golfer_2 = g2.golfer_id LEFT JOIN golfers g3 ON ugs.golfer_3 = g3.golfer_id LEFT JOIN golfers g4 ON ugs.golfer_4 = g4.golfer_id LEFT JOIN golfers g5 ON ugs.golfer_5 = g5.golfer_id WHERE ugs.user_id = ?";
$golfer_stmt =  $conn->prepare($golfer_query);
$golfer_stmt-> bind_param('i',$user_id);
$golfer_stmt->execute();
$golfer_stmt->bind_result($golfer_1_name,$golfer_2_name,$golfer_3_name,$golfer_4_name,$golfer_5_name);
$golfer_stmt->fetch();
$golfer_stmt->close();





//$golfer_result = $golfer_stmt->get_result();
//$user_selections = $golfer_result->fetch_assoc();
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
	<h1>------------Your Selected Golfers---------------- </h1>
<h5> 1 :   <?php echo htmlspecialchars($golfer_1_name); ?> </h5>
<h5> 2 :   <?php echo htmlspecialchars($golfer_2_name); ?> </h5>
<h5> 3 :   <?php echo htmlspecialchars($golfer_3_name); ?> </h5>
<h5> 4 :   <?php echo htmlspecialchars($golfer_4_name); ?> </h5>
<h5> 5 :   <?php echo htmlspecialchars($golfer_5_name); ?> </h5>




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
