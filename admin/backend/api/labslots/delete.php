<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/labslots.php";
// Include the session details logger
include $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/log.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    hasClearence(0, function () {
        if (isset($_GET['delete_id'])) {
            $result = deleteLabSlot($_GET['delete_id']);
            if ($result === true) {
                logUserActivity("Deleted labslot with id: {$_GET['delete_id']}");
                header("Location: /pages/labslots/?success=successfully deleted lab slot");
            } else
                header("Location: /pages/labslots/?error=$result");
        }
    });
} else {
    header("Location: /pages/labslots/");
}
