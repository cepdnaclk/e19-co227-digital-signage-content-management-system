<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/users.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $result = editUser($_POST['u_id'], $_POST['email'], $_POST['contact']);
    if (isset($result['error'])) {
        header("Location: /pages/users/?error={$result['error']}");
    } else
        header("Location: /pages/users/?success={$result['message']}");
}
