<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/timing.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/topic.php";

function getSummery()
{
    $timings = getTimes();
    $topics = getTopics();

    $summery = array();
    $totalTime = 0;
    $toalSlideCount = 0;
    $totalSlideCountPublished = 0;

    foreach ($topics as $topic) {
        if ($topic['Id'] > 2) {
            $slideCount = getSlideCount($topic['topic']);
            $slideCountPublished = getSlideCountPublished($topic['topic']);
            $toalSlideCount += $slideCount;
            $totalSlideCountPublished += $slideCountPublished;
        }
    }

    foreach ($timings as $timing) {
        $totalTime += $timing['per_page'];
    }

    $summery['totalTime'] = $totalTime;
    $summery['totalSlideCount'] = $toalSlideCount;
    $summery['totalSlideCountPublished'] = $totalSlideCountPublished;

    return $summery;
}
