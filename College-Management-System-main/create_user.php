<?php
// Save this as create_user.php and run it once
include 'db.php';

$username = 'admin';
$password = password_hash('admin', PASSWORD_DEFAULT); // secure hashing

$sql = "INSERT INTO Users (Username, Password) VALUES ('$username', '$password')";
$conn->query($sql);

echo "User created.";
?>
