<?php
session_start(); // Start the session

// Destroy the session and redirect to the login page
session_unset(); // Unset all session variables
session_destroy(); // Destroy the session
http_response_code(200); // Send a successful response
exit(); // Exit the current script
?>
