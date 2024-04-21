<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/config.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/includes/header.php");
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/support.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/boards.php";


if (isset($data['error']))
    if (!isset($_GET['error']))
        header("Location: ?error={$data['error']}");

$support = getMessages();
if (isset($support['error']))
    if (!isset($_GET['error']))
        header("Location: ?error={$support['error']}");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/dashboard.css">
    <title>Admin Panel</title>
</head>

<body>
    <div class="container"></div>
</body>

</html>