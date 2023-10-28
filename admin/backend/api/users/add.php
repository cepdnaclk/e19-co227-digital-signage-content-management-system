<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/users.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    hasClearence(1, function () {
        global $clearenceStatus;

        // Check if the form fields are set and not empty
        if (
            isset($_POST["user_role"]) &&
            isset($_POST["username"]) &&
            isset($_POST["password"]) &&
            isset($_POST["confirm_password"])
        ) {
            if ($clearenceStatus[$_SESSION['clearence']] <= $clearenceStatus[$_POST["user_role"]])
                header("Location: /pages/users/adduser.php?error='You can't add this type of user'");

            // Get form data
            $user_role = $_POST["user_role"];
            $username = $_POST["username"];
            $email = $_POST["email"];
            $contact = $_POST["contact"];
            $password = $_POST["password"];
            $confirm_password = $_POST["confirm_password"];

            $result = addUser($username, $user_role, $email, $contact, $password, $confirm_password);
            if (isset($result['error'])) {
                header("Location: /pages/users/adduser.php?error={$result['error']}");
            } else
                header("Location: /pages/users/?success={$result['message']}");
        } else {
            header("Location: /pages/users/?error=Please fill all the required fields");
        }
    });
}
