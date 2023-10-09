<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/achivements.php";

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $result = getAchivementDisplay();
    if (!isset($result['error'])) {
        echo json_encode($result);
    } else {
        http_response_code(400);
        echo json_encode($result);
    }
}
