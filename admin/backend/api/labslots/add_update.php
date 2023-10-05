<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/labslots.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['update_id'] == '') {
        $result = addLabSlot($_POST['lab'], $_POST['course'], $_POST['stime'], $_POST['etime'], $_POST['date'], $_POST['isoneday'], $_POST['oneday']);
        if ($result === true)
            header("Location: /pages/labslots.php?success=1");
        else
            header("Location: /pages/addnewlabslot.php?error=$result&lab={$_POST['lab']}");
    } else {
        $result = editLabSlot($_POST['updateid'], $_POST['course'], $_POST['stime'], $_POST['etime'], $_POST['date'], $_POST['isoneday'], $_POST['oneday']);
        if ($result === true)
            header("Location: /pages/labslots.php?success=2");
        else
            header("Location: /pages/addnewlabslot.php?error=$result&lab={$_POST['lab']}");
    }
} else {
    header("Location: /pages/labslots.php");
}
