<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/achivements.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    hasClearence(1, function () {
        $achivement = $_GET["delete_id"];
        $result = deleteAchivement($achivement);
        if ($result) {
            header("Location: /pages/achievements/?success=successfully deleted the achievement");
        } else {
            header("Location: /pages/achievements/?error=$result");
        }
    });
}
