<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/boards.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo print_r($_POST);
    echo print_r($_FILES);
    $boardName = $_POST['boardName'];
    $orgname = $_POST['orgname'];
    $colorPrimary = $_POST['color-primary'];
    $colorSecondary = $_POST['color-secondary'];
    $logofile = $_FILES['logofile'];
    $bgfile = $_FILES['bgfile'];
    $logoname = $logofile['name'];
    $bgname = $bgfile['name'];
    $logopath =  "/images/" . $logoname;
    $bgpath = "/images/" . $bgname;
    move_uploaded_file($logofile['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . $logopath);
    move_uploaded_file($bgfile['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . $bgpath);

    $theme = json_encode([
        'logo' => $logopath,
        'orgname' => $orgname,
        'bg' => $bgpath,
        'colorPrimary' => $colorPrimary,
        'colorSecondary' => $colorSecondary
    ]);

    $result = createBoard($boardName, $theme);
    if ($result) {
        header('Location: /?success=' . $result['message']);
    } else {
        header('Location: /?error=' . $result['error']);
    }
}
