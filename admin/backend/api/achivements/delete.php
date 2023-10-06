<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/achivement.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $achivement = $_GET["delete_id"];
    $result = deleteAchivement($achivement);
    if ($result) {
        header("Location: /pages/upcoming/?success=1");
    } else {
        header("Location: /pages/upcoming/?error=$result");
    }
}
