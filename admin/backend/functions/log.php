<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";




// Function to log user activity
function logUserActivity($action)
{
    $logFilePath = $_SERVER['DOCUMENT_ROOT'] . '/logs/user_activity.log';

    $user_id = $_SESSION["user_id"]; // get user_id in the session
    $user_name =$_SESSION["user_name"]; // get user_name in the session
    $clearence=$_SESSION["clearense"];  // get user role in the session
    // Get current timestamp
    $timestamp = date('Y-m-d H:i:s');

    // Get user's IP address
    $ipAddress = $_SERVER['REMOTE_ADDR'];

    // Log user activity
    $logEntry = "$timestamp - User $user_id, $user_name, $clearence ($ipAddress): $action\n";

    file_put_contents($logFilePath, $logEntry, FILE_APPEND);
}
?>