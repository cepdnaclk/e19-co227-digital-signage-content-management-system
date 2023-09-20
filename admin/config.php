<?php
const APP_ROOT = __DIR__;

// Database Configuration
const DB_HOST = 'localhost'; // Replace with your actual database host 
const DB_USER = 'root'; // Replace with your actual database username
const DB_PASSWORD = ''; // Replace with your actual database password
const DB_NAME = 'cmsdb'; // Replace with your actual database name

// Create a database connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set the character set to UTF-8 (if needed)
$conn->set_charset("utf8");


?>
