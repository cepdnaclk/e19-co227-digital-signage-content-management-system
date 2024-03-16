<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";

function getSlides($topic)
{
    global $conn;

    $slides = array();

    $result = $conn->query("SELECT content.* FROM topics JOIN content ON topics.Id = content.topic WHERE topics.topic = '$topic'");

    while ($row = $result->fetch_assoc()) {
        $slides[] = $row;
    }

    return $slides;
}

function getSlidePublished($topic)
{
    $slides = getSlides($topic);
    $publishedSlides = array();

    foreach ($slides as $slide) {
        if ($slide['published'] == 1) {
            if ($slide['from_date'] != null && $slide['to_date'] != null) {
                $from = strtotime($slide['from_date']);
                $to = strtotime($slide['to_date']);
                $now = strtotime(date("Y-m-d H:i:s"));

                if ($now >= $from && $now <= $to) {
                    $publishedSlides[] = $slide;
                }
            } else {
                $publishedSlides[] = $slide;
            }
        }
    }

    return $publishedSlides;
}

function getSlideCount($topic)
{
    $slides = getSlides($topic);
    return count($slides);
}

function getSlideCountPublished($topic)
{
    $slides = getSlidePublished($topic);
    return count($slides);
}