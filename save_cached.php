<?php


$cookie_name = "user";
$cookie_value =strval($_SERVER["REMOTE_ADDR"]);
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");

require_once (__DIR__."/vendor/autoload.php");
require_once (__DIR__."/configs/db.php");
require_once (__DIR__."/myinfo.php");
$redisClient  =new Predis\Client();

$ttl ;
$arr  =   array();

//if(isset($_COOKIE["user"])) {//echo  $_COOKIE["user"]."hello".strval(json_decode($_COOKIE["h2pushes"],true));}
if($_SERVER["REQUEST_METHOD"]=="GET"){



     $ip = $_SERVER["REMOTE_ADDR"];
     //$redisClient->del($ip);
     $reqcount=$redisClient->incr($ip);

     if($reqcount == 1)$redisClient->expire($ip,30);

     if($reqcount <6){

       $posts =$conn->query("select * from Wo_Posts  limit 20;");

       if($posts->num_rows){
         while($row=$posts->fetch_assoc()){
           array_push($arr,$row);




         }
         $redisClient->expire($ip,30);
         echo  json_encode($arr);
         exit();
       }else  {
           echo json_encode(["status"=>"not fetching data" ]);

       }


     }else {
        $ttl = $redisClient->ttl($ip);
        echo json_encode(["status"=>"you have used up  your allowed quotes try again after ({$ttl} ) seconds"]);

     }

}
