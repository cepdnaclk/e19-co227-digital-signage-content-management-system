<?php
include_once "../config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the form fields are set and not empty
    if (
        isset($_POST["user_role"]) &&
        isset($_POST["username"]) &&
        isset($_POST["email"]) &&
        isset($_POST["password"]) &&
        isset($_POST["confirm_password"])
    ) {
        // Get form data
        $user_role = $_POST["user_role"];
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $confirm_password = $_POST["confirm_password"];

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
        $sql = "INSERT INTO `user` (`user_name`, `email`, `password`, `clearense`) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);

        // Bind parameters and execute the query
        mysqli_stmt_bind_param($stmt, "ssss", $username, $email, $hashed_password, $user_role);
        if (mysqli_stmt_execute($stmt)) {
            // Registration successful, you can redirect the user to a success page
            // For example:
            header("Location: /pages/login.php");
            exit();
        } else {
            echo "Error registering the user.";
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        echo "All required fields must be filled.";
    }
}
?>
