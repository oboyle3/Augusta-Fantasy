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
//srart query for user selections
//start query for user selections
$golfer_query = "SELECT g1.name AS golfer_1_name, g2.name AS golfer_2_name, g3.name AS golfer_3_name, g4.name AS golfer_4_name, g5.name AS golfer_5_name FROM selections ugs LEFT JOIN golfers g1 ON ugs.golfer_1 = g1.golfer_id LEFT JOIN golfers g2 ON ugs.golfer_2 = g2.golfer_id LEFT JOIN golfers g3 ON ugs.golfer_3 = g3.golfer_id LEFT JOIN golfers g4 ON ugs.golfer_4 = g4.golfer_id LEFT JOIN golfers g5 ON ugs.golfer_5 = g5.golfer_id WHERE ugs.user_id = ?";
$golfer_stmt =  $conn->prepare($golfer_query);
$golfer_stmt-> bind_param('i',$user_id);
$golfer_stmt->execute();
$golfer_stmt->bind_result($golfer_1_name,$golfer_2_name,$golfer_3_name,$golfer_4_name,$golfer_5_name);
$golfer_stmt->fetch();
$golfer_stmt->close();


//end query for user selections
	//fetch golfers from the golfers table
	$query = "SELECT golfer_id, name FROM golfers";
	$result = $conn->query($query);
        $golfers = [];

	//check if query was successful
	if ($result->num_rows > 0) {
	//display golders with checkboxes
        while( $row = $result->fetch_assoc()){
	$golfers[] = $row;
	}//end while	
}//end if

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
        padding: 10px;
        text-align: center;
        font-size: 21px;
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
        <h2> <img src="/images/sjulogo.png" alt="my image" width="170" height="170">  Baker Street Golfer Selection</h2>
</header>
<h5 style="font-size:10px; line-height:0.4;" > User logged in: <?php echo htmlspecialchars($username); ?> </h5>       
        <h1>---------------------------- </h1>
	<h5>Select five golfers that you will track masters week:<h5>
	<h7> This years field:<h7><br></br>
	<?php
//loop through each golfer
foreach ($golfers as $golfer) {
	echo "name:  " . htmlspecialchars($golfer["name"]). "<br>"; 
	}//end for each
	?>
	<a href="https://www.masters.com/en_US/players/player_list.html" target="_blank"> Complete list here</a>

	<h1>---------------------------- </h1>
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
                <li> <a href="dashboard.php">Back to Dasboard</a></li>
        </ul>
        </nav>
        <footer>
           <p> Standard Irishman 2024</p>
        </footer>

</body>
</html>


