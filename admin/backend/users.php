<?php
include_once "../config.php"; // Include your database connection
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

function getUsers()
{
    global $conn;

    // Prepare the SQL query
    $stmt = $conn->prepare("SELECT clearense, u_id, user_name FROM user");

    // Execute the prepared statement
    $stmt->execute();

    // Get the result set
    $result = $stmt->get_result();

    // Fetch and return the data
    $users = array();
    while ($row = $result->fetch_assoc()) {
        $clearence = $row['clearense'];

        if (!isset($users[$clearence])) {
            $users[$clearence] = array();
        }

        $users[$clearence][] = $row;
    }

    // Close the statement
    $stmt->close();

    return $users;
}


function getUser(int $userId)
{
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM user WHERE u_id = ?");
    $stmt->bind_param("i", $userId);

    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    if (!isset($user))
        return false;

    $stmt->close();

    return $user;
}


function deleteUser(int $userId)
{
    global $conn;

    $stmt = $conn->prepare("DELETE FROM user WHERE u_id = ?");

    $stmt->bind_param('i', $userId);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['delete'])) {
        $user = getUser($_GET['delete']);
        if ($user == false) {
            header('Location: /pages/users.php');
            exit();
        }
        if ($clearenceStatus[$user['clearense']] < $clearenceStatus[$_SESSION['clearense']]) {
            if (deleteUser($_GET['delete'])) {
                header('Location: /pages/users.php?success=1');
            } else {
                header('Location: /pages/users.php?error=1');
            }
        }
    }
}
