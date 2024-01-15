<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/labslots.php";
// Include the session details logger
include $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/log.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    hasClearence(0, function () {
        if ($_POST['update_id'] == '') {
            $result = addLabSlot($_POST['lab'], $_POST['course'], $_POST['stime'], $_POST['etime'], $_POST['date'], $_POST['isoneday'], $_POST['oneday']);
            if ($result === true) {
                logUserActivity("Added labslot for lab: {$_POST['lab']}");
                header("Location: /pages/labslots/?success=successfully added lab slot");
            } else
                header("Location: /pages/labslots/add.php?error=$result&lab={$_POST['lab']}");
        } else {
            $result = editLabSlot($_POST['update_id'], $_POST['course'], $_POST['stime'], $_POST['etime'], $_POST['date'], $_POST['isoneday'], $_POST['oneday']);
            if ($result === true) {
                logUserActivity("Edited labslot with id: {$_POST['update_id']}");
                header("Location: /pages/labslots/?success=successfully edited lab slot");
            } else
                header("Location: /pages/labslots/add.php?error=$result&lab={$_POST['lab']}");
        }
    });
} else {
    header("Location: /pages/labslots.php");
}
