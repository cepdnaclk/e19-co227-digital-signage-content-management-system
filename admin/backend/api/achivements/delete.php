<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/achivements.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $achivement = $_GET["delete_id"];
    $result = deleteAchivement($achivement);
    if ($result) {
        header("Location: /pages/achievements/?success=1");
    } else {
        header("Location: /pages/achievements/?error=$result");
    }
}
