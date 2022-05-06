<?php
function clean($input) {
    $search = array(
      '@<script[^>]*?>.*?</script>@si',   // Javascript tag
      '@<[\/\!]*?[^<>]*?>@si',            // HTML tags
      '@<style[^>]*?>.*?</style>@siU',    // Style tags
      '@<![\s\S]*?--[ \t\n\r]*>@'         // Multi-line
    );

    $output = preg_replace($search, '', $input);
    return $output;
}


function sanitize($input) {
    if (is_array($input)) {
        foreach($input as $var=>$val) {
            $output[$var] = sanitize($val);
        }
    }
    else {
        if (get_magic_quotes_gpc()) {
            $input = stripslashes($input);
        }
        $input  = cleanInput($input);
        $output = mysql_real_escape_string($input);
    }
    return $output;
}

require_once (__DIR__."/vendor/autoload.php");
require_once (__DIR__."/Mydevice.php");
$redisClient  =new Predis\Client();


$detect = Detect::systemInfo();
$device ="web";
if($detect['device']=='MOBILE'){
   $device ="mobile";
}else  {
   $device ="PC";
}

if(isset($_POST["username"]  )  && isset($_POST["email"]) &&isset($_POST["password"])  && isset($_POST["confirm_password"])  ){


$email =sanitize($_POST["email"]);
$username =sanitize($_POST["username"]);
$password =sanitize($_POST["password"]);
$confirm_password =sanitize($_POST["confirm_password"]);



$secret_key = "243ff5897fcd6ec23f4dbf822535ce0f";
$api_id="f08cf18c015409b2b9a6079ab753aced";
$access_token ="So1T9VpVYD1WsiCLmqHtgrseSZ1NxpVJPXzTesFatoeGCsrx9FW6bUGyTHeGzvNOsNOlKLIpbCvPtFjQSMrl7hWEosOPrkSB5A9U";
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://localhost:8096/regapi.php',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>array("username"=>$username,"email"=>$email,"password"=>$password)
  // array('server_key' => $secret_key,'username' => $used,'password' => $password,'email' => $email,'confirm_password' => $confirm_password,'ref' => 'user','device_type' => $device),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;

header("location:index.php");
}
?>
