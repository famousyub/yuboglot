<?php





$ip = $_SERVER["REMOTE_ADDR"];


if(isset($_POST["gender"])){
  $gender = $_POST["gender"];
}


?>








<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {box-sizing: border-box;}

body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.topnav {
  overflow: hidden;
  background-color: #e9e9e9;
}

.topnav a {
  float: left;
  display: block;
  color: black;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #ddd;
  color: black;
}

.topnav a.active {
  background-color: #2196F3;
  color: white;
}

.topnav input[type=text] {
  float: right;
  padding: 6px;
  margin-top: 8px;
  margin-right: 16px;
  border: none;
  font-size: 17px;
}

@media screen and (max-width: 600px) {
  .topnav a, .topnav input[type=text] {
    float: none;
    display: block;
    text-align: left;
    width: 100%;
    margin: 0;
    padding: 14px;
  }

  .topnav input[type=text] {
    border: 1px solid #ccc;
  }
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $("p").click(function(){
    $(this).hide();
  });
});
</script>
  </head>
  <body>


    <form action="http://127.0.0.1:8086/fetchingdata.php">
  <label for="gsearch">search here </label>
  <input type="search" id="gsearch" name="gender">
  <button type="click" onsubmit="showCustomer()"> search </button>

</form>
<div id="txtHint">

</div>

<script>
function showCustomer() {

  alert("hello");

const gender =  $("#search").val();
alert(gender);

  if (gender == "") {
    document.getElementById("txtHint").innerHTML = "";
    return;
  }
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
    document.getElementById("txtHint").innerHTML = this.responseText;
  }
  xhttp.open("GET", "http://127.0.0.1:8086/fetchingdata.php?gender="+gender);
  xhttp.send();
}
</script>

  </body>
</html>
