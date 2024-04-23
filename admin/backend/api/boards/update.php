<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/boards.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $boardId = $_POST['board-id'];
    $boardName = $_POST['boardName'];
    $orgname = $_POST['orgname'];
    $oldlogofile = $_POST['oldlogofile'];
    $logofile = $_FILES['logofile'];
    $oldbgfile = $_POST['oldbgfile'];
    $bgfile = $_FILES['bgfile'];
    $colorPrimary = $_POST['color-primary'];
    $colorSecondary = $_POST['color-secondary'];

    if ($logofile['size'] > 0) {
        $logoname = $logofile['name'];
        $logopath =  "/images/logos/" . $logoname;
        if (unlink($_SERVER['DOCUMENT_ROOT'] . $oldlogofile))
            header('Location: /?error=Error deleting old logo file');
        if (move_uploaded_file($logofile['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . $logopath))
            header('Location: /?error=Error uploading logo file');
    } else {
        $logopath = $oldlogofile;
    }

    if ($bgfile['size'] > 0) {
        $bgname = $bgfile['name'];
        $bgpath = "/images/backgrounds/" . $bgname;
        if (unlink($_SERVER['DOCUMENT_ROOT'] . $oldbgfile))
            header('Location: /?error=Error deleting old background file');
        if (move_uploaded_file($bgfile['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . $bgpath))
            header('Location: /?error=Error uploading background file');
    } else {
        $bgpath = $oldbgfile;
    }

    $theme = json_encode([
        'logo' => $logopath,
        'orgname' => $orgname,
        'bg' => $bgpath,
        'colorPrimary' => $colorPrimary,
        'colorSecondary' => $colorSecondary
    ]);

    $result = manageBoard($boardName, $theme, $boardId);
    if ($result) {
        header('Location: /?success=' . $result['message']);
    } else {
        header('Location: /?error=' . $result['error']);
    }
}
