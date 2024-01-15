<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/maps.php";
// Include the session details logger
include $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/log.php";


if ($_SERVER["REQUEST_METHOD"] == "GET") {
    hasClearence(1, function () {
        $m_id = $_GET["delete_id"];
        $result = deleteMap($m_id);
        if ($result) {
            logUserActivity("Deleted map with id: $m_id");
            header("Location: /pages/maps/?success=successfully deleted the map");

        } else {
            header("Location: /pages/maps/?error=$result");
        }
    });
}
