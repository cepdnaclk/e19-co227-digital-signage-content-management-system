<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/course.php";
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" || "PUT") {
    // Get form data
    $c_id = $_POST["c_id"];
    $file = $_FILES["poster"];
    $file_path = $_POST["poster_path"];

    $result = editPoster($c_id, $poster, $poster_path);

    if (isset($result['error']))
        header("Location: /pages/course/?error={$result['error']}");
    else
        header("Location: /pages/course/?success={$result['message']}");
}
