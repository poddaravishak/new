<?php
// Database configuration
$host = "localhost"; // Replace with your database host
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "alumni"; // Replace with your database name

// Establishing the database connection
$connection = mysqli_connect($host, $username, $password, $dbname);

// Check if the connection was successful
if (mysqli_connect_errno()) {
  die("Database connection failed: " . mysqli_connect_error());
}
