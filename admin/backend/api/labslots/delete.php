<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/labslots.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['delete_id'])) {
        $result = deleteLabSlot($_GET['delete_id']);
        if ($result === true)
            header("Location: /pages/labslots/?success=successfully deleted lab slot");
        else
            header("Location: /pages/labslots/?error=$result");
    }
} else {
    header("Location: /pages/labslots/");
}
