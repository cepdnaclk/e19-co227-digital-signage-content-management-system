<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

const APP_ROOT = __DIR__;

// Database Configuration
const DB_HOST = 'localhost:3308';
// const DB_USER = 'cms';
// const DB_PASSWORD = 'cms@database';
const DB_USER = 'root';
const DB_PASSWORD = '';
const DB_NAME = 'cmsdb';

// Create a database connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set the character set to UTF-8 (if needed)
$conn->set_charset("utf8");

