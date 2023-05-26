<?php
$servername = "localhost";
$username   = "root";
$dbpassword = "";
$dbname     = "moneymon_278723_fyp";

// Create connection

$conn = new mysqli($servername, $username, $dbpassword, $dbname);

// Check connection

if ($conn->connect_error) {

    die("Connection failed: " . $conn->connect_error);

} 
?>