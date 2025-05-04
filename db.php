<?php
$host = "localhost"; // or your DB server IP
$username = "root"; // your DB username
$password = ""; // your DB password
$dbname = "userDB"; // your DB name

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
