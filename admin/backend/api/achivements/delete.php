<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/achivements.php";
// Include the session details logger
include $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/log.php";


if ($_SERVER["REQUEST_METHOD"] == "GET") {
    hasClearence(1, function () {
        $achivement = $_GET["delete_id"];
        $result = deleteAchivement($achivement);
        if ($result) {
            logUserActivity("deleted achivement with id: $achivement");
            header("Location: /pages/achievements/?success=successfully deleted the achievement");
        } else {
            header("Location: /pages/achievements/?error=$result");
        }
    });
}
