<?php
include_once "../config.php";

header("Access-Control-Allow-Origin: *");
// Allow specific HTTP methods (e.g., GET, POST, OPTIONS)
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
// Allow specific HTTP headers in requests
header("Access-Control-Allow-Headers: Content-Type");

session_start();

if (isset($_POST["login"])) {
    $user_name = $_POST["user_name"];
    $password = $_POST["password"];
    echo "Username: $user_name<br>";
    echo "Password: $password<br>";

    // create prepared statement
    $stmt = $conn->prepare("SELECT * FROM `user` WHERE `user_name`=? AND `password`=?");
    
    // Bind the parameters and execute
    $stmt->bind_param("ss", $user_name, $password);
    $stmt->execute();
    
    // Get the result
    $result = $stmt->get_result();
    
    // Fetch a row
    $row = $result->fetch_assoc();
    
    if ($row) {
        // Authentication successful
        // $_SESSION["user_id"] = 1; //set the user ID 
        $_SESSION["user_name"] = $row["user_name"];
        $_SESSION["password"] = $row["password"];
        header("Location: /");
        exit();
    } else {
        // Authentication failed
        header("Location: ../pages/login.php?error=1");
        exit();
    }
} else {
    // Redirect to the login page if accessed directly without a POST request
    header("Location: ../pages/login.php");
    exit();
}
?>
