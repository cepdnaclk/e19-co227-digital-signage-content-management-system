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
    if ($logofile = $_FILES['logofile'])
        header('Location: /?error=No logo file selected');
    $bgfile = $_FILES['bgfile'];

    if (isset($bgfile) && $bgfile['size'] != 0) {
        $bgname = $bgfile['name'];
        $bgpath = "/images/backgrounds/" . $bgname;
        if (move_uploaded_file($bgfile['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . $bgpath))
            header('Location: /?error=Error uploading background file');
    }

    $logoname = $logofile['name'];
    $logopath =  "/images/logos/" . $logoname;
    if (move_uploaded_file($logofile['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . $logopath))
        header('Location: /?error=Error uploading logo file');

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
