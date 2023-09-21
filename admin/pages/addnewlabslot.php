<?php include_once "../config.php" ?>
<?php include_once "../helpers/datetime.php" ?>
<?php include_once "../backend/labslots.php" ?>

<?php

$today = date("Y/m/d");
$dates = getWeekDates($today);

function getLab(string $lab)
{
    $labName = '';
    switch ($lab) {
        case 'lab1':
            $labName = "Lab 1";
            break;

        case 'lab2':
            $labName = "Lab 2";
            break;

        case 'ccna':
            $labName = "CCNA lab";
            break;

        case 'sr':
            $labName = "Seminar Room";
            break;

        default:
            break;
    }

    return $labName;
}

$labslots = getLabSlots($_GET['lab'], $dates[0], $dates[6]);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/addlabslot.css">
    <title>IT Center | Lab Allocations</title>
</head>

<body>
    <div class="flex-box">
        <div class="left">
            <?php
            include_once(APP_ROOT . "/includes/sidebar.php");
            sidebar(4);
            ?>
        </div>
        <div class="right">
            <?php
            include_once(APP_ROOT . "/includes/header.php");
            ?>
            <main class="addlabslots">
                <div class="container">
                    <div class="title">
                        <div>
                            <h1><a href="/pages/labslots.php">Lab Allocation ></a>Add a Lab slot : <?= isset($_GET['lab']) ? getLab($_GET['lab']) : '' ?></h1>
                            <p>Create a labslot for a course</p>
                        </div>
                    </div>
                    <div class="options">
                        <div class="option">
                            <select name="" id="">
                                <option value="">Select the Course</option>
                                <option value="">CCNA</option>
                                <option value="">IT01</option>
                                <option value="">IT03</option>
                            </select>
                        </div>
                        <div class="option">
                            <label for="stime">Select the Start time : </label>
                            <input type="time" name="" id="stime" placeholder="">
                        </div>
                        <div class="option">
                            <label for="stime">Select the End time : </label>
                            <input type="time" name="" id="stime" placeholder="">
                        </div>
                        <div class="option">
                            <label for="date">select date </label>
                            <select name="" id="date">
                                <option value="">Monday</option>
                                <option value="">Tuesday</option>
                                <option value="">Wednesday</option>
                                <option value="">Thursday</option>
                                <option value="">Friday</option>
                                <option value="">Saturday</option>
                                <option value="">Sunday</option>
                            </select>
                        </div>
                        <div class="option">
                            <label for="stime">Only this day </label>
                            <input type="checkbox" name="" id="stime" placeholder="">
                            <input type="date" name="" id="stime" placeholder="">
                        </div>
                        <button class="add">CREATE SLOT</button>
                    </div>
                    <div class="timetable">
                        <div class="time">
                            <div class="time-caption">
                                <h3>Time</h3>
                            </div>
                            <?php
                            $startTime = new DateTime("08.00");
                            $endTime = new DateTime("17.00");

                            while ($startTime < $endTime) {
                            ?>
                                <div class="time-slot">
                                    <p><?= $startTime->format('h:i') . " - " . $startTime->modify("+1 hour")->format('h:i') ?></p>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                        <?php foreach ($dates as $index => $date) { ?>
                            <div class="day">
                                <div class="date">
                                    <?php
                                    $day = new DateTime($date);
                                    ?>
                                    <p><?= $day->format('l') ?></p>
                                    <h3><?= $day->format("Y/m/d") ?></h3>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="/js/labslot.js"></script>
    <script>
        <?php
        foreach ($labslots as $key => $labslot) {
            echo "labslot( 'labslot$key', {$labslot['date']}, '{$labslot['start']}', '{$labslot['end']}', '{$labslot['course']}');";
        }
        ?>
    </script>
</body>

</html>