<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/users.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $result = changePass($_POST['old_password'], $_POST['password'], $_POST['confirm_password'], $_POST['u_id']);
    if (isset($result['error'])) {
        header("Location: /pages/users/?error={$result['error']}");
    } else
        header("Location: /pages/users/?success={$result['message']}");
}
