<?php
// Start the session
session_start();

// Destroy all session data
session_destroy();

// Redirect the user to the login page or any other page you prefer
header("Location: /pages/login.php"); 
exit();
?>
