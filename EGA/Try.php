
<!-- HTML form for registration -->

<!DOCTYPE html>
<html lang="en">
<head>
<TITLE>User Registration</TITLE>


<meta charset="utf-8">


<link rel="stylesheet" type="text/css" href="Real Thing.html">


<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="generator" content="Mobirise v5.9.13, a.mobirise.com">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
<link rel="shortcut icon" href="assets/images/photo-1532938911079-1b06ac7ceec7.jpeg" type="image/x-icon">
<meta name="description" content="Access patient data from public hospitals by specifying patient ID. Improve patient care and treatment with easy access to medical records.">
<title>Medical Records Access</title>
<link rel="stylesheet" href="https://r.mobirisesite.com/372112/assets/web/assets/mobirise-icons2/mobirise2.css?rnd=1711887856918">
<link rel="stylesheet" href="https://r.mobirisesite.com/372112/assets/bootstrap/css/bootstrap.min.css?rnd=1711887856918">
<link rel="stylesheet" href="https://r.mobirisesite.com/372112/assets/bootstrap/css/bootstrap-grid.min.css?rnd=1711887856918">
<link rel="stylesheet" href="https://r.mobirisesite.com/372112/assets/bootstrap/css/bootstrap-reboot.min.css?rnd=1711887856918">
<link rel="stylesheet" href="https://r.mobirisesite.com/372112/assets/parallax/jarallax.css?rnd=1711887856918">
<link rel="stylesheet" href="https://r.mobirisesite.com/372112/assets/dropdown/css/style.css?rnd=1711887856918">
<link rel="stylesheet" href="https://r.mobirisesite.com/372112/assets/socicon/css/styles.css?rnd=1711887856918">
<link rel="stylesheet" href="https://r.mobirisesite.com/372112/assets/theme/css/style.css?rnd=1711887856918">
<link rel="preload" href="https://fonts.googleapis.com/css2?family=Inter+Tight:wght@400;700&display=swap&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
<noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter+Tight:wght@400;700&display=swap&display=swap"></noscript>
<link rel="stylesheet" href="https://r.mobirisesite.com/372112/assets/css/mbr-additional.css?rnd=1711887856918" type="text/css">



</head>
<body>

<section data-bs-version="5.1" class="form5 cid-u8BkdVGtQr" id="contact-form-3-u8BkdVGtQr">
    
            <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 content-head">
                <div class="mbr-section-head mb-5">
                    <h3 class="mbr-section-title mbr-fonts-style align-center mb-0 display-2">
                        <strong>Register With Us! </strong>
                    </h3>
                    
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8 mx-auto mbr-form" data-form-type="formoid">
                
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="mbr-form form-with-styler" data-form-title="Form Name"><input type="hidden" name="email" data-form-email="true" value="RGWl34UH74kN3oYmFd8T233CTmxYy7/Fi42y+bhCft8LWuppTxxgHoBFiDD >
                    <div class="row">
                        <div hidden="hidden" data-form-alert="" class="alert alert-success col-12">Thanks for filling out the form!</div>
                        <div hidden="hidden" data-form-alert-danger="" class="alert alert-danger col-12">
                            Oops...! some problem!
                        </div>
                    </div>
                    <div class="dragArea row">
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="col-md col-sm-12 form-group mb-3" data-for="Username">
            <input type="text" name="username" placeholder="Username" data-form-field="Username" class="form-control" value="" id="name-contact-form-3-u8BkdVGtQr" required>
        </div>

        <div class="col-md col-sm-12 form-group mb-3" data-for="Email">
            <input type="email" name="email" placeholder="Email" data-form-field="Email" class="form-control" value="" id="email-contact-form-3-u8BkdVGtQr" required>
        </div>

        <div class="col-md col-sm-12 form-group mb-3" data-for="Password">
            <input type="password" name="pass" placeholder="Password" data-form-field="Password" class="form-control" value="" id="password-contact-form-3-u8BkdVGtQr" required>
        </div>

        <div class="col-md col-sm-12 form-group mb-3" data-for="Confirm Password">
            <input type="password" name="confpass" placeholder="Confirm Password" data-form-field="Confirm Password" class="form-control" value="" id="confirmpassword-contact-form-3-u8BkdVGtQr" required>
        </div>
                        
                        <div class="col-lg-12 col-md-12 col-sm-12 align-center mbr-section-btn">
                            <button type="submit" class="btn btn-primary display-7">Register</button>
                            
                        </div>
                    </div>

                    <div class="text-center text-lg-start mt-4 pt-2">
                    
                           
                    <p style="text-align:center; font-size: 18px;"><b>Already Registered?</b> <a href="patient.php" class="link-danger">Log In!</a></p>

                  </div>

    </form>
</div>

</body>
</html>

<?php

include "dbconnect.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $confpass = $_POST['confpass'];

    // Check if passwords match
    if ($pass!= $confpass) {
        echo "Error: Passwords do not match.";
        exit; // Stop further execution
    }

    // Hash the password before storing it in the database (for security)
    $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

    // Prepare INSERT query
    $sql = "INSERT INTO docportal (username, email, pass, confpass) VALUES ('$username', '$email', '$pass', '$confpass' )";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "<h1>Registration successful!</h1>";
    } else {
        echo "<h2>Registration failed. Please try again.</h2>";
    }

    // Close the database connection
    $conn->close();
}

?>
