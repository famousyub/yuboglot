<?php




require_once (__DIR__."/vendor/autoload.php");
require_once (__DIR__."/configs/db.php");
require_once (__DIR__."/myinfo.php");
$redisClient  =new Predis\Client();



echo $redisClient->get("login_id");






?>

<?php if (empty($redisClient->get("access_token"))): ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title></title>



    <style>
    body {font-family: Arial, Helvetica, sans-serif;}
    form {border: 3px solid #f1f1f1;}
    .frm {
      border-radius: 80%;
    }

    input[type=text], input[type=password] {
      width: 100%;
      padding: 12px 20px;
      margin: 8px 0;
      display: inline-block;
      border: 1px solid #ccc;
      box-sizing: border-box;
    }

    button {
      background-color: #04AA6D;
      color: white;
      padding: 14px 20px;
      margin: 8px 0;
      border: none;
      cursor: pointer;
      width: 100%;
    }

    button:hover {
      opacity: 0.8;
    }

    .cancelbtn {
      width: auto;
      padding: 10px 18px;
      background-color: #f44336;
    }

    .imgcontainer {
      text-align: center;
      margin: 24px 0 12px 0;
    }

    img.avatar {
      width: 40%;
      border-radius: 50%;
    }

    .container {
      padding: 16px;
    }

    span.psw {
      float: right;
      padding-top: 16px;
    }

    /* Change styles for span and cancel button on extra small screens */
    @media screen and (max-width: 300px) {
      span.psw {
         display: block;
         float: none;
      }
      .cancelbtn {
         width: 100%;
      }
    }
    </style>
      <style>
    </style>
  </head>
  <body>

    <div class="container">
    <h2>Auth mode </h2>
    <!-- Button to Open the Modal -->



    <form class="frm" action="/login.php" method="post">
         <div class="erro" style="color:red;">
           <?php  echo $redisClient->get("status");?>
  <?php   if($redisClient->get("status")=="400") {
  echo "error login  something wrong";

  echo "<p>password or input was false</p>";
  } ?>
         </div>

         <input type="hidden" name="ipuser" value="<?php echo  $_SERVER['REMOTE_ADDR']?>">
       <input type="text" name="username" value="">
       <input type="password" name="password" value="">
       <input type="submit" name="sbm" value="login" class="btn btn-success" style="border-radius:80%;">


    </form>

    <br/>

    <small> or register</small>

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
      regisyter
    </button>

<a href="/Registration.php"> register</a>
    <!-- The Modal -->
    <div class="modal" id="myModal">
      <div class="modal-dialog">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Modal Heading</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <div class="alert alert-success alert-dismissible" id="success" style="display:none;">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
	</div>
	<div class="alert alert-danger alert-dismissible" id="error" style="display:none;">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
	</div>
            <form  class="needs-validation"  method="post"   id="register_form" name="form1" novalidate>
              <input type="hidden" name="ip_user" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>">

              <div>
                  <div></div>
                  <div>
                         <span></span>
                   </div>
              </div>
          <div class="form-group">
            <label for="uname">Username:</label>
            <input type="text" class="form-control" id="uname" placeholder="Enter username" name="username" required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
          </div>
          <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" placeholder="Enter mail" name="email" required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
          </div>
          <div class="form-group">
            <label for="pwd">Password:</label>
            <input type="password" class="form-control" id="pwd"  name="password" required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
          </div>
          <div class="form-group">
            <label for="conpwd">gender:</label>
            <input type="text" class="form-control" id="gender"  name="gender" >
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
          </div>
<input type="button" name="save" class="btn btn-primary" value="Register" id="btnreg">
        <!--  <button type="submit" class="btn btn-primary" id="btnreg">Submit</button>-->
        </form>

        <div class="form-group form-check">
          <label class="form-check-label">
            <input class="form-check-input" type="checkbox" name="remember" > I agree on blabla.
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Check this checkbox to continue.</div>
          </label>
        </div>
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>

        </div>
      </div>
    </div>

  </div>

<script src="./scripts/register.js" charset="utf-8"></script>





  <script>
  // Disable form submissions if there are invalid fields
  (function() {
    'use strict';
    window.addEventListener('load', function() {
      // Get the forms we want to add validation styles to
      var forms = document.getElementsByClassName('needs-validation');
      // Loop over them and prevent submission
      var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {
          if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
          }
          form.classList.add('was-validated');
        }, false);
      });
    }, false);
  })();
  </script>





  </body>
</html>

<?php else :?>

<h1>

<?php echo "hello".$redisClient->get("login_id");  ?>
</h1>

<?php

echo "logout";


?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>


    <table>
       <table>
         <th>user_logined</th>
         <tr>
           <td>
      <?php   include_once (__DIR__."/userlogin.php");  ?>
           </td>

         </tr>
       </table>
    </table>

<form class="" action="logout.php" method="post">

  <input type="submit" name="logout" value="logout">

</form>
      </body>
</html>
<?php endif ?>
