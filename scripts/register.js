
alert("begin register");


$('#btnreg').on('click', function() {
	//	$("#butsave").attr("disabled", "disabled");
		var name = $('#uname').val();
		var email = $('#email').val();
    var gender = $('#gender').val();
		//var phone = $('#password').val();
	//	var city = $('#city').val();
		var password = $('#pwd').val();
 var serializedData = $("#register_form").serialize();
 console.table(serializedData);
    console.log(name);
    console.log(email);
		if(name!="" && email!=""  && password!="" ){
			$.ajax({
				url: "http://localhost:82/famousme/requests.php?f=register",
				type: "POST",
				data: {
          username : name  ,
         email :   email ,
          password :password,
          gender :gender
        },
    /*    {
				//	type: 1,
					username: name,
					email: email,
			//		phone: phone,
				//	city: city,
					password: password
				},*/
				cache: false,
				success: function(dataResult){
          console.table(dataResult);
					//var dataResult = JSON.parse( dataResult);
					if(dataResult.status==200){
						//$("#butsave").removeAttr("disabled");
            console.table(dataResult);
						$('#register_form').find('input:text').val('');
						$("#success").show();
						$('#success').html('Registration successful !');
					}
					else if(dataResult.status==300){
						$("#error").show();
						$('#error').html('Email ID already exists !');
					}

				}
			});
		}
		else{
			alert('Please fill all the field !');
		}
	});
