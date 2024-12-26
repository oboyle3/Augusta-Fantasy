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
require_once('db_connection.php');
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
       
        <h1>---------------------------- </h1>
	<h5>Select three golfers that you will track masters week:<h5>
	<h7> Note: this is a one time selection pick wisely<h7><br></br>
	<?php
//loop through each golfer
foreach ($golfers as $golfer) {
	echo "name:  " . htmlspecialchars($golfer["name"]). "<br>"; 
	}//end for each
	?>
	<h1>---------------------------- </h1>
	
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


