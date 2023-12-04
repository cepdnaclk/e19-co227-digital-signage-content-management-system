<?php
// Start the session
session_start();

// Include the session details logger
include $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/log.php";
logUserActivity("logout");

// Destroy all session data
session_destroy();

// Redirect the user to the login page or any other page you prefer
header("Location: /pages/login.php"); 
exit();
?>
