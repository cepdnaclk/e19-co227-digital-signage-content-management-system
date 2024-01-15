<?php
// get-log.php
$logFile = $_SERVER['DOCUMENT_ROOT'] . "\logs\user_activity.log";

function readLastLines($file, $lines)
{
    $content = file($file);
    $start = max(0, count($content) - $lines);
    $output = array_slice($content, $start);
    $reversedOutput = array_reverse($output); // Reverse the array
    return implode("<br>", $reversedOutput);
}

echo readLastLines($logFile, 10);
?>