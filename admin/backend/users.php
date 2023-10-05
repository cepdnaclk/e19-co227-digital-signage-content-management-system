<?php
include_once "../config.php"; // Include your database connection

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
