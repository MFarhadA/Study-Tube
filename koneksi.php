<?php

// Start session
session_start();

$rootPath = $_SERVER['DOCUMENT_ROOT'];

// Enable error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Database connection
$servername = "localhost"; // Your database host
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "study_tube"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>