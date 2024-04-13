<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once $_SERVER['DOCUMENT_ROOT'] . '/backend/functions/boards.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/backend/functions/topic.php';

function isAdminSlide($slide_no)
{
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM slides WHERE slide_id = ? AND topic IN (SELECT topic_id FROM topics WHERE board_id IN (SELECT board_id FROM clearence WHERE user_id = ?))");
    $stmt->bind_param('ii', $slide_no, $_SESSION['user_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();

    if ($row) {
        return true;
    } else {
        return false;
    }
}

function getSlides($topic)
{
    global $conn;

    $slides = array();

    $result = $conn->query("SELECT slides.* FROM topics JOIN content ON topics.Id = content.topic WHERE topics.topic = '$topic'");

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

function addSlide(int $topic_id, string $image, string $from_date, string $to_date, bool $published)
{
    if (isAdminTopic($topic_id)) {
        global $conn;

        $stmt = $conn->prepare("INSERT INTO slides (topic, image, from_date, to_date, published) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param('isssi', $topic_id, $image, $from_date, $to_date, $published);
        $stmt->execute();
        $stmt->close();

        return array("message" => "Slide added successfully");
    } else {
        return array("error" => "You are not admin of this board");
    }
}

function removeSlide(int $slide_id)
{
    if (isAdminSlide($slide_id)) {
        global $conn;

        $stmt = $conn->prepare("DELETE FROM slides WHERE slide_id = ?");
        $stmt->bind_param('i', $slide_id);
        $stmt->execute();
        $stmt->close();

        return array("message" => "Slide removed successfully");
    } else {
        return array("error" => "You are not admin of this board");
    }
}

function updateSlide(int $slide_id, string $image, string $from_date, string $to_date, bool $published)
{
    if (isAdminSlide($slide_id)) {
        global $conn;

        $stmt = $conn->prepare("UPDATE slides SET image = ?, from_date = ?, to_date = ?, published = ? WHERE slide_id = ?");
        $stmt->bind_param('sssii', $image, $from_date, $to_date, $published, $slide_id);
        $stmt->execute();
        $stmt->close();

        return array("message" => "Slide updated successfully");
    } else {
        return array("error" => "You are not admin of this board");
    }
}

function publishSlide(int $slide_id)
{
    if (isAdminSlide($slide_id)) {
        global $conn;

        $stmt = $conn->prepare("UPDATE slides SET published = 1 WHERE slide_id = ?");
        $stmt->bind_param('i', $slide_id);
        $stmt->execute();
        $stmt->close();

        return array("message" => "Slide published successfully");
    } else {
        return array("error" => "You are not admin of this board");
    }
}

function getSlidesImages()
{
    global $conn;

    $slides = array();

    $result = $conn->query("SELECT image FROM slides");

    while ($row = $result->fetch_assoc()) {
        $slides[] = $row;
    }

    return $slides;
}