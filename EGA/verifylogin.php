<?php
// Start session
session_start();

include "dbconnect.php";
// Connect to your database (assuming you're using MySQL)

// Prepare a SQL query to select the user with the submitted username
$sql = "SELECT * FROM docportal WHERE username = '" . $_POST['username'] . "'";
$result = $conn->query($sql);

// Check if a row was returned
if ($result->num_rows > 0) {
    // User exists, fetch the row
    $row = $result->fetch_assoc();
    // Verify the submitted password against the hashed password stored in the database
    if (password_verify($_POST['pass'], $row['pass'])) {
        // Authentication successful, set session variable and redirect to success page
        $_SESSION['username'] = $_POST['username'];
        header("Location: Patient.php");
        exit;
    } else {
        // Password verification failed, redirect back to login page with an error message
        header("Location: patient.php");
        exit;
    }
} else {
    // User does not exist, redirect back to login page with an error message
    echo "<h2>User not found. Please try again.</h2>";
    exit;
}


?>

