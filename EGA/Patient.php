<!DOCTYPE html>
<html lang="en">
<head>

<style>
        body {
            overflow-y: scroll; /* Add vertical scrollbar */
        }
    </style>


<meta charset="utf-8">
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

<link rel="stylesheet" type="text/css" href="Real Thing.html">



</head>

<body>

    

    <section data-bs-version="5.1" class="form5 cid-u8BkdVGtQr" id="contact-form-3-u8BkdVGtQr">
    
    
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 content-head">
                    <div class="mbr-section-head mb-5">
                        <h3 class="mbr-section-title mbr-fonts-style align-center mb-0 display-2">
                            <strong>Doctor's Portal</strong>
                        </h3>
                        
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8 mx-auto mbr-form" data-form-type="formoid">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" >
                        <div class="row">
                            
                        </div>
                        <div class="dragArea row">
                            <div class="col-md col-sm-12 form-group mb-3" data-for="patientID">
    <input type="text" name="search_query" placeholder="Enter Patient ID or First Name" data-form-field="patientID" class="form-control" value="" id="name-contact-form-3-u8BkdVGtQr">
</div>                                                
                            <div class="col-lg-12 col-md-12 col-sm-12 align-center mbr-section-btn">
                            
                                <button type="submit" name="search" class="btn btn-primary">Display Data</button>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12 align-center mbr-section-btn">
                            
                            <a href="updatedata.php" class="btn btn-primary display-7">Update Data</a>

                        </div>
                            

                            

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    


</body>






<?php
include "dbconnect.php";

// Attempt MySQL server connection.
$link = mysqli_connect("localhost", "root", "root", "ega");

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search'])) {
    // Retrieve search query and sanitize it
    $search_query = mysqli_real_escape_string($link, $_POST['search_query']);

    // Construct the SQL query to fetch patient data
    $sql = "SELECT * FROM patdata WHERE fname LIKE '%$search_query%' OR PatientID = '$search_query'";

    // Execute the query
    $result = mysqli_query($link, $sql);

    // Check if any records found
    if (mysqli_num_rows($result) > 0) {
        // Display table headers
        echo "<table class='table'>";
        echo "<thead>";
        echo "<tr><th>FName</th><th>LName</th><th>Hospital</th><th>DoB</th><th>PatientID</th><th>Allergies & Treatments</th><th>Treatment History</th><th>Lab Results</th><th>Medical Directives</th></tr>";
        echo "</thead>";
        echo "<tbody>";
        // Fetch and display each row of patient data
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['fname'] . "</td>";
            echo "<td>" . $row['lname'] . "</td>";
            echo "<td>" . $row['Hospital'] . "</td>";
            echo "<td>" . $row['DoB'] . "</td>";
            echo "<td>" . $row['PatientID'] . "</td>";
            echo "<td>" . $row['Allergies&Treatment'] . "</td>";
            echo "<td>" . $row['TreatmentHistory'] . "</td>";
            echo "<td>" . $row['LabResults'] . "</td>";
            echo "<td>" . $row['MedicalDirective'] . "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
    } else {
        echo "<centre>No records found!</centre>";
    }
}
?>
</div>
</div>
</div>

<!-- Bootstrap JS -->
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>

</body>
</html>

