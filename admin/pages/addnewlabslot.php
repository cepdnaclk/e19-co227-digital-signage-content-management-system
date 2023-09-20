<?php include_once "../config.php" ?>
<?php include_once "../helpers/datetime.php" ?>

<?php

$today = date("Y/m/d");
$dates = getWeekDates($today)

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
                            <h1><a href="">Lab Allocation ></a>Add a Lab slot</h1>
                            <p>Create a labslot for a course</p>
                        </div>
                    </div>
                    <div class="options">
                        <div class="option">
                            <select name="" id="">
                                <option value="">Select the lab</option>
                                <option value="">Lab 1</option>
                                <option value="">Lab 2</option>
                                <option value="">CCNA Lab</option>
                                <option value="">Seminar Room</option>
                            </select>
                        </div>
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
                            <label for="stime">Only this day </label>
                            <input type="checkbox" name="" id="stime" placeholder="">
                            <input type="date" name="" id="stime" placeholder="">
                        </div>
                        <button class="add">CREATE SLOT</button>
                    </div>
                    <div class="timetable">
                        <?php foreach ($dates as $index => $date) { ?>
                            <div class="day">
                                <div class="date">
                                    <?php
                                    $day = new DateTime($date);
                                    ?>
                                    <h3><?= $day->format('l') ?></h3>
                                    <p><?= $day->format("Y/m/d") ?></p>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>

</html>