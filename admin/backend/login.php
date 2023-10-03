<?php
header("Access-Control-Allow-Origin: *");
// Allow specific HTTP methods (e.g., GET, POST, OPTIONS)
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
// Allow specific HTTP headers in requests
header("Access-Control-Allow-Headers: Content-Type");

session_start();

include_once "../config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["uname"]) && isset($_POST["password"])) {
    $username = $_POST["uname"];
    $password = $_POST["password"];

    
    // Assuming that the stored passwords are hashed.
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT u_id, user_name, password FROM user WHERE user_name = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($user_id, $user_name, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            // Authentication successful
            $_SESSION["user_id"] = $user_id;
            $_SESSION["user_name"] = $user_name;
            header("Location: ../pages/dashboard.php"); // Redirect to the dashboard 
            exit();
        }
    }

    // Authentication failed
    header("Location: ../pages/login.php?error=1");
    echo "Failed";
    exit();
} else {
    // Redirect to the login page if accessed directly without a POST request
    header("Location: ../pages/login.php");
    exit();
}
?>
