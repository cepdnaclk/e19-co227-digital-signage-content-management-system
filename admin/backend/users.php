<?php
include_once "../config.php"; // Include your database connection

$users = array(); // Initialize an empty array to store user data

// Fetch user names for each role from the database
$query = "SELECT clearense, GROUP_CONCAT(user_name) AS usernames FROM user GROUP BY clearense";
$result = mysqli_query($conn, $query);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $users[$row['clearense']] = explode(',', $row['usernames']);
    }

    // Convert the user data to JSON format
    echo json_encode($users);
} else {
    // Handle any database query errors here
    echo json_encode(array('error' => 'Database query failed.'));
}
?>
