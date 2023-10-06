<<?php
include_once "../config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    // Insert data into the database
    $sql = "INSERT INTO contactsupport (name, email, message) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $name, $email, $message);

    if ($stmt->execute()) {
        // Data inserted successfully
        header("Location: /pages/contactNsupport.php?success=1");
        exit;
    } else {
        // Error occurred while inserting data
        header("Location: contactNsupport.php?error=1");
        exit;
    }
} else {
    // Redirect to the contactNsupport.php page if the form was not submitted
    header("Location: contactNsupport.php");
    exit;
}
?>
