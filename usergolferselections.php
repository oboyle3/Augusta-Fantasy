<?php
session_start();
if(!isset($_SESSION["username"] )){
   echo "user is not logged in";
} else {
   echo "successful login";}
require_once('db_connection.php');
var_dump($_SESSION);
$user_id = $_SESSION['id'];
$username = $_SESSION['username'];
if ($_SERVER["REQUEST_METHOD"] == "POST"){
  if(isset($_POST['action'])) {
    $action = $_POST['action'];
echo "this is the action: " .  $action . "<br>";
echo "<br><br>";
      if($action == "updateGolfer"){
$test= $_POST['golfer_name1'];
echo $test;
echo "you choose golfer 1 as: " . $test;        
        if(isset($_POST['golfer_name1']) && !empty($_POST['golfer_name1']) && isset($_POST['golfer_name2']) && !empty($_POST['golfer_name2'])) {
	   $golfer_name1= $_POST['golfer_name1'];
echo "<br>";
           $golfer_name2= $_POST['golfer_name2'];
           echo "Golfer 1 selected: " . $golfer_name1 . "<br>";
           echo "Golfer 2 selected: " . $golfer_name2 . "<br>";
          /* $sqlname1 = "SELECT golfer_id FROM golfers WHERE name = ?";*/
$sqlname1 = "SELECT golfer_id FROM golfers WHERE name = ?";
           $stmtname1 = $conn->prepare($sqlname1);
           $stmtname1-> bind_param("s", $golfer_name1);
           $stmtname1->execute();
		
           $stmtname1->bind_result($golfer_id1);
           $stmtname1->fetch();
           $stmtname1->close();
           $sqlname2 = "SELECT golfer_id FROM golfers WHERE name = ?";
           $stmtname2 = $conn->prepare($sqlname2);
           $stmtname2-> bind_param("s", $golfer_name2);
           $stmtname2->execute();
           $stmtname2->bind_result($golfer_id2);
           $stmtname2->fetch();
           $stmtname2->close();
           echo "golfer 1 id: " . $golfer_id1 . "<br>";
           echo "golfer 2 id: " . $golfer_id2 . "<br>";
	echo "user id logged in: " . $user_id . "<br>";
	   $sql1 = "UPDATE selections SET golfer_1 = ?, golfer_2 = ? WHERE user_id = ?";
$stmt2 = $conn->prepare($sql1);
	  /* if(stmt2) {*/
             $stmt2->bind_param("iii", $golfer_id1, $golfer_id2, $user_id);
               if($stmt2->execute()){
                 echo "golfer 1 and 2 updated sccessfully";
               } else {
                 echo "error updating selections";
	       }
	       $stmt2->close();
	   /*}
*/          } else {
	     echo "please select golfer 1 and 2";
	  }
        }
   }
}




//add golfer_id here


function generateGolferDropdown($conn) {
$sqlgetgolfer2 = "SELECT  name FROM golfers WHERE tier = 1";
$resultgolfer2 = $conn->query($sqlgetgolfer2);

$output = "";

if($resultgolfer2 &&  $resultgolfer2->num_rows > 0) {
                while($row = $resultgolfer2->fetch_assoc()) {
                $output .= '<option value="' . htmlspecialchars($row["name"]) . '">' . htmlspecialchars($row["name"]) . '</option>';
                }//end while

        }//end ifnumrows
return $output;
}//end functon
//the below is for tier 2 guys
function generateGolferDropdown2($conn) {
	$tier2selections = "SELECT name FROM golfers WHERE tier = 2";
	$resultgolfer3 = $conn->query($tier2selections);
	$output = "";

if($resultgolfer3 &&  $resultgolfer3->num_rows > 0) {
                while($row = $resultgolfer3->fetch_assoc()) {
                $output .= '<option value="' . htmlspecialchars($row["name"]) . '">' . htmlspecialchars($row["name"]) . '</option>';
                }//end while

        }//end ifnumrows
return $output;
}//end functon
//
//the below id for tier 3 guys
function generateGolferDropdown3($conn) {
        $tier3selections = "SELECT name FROM golfers WHERE tier = 3";
        $resultgolfer4 = $conn->query($tier3selections);
        $output = "";

if($resultgolfer4 &&  $resultgolfer4->num_rows > 0) {
                while($row = $resultgolfer4->fetch_assoc()) {
                $output .= '<option value="' . htmlspecialchars($row["name"]) . '">' . htmlspecialchars($row["name"]) . '</option>';
                }//end while

        }//end ifnumrows
return $output;
}//end functon
//the below is for tier 4 guys
function generateGolferDropdown4($conn) {
        $tier4selections = "SELECT name FROM golfers WHERE tier = 4";
        $resultgolfer5 = $conn->query($tier4selections);
        $output = "";

if($resultgolfer5 &&  $resultgolfer5->num_rows > 0) {
                while($row = $resultgolfer5->fetch_assoc()) {
                $output .= '<option value="' . htmlspecialchars($row["name"]) . '">' . htmlspecialchars($row["name"]) . '</option>';
                }//end while

        }//end ifnumrows
return $output;
}//end functon
//the below is for tier 5 guys
function generateGolferDropdown5($conn) {
        $tier5selections = "SELECT name FROM golfers WHERE tier = 5";
        $resultgolfer6 = $conn->query($tier5selections);
        $output = "";

if($resultgolfer6 &&  $resultgolfer6->num_rows > 0) {
                while($row = $resultgolfer6->fetch_assoc()) {
                $output .= '<option value="' . htmlspecialchars($row["name"]) . '">' . htmlspecialchars($row["name"]) . '</option>';
                }//end while

        }//end ifnumrows
return $output;
}//end functon

//
?>

	

<!DOCTYPE html>
<html>
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>dashboard</title>
</head>
<body>
<h1>==</h1>


<form action="usergolferselections.php" method="POST">
        <label for="golfer1"> choose golfer 1</label>
        <select name="golfer_name1" id="golfer1">
        <option value="">--select a Tier 1 golfer here--</option>
	<?php echo generateGolferDropdown($conn); ?>
        </select><br>
	<label for="golfer2"> choose golfer 2</label>
	<select name="golfer_name2" id="golfer2">
	<option value="">--select a Tier 2 golfer  here--</option>
	<?php echo generateGolferDropdown2($conn); ?>
	</select><br>
</select>
        <label for="golfer3"> choose golfer 3</label>
        <select name="golfer_name3" id="golfer3">
        <option value="">--select a Tier 3 golfer  here--</option>
        <?php echo generateGolferDropdown3($conn); ?>
        </select><br>
</select>
        <label for="golfer4"> choose golfer 4</label>
        <select name="golfer_name4" id="golfer4">
        <option value="">--select a Tier 4 golfer here--</option>
        <?php echo generateGolferDropdown4($conn); ?>
        </select><br>
</select>
        <label for="golfer5"> choose golfer 5</label>
        <select name="golfer_name5" id="golfer5">
        <option value="">--select a tier 5 golfer here--</option>
        <?php echo generateGolferDropdown5($conn); ?>
        </select><br>




<button type="submit"name="action" value="updateGolfer">select golfer button</button>
</form>  
<ul>
                <li> <a href="dashboard.php">back to dashboard</a></li>
        </ul>



</body>
</html>
