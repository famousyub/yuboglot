<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Registration</title>
<link rel="stylesheet" href="<?php __DIR__. '/css/style.css' ?>" />
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<?php
require_once  ( __DIR__. '/configs/db.php');

function cleanInput($input) {
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
      //  $output = mysqli_real_escape_string($input);
    }
    return $input;
}
// If form submitted, insert values into the database.
if (isset($_REQUEST['username'])){
        // removes backslashes
	$username = stripslashes($_REQUEST['username']);
        //escapes special characters in a string
	$username = mysqli_real_escape_string($conn,$username);
	$email = stripslashes($_REQUEST['email']);
	$email = mysqli_real_escape_string($conn,$email);
	$password = stripslashes($_REQUEST['password']);
	$password = mysqli_real_escape_string($conn,$password);
	$trn_date = date("Y-m-d H:i:s");
  $type ="user";

  $gender  = stripslashes($_REQUEST['password']);
  $gender = mysqli_real_escape_string($conn,$gender);

  $username =sanitize($username);
  $email =sanitize($email);
  $password =sanitize($password);

  //echo $username ;
  //echo $password ;
  //echo $email;
//" ${$username}"
//$sql = "INSERT INTO `crud`( `name`, `email`, `phone`, `city`, `password`)
		//	VALUES ('$name','$email','$phone','$city', '$password')";
$data ="'{$username}', '{password_hash($password, PASSWORD_DEFAULT)}', '{$email}', '{$gender}','{$type}'";
        $query = "INSERT into `Wo_Users` (username, password, email,gender ,  type)  VALUES ( '$username', '".password_hash($password, PASSWORD_DEFAULT)."', '$email', '$gender','$type' ) ";
        $result = mysqli_query($conn,$query);
        if($result){
            echo "<div class='form'>
<h3>You are registered successfully.</h3>
<br/>Click here to <a href='login.php'>Login</a></div>";
        }
    }else   ?>

    <?php  echo "register";?>
<div class="form">
<h1>Registration</h1>
<form name="registration" action="" method="post">
<input type="text" name="username" placeholder="Username" required />
<input type="email" name="email" placeholder="Email" required />
<input type="password" name="password" placeholder="Password" required />
<input type="text" name="gender" value="">
<input type="submit" name="submit" value="Register" />
</form>
</div>
<?php  ?>
</body>
</html>
