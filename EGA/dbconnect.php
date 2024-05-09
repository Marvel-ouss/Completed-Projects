<?php

$host='localhost';
$username='root';
$password='root';
$database_name='ega';



// Create connection
$conn = new mysqli($hostname, $username, $password, $database_name);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

?>