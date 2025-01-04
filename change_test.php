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
//
if($_SERVER["REQUEST_METHOD"] == "POST"){
	if(isset($_POST['golfer_name']) && !empty($_POST['golfer_name'])) {
		$golfer_name = $_POST['golfer_name'];
echo $golfer_name;
//
$sqlname = "SELECT golfer_id FROM golfers WHERE name = ?";
$stmtname = $conn->prepare($sqlname);
    $stmtname-> bind_param("s", $golfer_name);
    $stmtname->execute();
    $stmtname->bind_result($golfer_id);
    $stmtname->fetch();
    $stmtname->close();

//
		echo "you selected golfer with ID: " . $golfer_id;
		$sql1 = "UPDATE selections SET golfer_1 = ? WHERE user_id = ?";
		if ($stmt2 = $conn->prepare($sql1)) {
			$stmt2->bind_param("ii", $golfer_id, $user_id);
			if($stmt2->execute()){
				echo "golfer slection updated " . $golfer_id;
			} else {
				echo "error updating : " . $stmt2->error;
			}
			$stmt2->close();
		} else {
			echo "please selecta golfer ";
		}

}
}
//
$sql = "SELECT golfer_id, name FROM golfers";
$result = $conn->query($sql);

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

li {
font-size: 10px;
}

</style>
</head>
<body>

        <header>
        <h2> <img src="/images/sjulogo.png" alt="my image" width="170" height="170">
<h2> change test page</h2>
        </header>
        
<h1>-------------------------------</h1>

<form action="change_test.php" method="POST">
	<label for "golfer"> choose a golfer</label>
	<select name="golfer_name" id="golfer">
	<option value"">--selects a golfer --</option>

<h1>-------------------------------</h1>

//------------------------------------------------------opening php tag
//display the golfers in the db
	
/////////////////////////////////paste if here
<?php
if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                 echo '<div>';
                 echo '<span>' . $row["name"] . '</span>';
                 echo '<option value"' . $row["golfer_id"] . '">' . $row["name"] . '</option>';
                echo '</div>';
                }//end while

        }//end ifnumrows

?>

//-------------------------------------------------------ending php tag

</select>
<button type="submit">select golfer button</button>
</form>
<h1>-------------------------------</h1>


        <nav>
           <ul>
                <li> <a href="index.html">Logout</a></li>
           </ul>
        <ul>
                <li> <a href="golferselection.php">Select Golfers / Change Selections</a></li>
        </ul>
        <ul>
                <li> <a href="update_info.php">User profile settings</a></li>
        </ul>
	<ul>
                <li> <a href="dashboard.php">back to dashboard</a></li>
        </ul>


        </nav>
        <footer>
           <p> Standard Irishman 2024</p>
        </footer>

</body>
</html>
