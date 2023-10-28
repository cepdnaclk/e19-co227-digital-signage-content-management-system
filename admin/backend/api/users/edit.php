<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/users.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_SESSION['user_id'] != $_POST['u_id']) {
        header("Location: /pages/users/?error='You are not authorize for this'");
        exit();
    }
    $result = editUser($_POST['u_id'], $_POST['email'], $_POST['contact']);
    if (isset($result['error'])) {
        header("Location: /pages/users/?error={$result['error']}");
    } else
        header("Location: /pages/users/?success={$result['message']}");
}
