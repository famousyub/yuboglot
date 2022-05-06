<?php
$wo =array("genders" =>["male","female"]);

//$wo["genders"] =array("male","female");

//$data  = ["genders"=>["male","female"]];
//array_push($wo , $data);
var_dump( $wo );
var_dump ($wo["genders"]);


require_once (__DIR__."/vendor/autoload.php");
require_once (__DIR__."/configs/db.php");
require_once (__DIR__."/myinfo.php");
$redisClient  =new Predis\Client();
 ?>







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
 <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script>
 <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script>
   // Axios CDN minified version 0.21.1
   <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.24.0/axios.min.js" integrity="sha512-u9akINsQsAkG9xjc1cnGF4zw5TFDwkxuc9vUp5dltDWYCSmyd0meygbvgXrlc/z7/o4a19Fb5V0OUE58J7dcyw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

   // axios is promise based HTTP client for the browser and node.js

 -->
 </head>
 <body>
<div class="wrapper">
	<div class="login fadeInUp animated animated_5" style="overflow:visible;">
		<div class="col-md-5 wo_regi_features">
			<div class="wo_r_features fadeInUp animated animated_9">
				<ul>
					<li>
						<span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#fbc222" d="M7.5,21.5L8.85,20.16L12.66,23.97L12,24C5.71,24 0.56,19.16 0.05,13H1.55C1.91,16.76 4.25,19.94 7.5,21.5M16.5,2.5L15.15,3.84L11.34,0.03L12,0C18.29,0 23.44,4.84 23.95,11H22.45C22.09,7.24 19.75,4.07 16.5,2.5M6,17C6,15 10,13.9 12,13.9C14,13.9 18,15 18,17V18H6V17M15,9A3,3 0 0,1 12,12A3,3 0 0,1 9,9A3,3 0 0,1 12,6A3,3 0 0,1 15,9Z" /></svg>
						<?php echo 'welcome_connect'?></span>
					</li>
					<li>
						<span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#ff6d4c" d="M18,16.08C17.24,16.08 16.56,16.38 16.04,16.85L8.91,12.7C8.96,12.47 9,12.24 9,12C9,11.76 8.96,11.53 8.91,11.3L15.96,7.19C16.5,7.69 17.21,8 18,8A3,3 0 0,0 21,5A3,3 0 0,0 18,2A3,3 0 0,0 15,5C15,5.24 15.04,5.47 15.09,5.7L8.04,9.81C7.5,9.31 6.79,9 6,9A3,3 0 0,0 3,12A3,3 0 0,0 6,15C6.79,15 7.5,14.69 8.04,14.19L15.16,18.34C15.11,18.55 15.08,18.77 15.08,19C15.08,20.61 16.39,21.91 18,21.91C19.61,21.91 20.92,20.61 20.92,19A2.92,2.92 0 0,0 18,16.08Z" /></svg>
						['welcome_share']</span>
					</li>
					<li>
						<span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#00aeb1" d="M3,3H11V7.34L16.66,1.69L22.31,7.34L16.66,13H21V21H13V13H16.66L11,7.34V11H3V3M3,13H11V21H3V13Z" /></svg>
						welcome_discover</span>
					</li>
				</ul>
			</div>
		</div>
		<div class="col-md-7">
			<form id="register" class="fadeInUp animated animated_9" method="post">
				<p class="title">sign_up</p>
				<div class="errors"></div>

				<!--	<div class="wow_form_fields">
						<label for="first_name">first_name</label>
						<input id="first_name" name="first_name" type="text" autocomplete="off" autofocus>
					</div>
					<div class="wow_form_fields">
						<label for="last_name"> last_name</label>
						<input id="last_name" name="last_name" type="text" autocomplete="off" autofocus>
					</div>
-->
					<div class="wow_form_fields">
						<label for="username">username</label>
						<input id="username" name="username" type="text" autocomplete="off" autofocus>
					</div>

				<div class="wow_form_fields">
					<label for="email"><?php echo 'email_address'?></label>
					<input id="email" name="email" type="email" />
				</div>

				<div class="wow_form_fields">
					<label for="password"><?php echo'password';?></label>
					<input id="password" name="password" type="password" />

				</div>
				<div class="wow_form_fields">
					<label for="confirm_password"><?php echo 'confirm_password'?></label>
					<input id="confirm_password" name="confirm_password" type="password" />
				</div>

				<div class="wow_form_fields">
					<label for="gender"><?php echo'gender'?></label>
					<select name="gender" id="gender">
						<option value="0"><?php echo 'gender'?></option>
						<?php foreach ($wo['genders'] as $key => $gender) : ?>
							<option value="<?php echo($key) ?>"><?php echo $gender; ?></option>
						<?php endforeach ?>
					</select>
				</div>



				<div class="login_signup_combo">
					<div class="login__">
						<button type="submit" class="btn btn-main btn-mat btn-mat-raised add_wow_loader" id="sign_submit"  onclick="register();"><?php echo 'lets_go'?></button>
					</div>
					<div class="signup__">
						<p><?php echo 'already_have_account'?> <a class="dec" href="<?php echo  "/index.php"?>"><?php echo 'login'?></a></p>
					</div>
				</div>

			</form>
		</div>
	</div>
</div>
<div class="container"><?php echo "hello sir"?></div>

<script>



async function register(){

  const username =document.getElementById('username').value;
  const email  =document.getElementById('email').value;
  const password =document.getElementById('password').value;
  const gender =document.getElementById('gender').value;
  const confirm_password =document.getElementById('confirm_password').value;

alert(username)
  var formdata = new FormData();
  //formdata.append("server_key", "d1283b82c0fd79aabbe18003dcc51adb");
  formdata.append("username", username);
  formdata.append("password", password);
  formdata.append("email", email);
  formdata.append("confirm_password", confirm_password);
  formdata.append("gender", gender);
  //formdata.append("device_type", "windows");
alert(username);
  var requestOptions = {
    method: 'POST',
    body: formdata,
    redirect: '/index.php'
  };

await   fetch("http://localhost:82/famousme/requests.php?f=register", requestOptions)
    .then(response =>  {response.text() ; <?php echo $reqcount=$redisClient->flushAll() ;?>  })
    .then(result => {console.log(result);  localStorage.setItem("result",result); } )
    .catch(error => console.log('error', error));


}


/*
const username =document.getElementById('username').value;
const email  =document.getElementById('email').value;
const password =document.getElementById('password').value;
const gender =document.getElementById('gender').value;
const confirm_password =document.getElementById('confirm_password').value;
const actionbtn = document.querySelector("#sign_submit");
actionbtn.addEventListener("submit",()=>{

//  const FormData = require('form-data');
  alert(username);
  const form = new FormData();
  form.append('username', 'my value');
  form.append('email', 'my value');
  form.append('password', 'my value');
  form.append('gender', 'my value');
  //form.append('my_buffer', new Buffer(10));
  //form.append('my_file', fs.createReadStream('/foo/bar.jpg'));

  //axios.post('http://localhost:82/famousme/requests.php?f=register"', form, { headers: form.getHeaders() });


  axios.post('http://localhost:82/famousme/requests.php?f=register', {
   headers: {
     'Content-type': 'application/x-www-form-urlencoded',
   },
   body: form,
  });

});



// var working = false;
// var $this = $('#register');
// var $state = $this.find('.errors');
// $(function() {
//   $this.ajaxForm({
//     url: "http://localhost:82/famousme/requests.php?f=register",
//     beforeSend: function() {
//     	/*< ?php if ($wo['config']['password_complexity_system'] == 1) { ?>
//     	if ($('.helper-text .length').hasClass('valid') && $('.helper-text .lowercase').hasClass('valid') && $('.helper-text .uppercase').hasClass('valid') && $('.helper-text .special').hasClass('valid')) {
//     		working = true;
// 			$this.find('button').attr("disabled", true);
// 			$this.find('.add_wow_loader').addClass('btn-loading');
//     	}
//     	else{*/
//     //		$state.html("< ?php echo($wo['lang']['complexity_requirements']) ?>");
//     	//	return false;
//       console.log("traitement");
//       working = true;
// //  $this.find('button').attr("disabled", true);
// //  $this.find('.add_wow_loader').addClass('btn-loading');
//     //	}
//         //< ? php } else{ ?>
//
//     //    < ?php } ?>
//
//
//     },
//     success: function(data) {
//       if (data.status == 200) {
//         //console.log()
// 		$state.addClass('success');
//         $state.html('< ?php echo 'welcome_' ?>');
// 		$this.find('.add_wow_loader').removeClass('btn-loading');
//         setTimeout(function () {
//          window.location.href = data.location;
//         }, 1000);
//       } else if (data.status == 300) {
//         window.location.href = data.location;
//       } else {
//         $this.find('button').attr("disabled", false);
// 		$this.find('.add_wow_loader').removeClass('btn-loading');
//         $state.html(data.errors);
//       }
//       working = false;
//     }
//   });
// });
//
// function activateButton(element) {
// 	if(element.checked) {
// 		document.getElementById("sign_submit").disabled = false;
// 	}
// 	else  {
// 		document.getElementById("sign_submit").disabled = true;
// 	}
// };
//
//
//




</script>
<?php //if ($wo['config']['password_complexity_system'] == 1) { ?>

  <script>
/*
(function(){
	var helperText = {
		charLength: document.querySelector('.helper-text .length'),
		lowercase: document.querySelector('.helper-text .lowercase'),
		uppercase: document.querySelector('.helper-text .uppercase'),
		special: document.querySelector('.helper-text .special')
	};
	var password = document.querySelector('#password');



	var pattern = {
		charLength: function() {
			if( password.value.length >= 6 ) {
				return true;
			}
		},
		lowercase: function() {
			var regex = /^(?=.*[a-z]).+$/; // Lowercase character pattern

			if( regex.test(password.value) ) {
				return true;
			}
		},
		uppercase: function() {
			var regex = /^(?=.*[A-Z]).+$/; // Uppercase character pattern

			if( regex.test(password.value) ) {
				return true;
			}
		},
		special: function() {
			var regex = /^(?=.*[0-9_\W]).+$/; // Special character or number pattern

			if( regex.test(password.value) ) {
				return true;
			}
		}
	};

	// Listen for keyup action on password field
  password.addEventListener('keyup', function (){
  	    $('.helper-text').slideDown('slow', function() {

  	    });
		// Check that password is a minimum of 8 characters
		patternTest( pattern.charLength(), helperText.charLength );

		// Check that password contains a lowercase letter
		patternTest( pattern.lowercase(), helperText.lowercase );

		// Check that password contains an uppercase letter
		patternTest( pattern.uppercase(), helperText.uppercase );

		// Check that password contains a number or special character
		patternTest( pattern.special(), helperText.special );

    // Check that all requirements are fulfilled
    if( hasClass(helperText.charLength, 'valid') &&
			  hasClass(helperText.lowercase, 'valid') &&
			 	hasClass(helperText.uppercase, 'valid') &&
			  hasClass(helperText.special, 'valid')
		) {
			addClass(password.parentElement, 'valid');
    }
    else {
      removeClass(password.parentElement, 'valid');
    }
	});

	function patternTest(pattern, response) {
		if(pattern) {
      addClass(response, 'valid');
    }
    else {
      removeClass(response, 'valid');
    }
	}

	function addClass(el, className) {
		if (el.classList) {
			el.classList.add(className);
		}
		else {
			el.className += ' ' + className;
		}
	}

	function removeClass(el, className) {
		if (el.classList)
				el.classList.remove(className);
			else
				el.className = el.className.replace(new RegExp('(^|\\b)' + className.split(' ').join('|') + '(\\b|$)', 'gi'), ' ');
	}

	function hasClass(el, className) {
		if (el.classList) {
			console.log(el.classList);
			return el.classList.contains(className);
		}
		else {
			new RegExp('(^| )' + className + '( |$)', 'gi').test(el.className);
		}
	}

})();*/
//< ?php //} ?>

</script>

</body>

</html>
