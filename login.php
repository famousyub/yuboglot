<?php

session_start();
require_once (__DIR__."/vendor/autoload.php");
$redisClient  =new Predis\Client();
if(isset($_POST["username"]) && isset ($_POST["password"]) ){

  $username = $_POST["username"];
  $password  = $_POST["password"];
  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => 'http://localhost:82/famousme/api/auth',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => array('server_key' => '243ff5897fcd6ec23f4dbf822535ce0f','username' => $username,'password' => $password),
  ));

  $response = curl_exec($curl);

  curl_close($curl);
  $details = json_decode($response, TRUE);

  if($details["api_status"] == "400")  {header("location:index.php"); $status  = $redisClient->set("status",$details["api_status"]); }

  else {
  $status  = $redisClient->set("status",$details["api_status"]);
  $reqcount=$redisClient->set("login_id",$details["user_id"]);
  $reqcount2 = $redisClient->set("access_token",$details["access_token"]);}

  $_SESSION["username"]=$username;
  $_SESSION["user_id"] =  $details["user_id"];
  //echo $response;
    header("Location:index.php");


}
else  {
  header("Location:index.php");
}
?>

<script>
window.top.navigation ="index.php";
window.location.reload();
</script>
