<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/boards.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $boardName = $_POST['boardName'];
    $orgname = $_POST['orgname'];
    $colorPrimary = $_POST['color-primary'];
    $colorSecondary = $_POST['color-secondary'];
    $logofile = $_FILES['logofile'];
    $bgfile = $_FILES['bgfile'];
    $logoname = $logofile['name'];
    $bgname = $bgfile['name'];
    $logopath = $_SERVER['DOCUMENT_ROOT'] . "/images/" . $logoname;
    $bgpath = $_SERVER['DOCUMENT_ROOT'] . "/images/" . $bgname;
    move_uploaded_file($logofile['tmp_name'], $logopath);
    move_uploaded_file($bgfile['tmp_name'], $bgpath);

    $theme = json_encode([
        'logo' => $logoname,
        'orgname' => $orgname,
        'bg' => $bgname,
        'colorPrimary' => $colorPrimary,
        'colorSecondary' => $colorSecondary
    ]);

    $result = createBoard();
}
