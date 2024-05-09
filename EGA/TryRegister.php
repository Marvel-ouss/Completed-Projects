<?php

include "dbconnect.php";

$host = 'localhost';
$username = 'root';
$password = 'root';
$database_name = 'ega';

// Create connection
$conn = new mysqli($host, $username, $password, $database_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_POST['username'];
$email = $_POST['email'];
$pass = $_POST['pass'];
$confpass = $_POST['confpass'];

//Insert Query of SQL
$sql = "INSERT INTO docportal (username, email, pass, confpass) VALUES ('$username', '$email', '$pass', '$confpass')";

if ($conn->query($sql) === TRUE) {
    echo "Data inserted successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the connection
$conn->close();

?>

<TITLE>User Registration</TITLE>

<HEAD>
<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<link href="assets/css/phppot-style.css" type="text/css"
	rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="user-registration.css" /> 
<script src="vendor/jquery/jquery-3.3.1.js" type="text/javascript"></script>
</HEAD>
<BODY>
<form class="form-horizontal" action='TryRegister.php' method="POST">
      <form action="Register.php" method="get">
        <fieldset>
          <div id="legend">

            <legend class="">Register</legend>
          </div>
          
          <div class="control-group">
            <!-- Username -->
            <label class="control-label"  for="username">Username</label>
            <div class="controls">
              <input type="text" id="Username" name="Username" placeholder="" class="input-xlarge" required autocomplete="off" required>
              <p class="help-block">Username can contain any letters or numbers, without spaces</p>
            </div>
          </div>
       
          <div class="control-group">
            <!-- E-mail -->
            <label class="control-label" for="email">E-mail</label>
            <div class="controls">
              <input type="text" id="email" name="email" placeholder="" class="input-xlarge"  required autocomplete="off" required>
              <p class="help-block">Please provide your E-mail</p>
            </div>
          </div>
       
          <div class="control-group">
            <!-- Password-->
            <label class="control-label" for="password">Password</label>
            <div class="controls">
              <input type="password" id="pass" name="pass" placeholder="" class="input-xlarge"  required autocomplete="off" required>
              <p class="help-block">Password should be at least 4 characters</p>
            </div>
          </div>
       
          <div class="control-group">
            <!-- Password -->
            <label class="control-label"  for="password_confirm">Password (Confirm)</label>
            <div class="controls">
              <input type="password" id="confpass" name="confpass" placeholder="" class="input-xlarge"  required autocomplete="off" required>
              <p class="help-block">Please confirm password</p>
            </div>
          </div>
       
          <div class="control-group">
            <!-- Button -->
            <div class="controls">
              <button class="btn btn-success">Register</button>
            </div>

          </form>
    </form>

    <script>
function signupValidation() {
	var valid = true;

	$("#username").removeClass("error-field");
	$("#email").removeClass("error-field");
	$("#password").removeClass("error-field");
	$("#confirm-password").removeClass("error-field");

	var UserName = $("#username").val();
	var email = $("#email").val();
	var Password = $('#signup-password').val();
    var ConfirmPassword = $('#confirm-password').val();
	var emailRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;

	$("#username-info").html("").hide();
	$("#email-info").html("").hide();

	if (UserName.trim() == "") {
		$("#username-info").html("required.").css("color", "#ee0000").show();
		$("#username").addClass("error-field");
		valid = false;
	}
	if (email == "") {
		$("#email-info").html("required").css("color", "#ee0000").show();
		$("#email").addClass("error-field");
		valid = false;
	} else if (email.trim() == "") {
		$("#email-info").html("Invalid email address.").css("color", "#ee0000").show();
		$("#email").addClass("error-field");
		valid = false;
	} else if (!emailRegex.test(email)) {
		$("#email-info").html("Invalid email address.").css("color", "#ee0000")
				.show();
		$("#email").addClass("error-field");
		valid = false;
	}
	if (Password.trim() == "") {
		$("#signup-password-info").html("required.").css("color", "#ee0000").show();
		$("#signup-password").addClass("error-field");
		valid = false;
	}
	if (ConfirmPassword.trim() == "") {
		$("#confirm-password-info").html("required.").css("color", "#ee0000").show();
		$("#confirm-password").addClass("error-field");
		valid = false;
	}
	if(Password != ConfirmPassword){
        $("#error-msg").html("Both passwords must be same.").show();
        valid=false;
    }
	if (valid == false) {
		$('.error-field').first().focus();
		valid = false;
	}
	return valid;
}
</script>
</BODY>
</HTML>
