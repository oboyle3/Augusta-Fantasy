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
  if(isset($POST['action'])) {
    $action = $_POST['action'];
      if($action == "updateGolfer"){
        if(isset($_POST['golfer_name1']) && !empty($_POST['golfer_name1']) && isset($_POST['golfer_name2']) && !empty($_POST['golfer_name2'])) {
	   $golfer_name1= $_POST['golfer_name1'];
           $golfer_name2= $_POST['golfer_name2'];
           echo "Golfer 1 selected: " . $golfer_name1 . "<br>";
           echo "Golfer 2 selected: " . $golfer_name2 . "<br>";
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
	   $sql1 = "UPDATE selections SET golfer_1 = ?, golfer_2 = ? WHERE user_id = ?";
$stmt2 = $conn>prepare($sql1);
	   if(stmt2) {
             $stmt2->bind_param("iii", $golfer_id1, $golfer_id2, $user_id);
               if($stmt->execute()){
                 echo "golfer 1 and 2 updated sccessfully";
               } else {
                 echo "error updating selections";
	       }
	       $stmt2->close();
	   }
          } else {
	     echo "please select golfer 1 and 2";
	  }
        }
   }
}
?>




	
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
<form action="usergolferselections.php" method="post">
  <label for="golfer1>cgoose golfer1</label>
  <select name="golfer_name1" id="golfer1">
  <option value="Bryson Dechambeau">bryson</option>
  </select>
<label for="golfer2>cgoose golfer2</label>
  <select name="golfer_name2" id="golfer2">
  <option value="Bryson Dechambeau">bryson</option>
  </select>
<button type="submit" name="action" value="updateGolfer">update golfer</button>
</form>

</body>
</html>
