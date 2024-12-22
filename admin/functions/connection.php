<?php

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "msms_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
?>