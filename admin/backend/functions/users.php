<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php"; // Include your database connection
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
        return array("error" => $stmt->error);

    $stmt->close();

    return $user;
}


function editUser(int $u_id, string $email, string $contact)
{
    if (!isset($u_id))
        return array("error" => "Bad Request");

    global $conn;

    $stmt = $conn->prepare("UPDATE user SET email = COALESCE(?, ''), contact = COALESCE(?, '') WHERE u_id = ?");
    $stmt->bind_param("ssi", $email, $contact, $u_id);

    if (!$stmt->execute())
        return array("error" => $stmt->error);
    else
        return array("message" => "Update Succesfully");

    $stmt->close();
}

function changePass(string $opass, string $npass, string $cpass, int $u_id)
{
    global $conn;

    if (!isset($u_id) || !(isset($opass) && isset($npass) && isset($cpass)))
        return array("error" => "Bad Request");

    if ($npass != $cpass)
        return array("error" => "Password and Confirm Password must same");

    $oldPass = hash('sha256', $opass);
    $user = getUser($u_id);
    if (isset($user['error']))
        return array("error" => "Unable to fetch user data");

    if ($user['password'] != $oldPass)
        return array("error" => "Please enter the correct password in current password");

    $npass = hash('sha256', $npass);

    $stmt = $conn->prepare("UPDATE user SET password = ? WHERE u_id = ?");
    $stmt->bind_param("si", $npass, $u_id);

    if (!$stmt->execute())
        return array("error" => $stmt->error);
    else
        return array("message" => "Update Password Succesfully");

    $stmt->close();
}

function deleteUser(int $userId)
{
    global $conn;

    $stmt = $conn->prepare("DELETE FROM user WHERE u_id = ?");

    $stmt->bind_param('i', $userId);

    if ($stmt->execute()) {
        return array("message" => "Delete Succesfully");
    } else {
        return array("error" => $stmt->error);
    }
}
