<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

const APP_ROOT = __DIR__;

// Database Configuration
const DB_HOST = 'localhost';
// const DB_USER = 'cms';
// const DB_PASSWORD = 'cms@database';
const DB_USER = 'root';
const DB_PASSWORD = 'root';
const DB_NAME = 'cmsdb';

// Create a database connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set the character set to UTF-8 (if needed)
$conn->set_charset("utf8");

$clearenceStatus = [
    'super_admin' => 2,
    'admin' => 1,
    'course_c' => 0
];

function hasClearence(int $level, $callback, $customHeader = null)
{
    global $clearenceStatus;

    if ($clearenceStatus[$_SESSION['clearense']] >= $level)
        $callback();
    else {
        if (isset($customHeader)) {
            header($customHeader);
        } else {
            header("/?error='You're not Authorized for that action'");
        }
    }
}
