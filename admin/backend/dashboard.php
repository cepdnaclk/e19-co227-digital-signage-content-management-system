<?php
include_once "../config.php";

// Function to get user details by ID
// function getUserDetails($userId)
// {
//     global $conn;
//     $stmt = $conn->prepare("SELECT user_name, email, contact FROM user WHERE u_id = ?");
//     $stmt->bind_param("i", $userId);
//     $stmt->execute();
//     $stmt->bind_result($userName, $email, $contact);
//     $stmt->fetch();

//     return array(
//         'userName' => $userName,
//         'email' => $email,
//         'contact' => $contact
//     );
// }

// Check if the user is logged in
session_start();
if (!isset($_SESSION["userId"])) {
    header("Location: login.php");
    exit();
}

// Get user details
$userId = $_SESSION["userId"];
$userDetails = getUserDetails($userId);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/dashboard.css">
    <title>Dashboard</title>
</head>
<body>
    <div class="container">
        <h1>Welcome, <?php echo $userDetails['userName']; ?>!</h1>
        <p>Email: <?php echo $userDetails['email']; ?></p>
        <p>Contact: <?php echo $userDetails['contact']; ?></p>
        <a href="logout.php">Logout</a>
    </div>
</body>
</html>
