<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header('Content-Type: application/json');

include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/labslots.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['date'])) {
        $index = getWeekIndex($_GET['date']);
        $result = getLabSlotsToday($index, $_GET['date']);

        echo json_encode($result);
    }
}
