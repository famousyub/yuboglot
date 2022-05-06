

<?php


require_once (__DIR__."/vendor/autoload.php");
require_once (__DIR__."/configs/db.php");
require_once (__DIR__."/myinfo.php");
$redisClient  =new Predis\Client();


if(!empty($redisClient->get("login_id"))){

  $id = intval( $redisClient->get("login_id"));
  echo   "your id".$id;
  $sql = "SELECT user_id, username, email FROM Wo_Users WHERE user_id=$id";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      echo "<br> id: ". $row["user_id"]. " - Name: ". $row["username"]. " " . $row["email"] . "<br>";
    }
  } else {
    echo "0 results";
  }

}
else {
    echo "you should login sir ";
}




?>
