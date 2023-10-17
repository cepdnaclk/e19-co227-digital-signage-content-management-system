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


function addUser(string $username, string $user_role, string $email, string $contact, string $password, string $confirm_password)
{
    global $conn;

    // Check if the password and confirm password match
    if ($password !== $confirm_password) {
        echo "Password and Confirm Password do not match.";
        exit();
    }

    // Hash the password before storing it in the database
    $hashed_password = hash('sha256', $password);


    // Additional fields for Course Coordinator
    $coordination_count = isset($_POST["coordination_count"]) ? $_POST["coordination_count"] : null;
    // You can process the course coordinator's course selection here

    // Add more fields as needed

    // Insert user data into the database
    $sql = "INSERT INTO `user` (`user_name`, `email`, `contact`, `password`, `clearense`) VALUES (?, COALESCE(?, ''), COALESCE(?, ''), ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    // Bind parameters and execute the query
    mysqli_stmt_bind_param($stmt, "sssss", $username, $email, $contact, $hashed_password, $user_role);
    if (mysqli_stmt_execute($stmt)) {
        return array("message" => "User Adding Success");
    } else {
        return array("error" => mysqli_error($conn));
    }

    // Close the statement
    mysqli_stmt_close($stmt);
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
