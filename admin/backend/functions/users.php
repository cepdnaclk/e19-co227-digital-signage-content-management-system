<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php"; // Include your database connection
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/boards.php";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

function getUsers(int $board_id)
{
    global $conn;

    // Prepare the SQL query
    $stmt = $conn->prepare("SELECT u.u_id, u.user_name, u.email, u.contact FROM user u INNER JOIN clearence c ON u.u_id = c.user_id WHERE c.board_id = ? AND c.level = 0 ORDER BY u.user_name ASC");

    // bind params
    $stmt->bind_param('i', $board_id);

    // Execute the prepared statement
    $stmt->execute();

    // Get the result set
    $result = $stmt->get_result();

    // Fetch and return the data
    $users = array();
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }

    // Close the statement
    $stmt->close();

    return $users;
}

function getUser(int $user_id)
{
    global $conn;

    // Prepare the SQL query
    $stmt = $conn->prepare("SELECT * FROM user WHERE u_id = ?");

    // bind params
    $stmt->bind_param('i', $user_id);

    // Execute the prepared statement
    $stmt->execute();

    // Get the result set
    $result = $stmt->get_result();

    // Fetch and return the data
    $user = $result->fetch_assoc();

    // Close the statement
    $stmt->close();

    return $user;
}

function getme()
{
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM user WHERE u_id = ?");
    $stmt->bind_param('i', $_SESSION['u_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();

    return $user;
}


function addUser(string $username, string $email, string $contact, string $password, string $confirm_password)
{
    global $conn;

    // Check if the password and confirm password match
    if ($password !== $confirm_password) {
        echo "Password and Confirm Password do not match.";
        exit();
    }

    // Hash the password before storing it in the database
    $hashed_password = hash('sha256', $password);

    // Insert user data into the database
    $sql = "INSERT INTO `user` (`user_name`, `email`, `contact`, `password`) VALUES (?, COALESCE(?, ''), COALESCE(?, ''), ?)";
    $stmt = mysqli_prepare($conn, $sql);

    // Bind parameters and execute the query
    mysqli_stmt_bind_param($stmt, "ssss", $username, $email, $contact, $hashed_password);
    if (mysqli_stmt_execute($stmt)) {
        return array("message" => "User Adding Success");
    } else {
        return array("error" => mysqli_error($conn));
    }
}

function editMe(string $email, string $contact)
{
    global $conn;

    $stmt = $conn->prepare("UPDATE user SET email = COALESCE(?, ''), contact = COALESCE(?, '') WHERE u_id = ?");
    $stmt->bind_param("ssi", $email, $contact, $_SESSION['u_id']);

    if (!$stmt->execute())
        return array("error" => $stmt->error);
    else
        return array("message" => "Update Succesfully");
}

function changePass(string $opass, string $npass, string $cpass)
{
    global $conn;

    if (!(isset($opass) && isset($npass) && isset($cpass)))
        return array("error" => "Bad Request");

    if ($npass != $cpass)
        return array("error" => "Password and Confirm Password must same");

    $oldPass = hash('sha256', $opass);
    $user = getUser($_SESSION['u_id']);
    if (isset($user['error']))
        return array("error" => "Unable to fetch user data");

    if ($user['password'] != $oldPass)
        return array("error" => "Please enter the correct password in current password");

    $npass = hash('sha256', $npass);

    $stmt = $conn->prepare("UPDATE user SET password = ? WHERE u_id = ?");
    $stmt->bind_param("si", $npass, $_SESSION['u_id']);

    if (!$stmt->execute())
        return array("error" => $stmt->error);
    else
        return array("message" => "Update Password Succesfully");
}

function deleteUser(int $userId)
{
    global $conn;

    $stmt = $conn->prepare("DELETE FROM user WHERE u_id = ?; DELETE FROM clearence WHERE user_id = ?;");

    $stmt->bind_param('ii', $userId, $userId);

    if ($stmt->execute()) {
        return array("message" => "Delete Succesfully");
    } else {
        return array("error" => $stmt->error);
    }
}

function assignUser(int $board_id, string $user_name)
{
    if (isOwnerBoard($board_id)) {
        global $conn;

        $stmt = $conn->prepare("SELECT u_id FROM user WHERE user_name = ?");
        $stmt->bind_param('s', $user_name);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();

        if ($user['u_id'] == null) {
            return array("error" => "User not found");
        }

        if ($user['u_id'] == $_SESSION['user_id']) {
            return array("error" => "You can't assign yourself to the board");
        }

        $stmt = $conn->prepare("INSERT INTO clearence (user_id, board_id, `level`) VALUES (?, ?, 0)");
        $stmt->bind_param('ii', $user['u_id'], $board_id);
        if ($stmt->execute()) {
            return array("message" => "User assigned to board");
        } else {
            return array("error" => $stmt->error);
        }
    }
    return array("error" => "You are not the owner of this board");
}

function kickUser(int $board_id, string $user_name)
{
    if (isOwnerBoard($board_id)) {
        global $conn;

        $stmt = $conn->prepare("SELECT u_id FROM user WHERE user_name = ?");
        $stmt->bind_param('s', $user_name);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();

        if (!isset($user['u_id'])) {
            return array("error" => "User not found");
        }

        $stmt = $conn->prepare("DELETE FROM clearence WHERE user_id = ? AND board_id = ?");
        $stmt->bind_param('ii', $user['u_id'], $board_id);
        if ($stmt->execute()) {
            return array("message" => "User kicked from board");
        } else {
            return array("error" => $stmt->error);
        }
    }
    return array("error" => "You are not the owner of this board");
}
