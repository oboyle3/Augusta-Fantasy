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
//$golfer_query = "SELECT g1.name AS golfer_1_name,g1.day1score AS golfer_1_day1score,g1.day2score AS golfer_2_day2score,g1.day3score AS golfer_3_day3score, g2.name AS golfer_2_name, g2.day1score AS golfer_2_day1score , g3.name AS golfer_3_name,/**/g3.day1score AS golfer_3_day1score, /**/ g4.name AS golfer_4_name,g4.day1score AS golfer_4_day1score, /**/ /**/ g5.name AS golfer_5_name /**/,g5.day1score AS golfer_5_day1score FROM selections ugs LEFT JOIN golfers g1 ON ugs.golfer_1 = g1.golfer_id LEFT JOIN golfers g2 ON ugs.golfer_2 = g2.golfer_id LEFT JOIN golfers g3 ON ugs.golfer_3 = g3.golfer_id LEFT JOIN golfers g4 ON ugs.golfer_4 = g4.golfer_id LEFT JOIN golfers g5 ON ugs.golfer_5 = g5.golfer_id WHERE ugs.user_id = ?";
$golfer_query = "SELECT g1.name AS golfer_1_name, g1.day1score AS golfer_1_day1score, g1.day2score AS golfer_1_day2score, g1.day3score AS golfer_1_day3score, g1.day4score AS golfer_1_day4score, g2.name AS golfer_2_name, g2.day1score AS golfer_2_day1score, g2.day2score AS golfer_2_day2score, g2.day3score AS golfer_2_day3score, g2.day4score AS golfer_2_day4score, g3.name AS golfer_3_name, g3.day1score AS golfer_3_day1score, g3.day2score AS golfer_3_day2score, g3.day3score AS golfer_3_day3score, g3.day4score AS golfer_3_day4score,  g4.name AS golfer_4_name, g4.day1score AS golfer_4_day1score, g4.day2score AS golfer_4_day2score, g4.day3score AS golfer_4_day3score, g4.day4score AS golfer_4_day4score, g5.name AS golfer_5_name, g5.day1score AS golfer_5_day1score, g5.day2score AS golfer_5_day2score, g5.day3score AS golfer_5_day3score, g5.day4score AS golfer_5_day4score FROM selections ugs LEFT JOIN golfers g1 ON ugs.golfer_1 = g1.golfer_id LEFT JOIN golfers g2 ON ugs.golfer_2 = g2.golfer_id LEFT JOIN golfers g3 ON ugs.golfer_3 = g3.golfer_id LEFT JOIN golfers g4 ON ugs.golfer_4 = g4.golfer_id LEFT JOIN golfers g5 ON ugs.golfer_5 = g5.golfer_id WHERE ugs.user_id = ?";
$golfer_stmt =  $conn->prepare($golfer_query);
$golfer_stmt->bind_param('i',$user_id);
$golfer_stmt->execute();
//$golfer_stmt->bind_result($golfer_1_name, $golfer_1_day1score,$golfer_1_day2score,$golfer_1_day3score, $golfer_2_name,$golfer_2_day1score,$golfer_3_name, $golfer_3_day1score,$golfer_4_name,$golfer_4_day1score,$golfer_5_name,$golfer_5_day1score);
$golfer_stmt->bind_result(
    $golfer_1_name, $golfer_1_day1score, $golfer_1_day2score, $golfer_1_day3score, $golfer_1_day4score,
    $golfer_2_name, $golfer_2_day1score, $golfer_2_day2score, $golfer_2_day3score, $golfer_2_day4score,
    $golfer_3_name, $golfer_3_day1score, $golfer_3_day2score, $golfer_3_day3score, $golfer_3_day4score,
    $golfer_4_name, $golfer_4_day1score, $golfer_4_day2score, $golfer_4_day3score, $golfer_4_day4score,
    $golfer_5_name, $golfer_5_day1score, $golfer_5_day2score, $golfer_5_day3score, $golfer_5_day4score
);
$golfer_stmt->fetch();
$golfer_stmt->close();
//echo "hello world" . $golfer_1_dayscore;
//array to hold average scores for golfers
$avg_scores = [];
//array of golfer names
$golfer_names = [$golfer_1_name, $golfer_2_name, $golfer_3_name, $golfer_4_name, $golfer_5_name];
//loop through each golfers name to get there avg_score
foreach ($golfer_names as $golfer_name) {
	$sqlforarray = "SELECT avg_score FROM golfers WHERE name = ?";
	if ($stmtforarray = $conn->prepare($sqlforarray)) {
		$stmtforarray->bind_param('s', $golfer_name);
		$stmtforarray->execute();
		$stmtforarray->bind_result($avg_score);
		if($stmtforarray->fetch()){
			$avg_scores[] = $avg_score;
		} else {
			echo "no average found in this golfer: $golfer_name<br>";
		}
		$stmtforarray->close();
		} else {
			echo "error prepping the query";
		}
	}
	if(count($avg_scores) === 5){
		$total_avg_score = array_sum($avg_scores);
		$overall_avg_score = $total_avg_score / count($avg_scores);
		echo "the average score " . $overall_avg_score;
	} else {
		echo "error";
	}
	


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
//golfer_1_average_score = ($golfer_1_day1score + $golfer_1_day2score + $golfer_1_day3score + $golfer_1_day4score ) / 4;


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
table {
margin:20px 0;
border-collapse: collapse;
font-family: Arial, sans-serif;
}
th {
background-color: #4CAF50;
color: white;
padding: 1px;
}
td {
border: 1px solid #ddd;
text-align: center;
}
tr:hover {
background-color: #f2f2f2;
}
h2 {
font-size: 10px;
}
</style>
</head>
<body>
	<header>
	<h2> <img src="/images/sjulogo.png" alt="my image" width="170" height="170">
 Baker Street Main Page</h2>

	</header>
	<h5 style="font-size:10px; line-height:0.4;" > User logged in: <?php echo htmlspecialchars($username); ?> </h5>
<!--	<h5 style="font-size:10px; line-height:0.4;" > your age:  <?php echo htmlspecialchars($age); ?> </h5> -->
<!--	<h5 style="font-size:10px; line-height:0.4;"> your hometown:  <?php echo htmlspecialchars($hometown); ?> </h5> -->
	<!-- <h5 style="font-size:10px; line-height:0.4;" > your email:  <?php echo htmlspecialchars($email); ?> </h5> -->
	<h5> your picked golfers average: <?php echo htmlspecialchars($overall_avg_score);?> </h5>
<table style ="width:50%">
	<tr>
	   <th>your selected golfer</th>
           <th>names</th>
	   <th>Day 1 Score</th>
<th>Day 2 Score</th>
<th>Day 3 Score</th>
<th>Day 4 Score</th>
	</tr>
	<tr>
           <td> 1</td>
	   <td><?php echo htmlspecialchars($golfer_1_name); ?> </td>
	   <td><?php echo htmlspecialchars($golfer_1_day1score); ?> </td>
	   <td><?php echo htmlspecialchars($golfer_1_day2score); ?></td>
           <td><?php echo htmlspecialchars($golfer_1_day3score); ?></td>
	   <td><?php echo htmlspecialchars($golfer_1_day4score); ?><td>

	</tr>
	<tr>
           <td> 2</td>
           <td><?php echo htmlspecialchars($golfer_2_name); ?> </td>
	   <td><?php echo htmlspecialchars($golfer_2_day1score); ?> </td>
           <td><?php echo htmlspecialchars($golfer_2_day2score); ?></td>
           <td><?php echo htmlspecialchars($golfer_2_day3score); ?></td>
           <td><?php echo htmlspecialchars($golfer_2_day4score); ?><td>
        </tr>
	<tr>
           <td>3 </td>
           <td><?php echo htmlspecialchars($golfer_3_name); ?> </td>
	   <td><?php echo htmlspecialchars($golfer_3_day1score); ?> </td>
            <td><?php echo htmlspecialchars($golfer_3_day2score); ?></td>
           <td><?php echo htmlspecialchars($golfer_3_day3score); ?></td>
           <td><?php echo htmlspecialchars($golfer_3_day4score); ?><td>
        </tr>
	<tr>
           <td>4 </td>
           <td><?php echo htmlspecialchars($golfer_4_name); ?> </td>
           <td><?php echo htmlspecialchars($golfer_4_day1score); ?> </td>
	   <td><?php echo htmlspecialchars($golfer_4_day2score); ?></td>
           <td><?php echo htmlspecialchars($golfer_4_day3score); ?></td>
           <td><?php echo htmlspecialchars($golfer_4_day4score); ?><td>
        </tr>
	<tr>
           <td>5 </td>
           <td><?php echo htmlspecialchars($golfer_5_name); ?> </td>
       	<td><?php echo htmlspecialchars($golfer_5_day1score); ?> </td>
           <td><?php echo htmlspecialchars($golfer_5_day2score); ?></td>
           <td><?php echo htmlspecialchars($golfer_5_day3score); ?></td>
           <td><?php echo htmlspecialchars($golfer_5_day4score); ?><td>

        </tr>



</table>
<?php
$sqlleader = "
    SELECT u.username,
        (COALESCE(g1.avg_score, 0) + COALESCE(g2.avg_score, 0) + COALESCE(g3.avg_score, 0) + COALESCE(g4.avg_score, 0) + COALESCE(g5.avg_score, 0)) / 5 AS avg_score 

    FROM users u
    INNER JOIN selections s ON u.id = s.user_id
    LEFT JOIN golfers g1 ON s.golfer_1 = g1.golfer_id
    LEFT JOIN golfers g2 ON s.golfer_2 = g2.golfer_id
    LEFT JOIN golfers g3 ON s.golfer_3 = g3.golfer_id
    LEFT JOIN golfers g4 ON s.golfer_4 = g4.golfer_id
    LEFT JOIN golfers g5 ON s.golfer_5 = g5.golfer_id
    ORDER BY avg_score DESC
    LIMIT 3
";

$resultleader = $conn->query($sqlleader);


if ($resultleader->num_rows > 0) {
    // Output the top 3 leaderboard
    echo "<h2>Top 3 Players</h2>";
    echo "<table border='1'><tr><th>Username</th><th>Total Score</th></tr>";
    while ($row = $resultleader->fetch_assoc()) {
        echo "<tr><td>" . $row['username'] . "</td><td>" . $row['avg_score'] . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "No leaderboard data found.";
}



?>
	<nav>
	<ul>
                <li> <a href="update_info.php">User profile settings</a></li>
        </ul>
</table>
<ul>
                <li> <a href="usergolferselections.php">Change My Golfers</a></li>
        </ul>
<ul>
                <li> <a href="index.html">Logout</a></li>
           </ul>



        </nav>
        <footer>
           <p> Standard Irishman 2024</p>
        </footer>

</body>
</html>

</body>
</html>
