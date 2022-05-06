<?php

$redis = new Redis();
//Connecting to Redis
$redis->connect('127.0.0.1', 6379);
$redis->auth('');

if ($redis->ping()) {
 echo "PONGn";
}

?>
