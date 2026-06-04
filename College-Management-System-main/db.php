<?php
$servername = "localhost";
$username = "root";
$password = ""; // Default for WAMP
$dbname = "CollegeDB3"; // Updated to your database

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>