<?php


$host ="localhost:3306";

$user   ="root";
$db_name ="famousme";

$db_pass ="";

$conn =new mysqli($host,$user,$db_pass,$db_name);

if($conn->connect_errno){
    echo "error ";
    exit();
}


?>
