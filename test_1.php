<?php


require_once ("vendor/autoload.php");


$redis = new Predis\Clinet();
//Connecting to Redis
$redis->connect('127.0.0.1', 6379);
$redis->auth('');

if ($redis->ping()) {
 echo "PONGn";
}

?>
