<?php
$servername = "localhost";
$username = "root";
$password = ""; // Change this to your database password
$dbname = "db_quanlydienthoai";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
