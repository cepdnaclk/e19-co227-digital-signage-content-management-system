<?php
// Sample API endpoint
header("Content-Type: application/json");

$data = array(
    "message" => "Hello, this is a sample API endpoint!",
    "timestamp" => time()
);

echo json_encode($data);
