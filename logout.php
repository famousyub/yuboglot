<?php

session_destroy();



require_once (__DIR__."/vendor/autoload.php");
$redisClient  =new Predis\Client();



$redisClient->flushAll();

header("Location:index");

?>
