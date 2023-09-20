<?php
include_once "../config.php";

// Function to register a new user
function registerUser($userName, $email, $password)
{
    global $conn;
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO user (user_name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $userName, $email, $hashedPassword);
    
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

// Function to verify user login
// function loginUser($email, $password)
// {
//     global $conn;
//     $stmt = $conn->prepare("SELECT u_id, user_name, password FROM user WHERE email = ?");
//     $stmt->bind_param("s", $email);
//     $stmt->execute();
//     $stmt->store_result();
    
//     if ($stmt->num_rows == 1) {
//         $stmt->bind_result($userId, $userName, $hashedPassword);
//         $stmt->fetch();
        
//         if (password_verify($password, $hashedPassword)) {
//             session_start();
//             $_SESSION["userId"] = $userId;
//             $_SESSION["userName"] = $userName;
//             return true;
//         }
//     }
    
//     return false;
// }

// Function to check if the user is logged in
function isLoggedIn()
{
    return isset($_SESSION["userId"]);
}

// Function to log out the user
function logoutUser()
{
    session_start();
    session_unset();
    session_destroy();
}

// Handle user registration
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["register"])) {
    $userName = $_POST["userName"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    if (registerUser($userName, $email, $password)) {
        header("Location: login.php?success=1");
    } else {
        header("Location: register.php?error=1");
    }
}

// Handle user login
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    if (loginUser($email, $password)) {
        header("Location: dashboard.php");
    } else {
        header("Location: login.php?error=2");
    }
}

// Handle user logout
if (isset($_GET["logout"])) {
    logoutUser();
    header("Location: login.php");
}
?>
