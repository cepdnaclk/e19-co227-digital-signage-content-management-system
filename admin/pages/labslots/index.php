<?php include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php" ?>
<?php include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/labslots.php" ?>
<?php include_once $_SERVER['DOCUMENT_ROOT'] . "/helpers/datetime.php" ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/labslots.css">
    <title>IT Center | Lab Allocations</title>
</head>

<?php

$labslots = getLabSlotsAll();

?>

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
            <main class="labslots">
                <div class="container">
                    <h1>Lab Allocations</h1>
                    <p>Currently preserved labs and labs available for booking</p>

                    <!-- Lab 1 Table -->
                    <div class="title">
                        <div class="title">
                            <h2>Lab 1</h2>
                            <a href="add.php?lab=lab1"><img src="/images/Add_round.svg" alt=""> Add a slot</a>
                        </div>
                    </div>
                    <table class="lab-table">
                        <thead>
                            <tr>
                                <th>Course-offering</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Lab Day</th>
                                <th>Lab Time Slot</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (isset($labslots['lab1'])) { ?>
                                <?php foreach ($labslots['lab1'] as $key => $slot) { ?>
                                    <tr>
                                        <td><?= $slot['course'] ?></td>
                                        <td><?= $slot['course'] ?></td>
                                        <td><?= $slot['course'] ?></td>
                                        <td><?= getDatebyIndex($slot['date']) ?></td>
                                        <td><?= substr($slot['start'], 0, 5) . ' - ' . substr($slot['end'], 0, 5) ?></td>
                                        <td><a href="add.php?id=<?= $slot['slot_id'] ?>&lab=lab1" role="button">Edit</a> </td>
                                        <td><a href="/backend/api/labslots/delete.php?delete_id=<?= $slot['slot_id'] ?>" role="button">Delete</a> </td>
                                    </tr>
                                <?php }; ?>
                            <?php } ?>
                            <!-- Add more rows as needed -->
                        </tbody>
                    </table>

                    <!-- Lab 2 Table -->
                    <div class="title">
                        <div class="title">
                            <h2>Lab 2</h2>
                            <a href="add.php?lab=lab2"><img src="/images/Add_round.svg" alt=""> Add a slot</a>
                        </div>
                    </div>
                    <table class="lab-table">
                        <thead>
                            <tr>
                                <th>Course-offering</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Lab Day</th>
                                <th>Lab Time Slot</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (isset($labslots['lab2'])) { ?>
                                <?php foreach ($labslots['lab2'] as $key => $slot) { ?>
                                    <tr>
                                        <td><?= $slot['course'] ?></td>
                                        <td><?= $slot['course'] ?></td>
                                        <td><?= $slot['course'] ?></td>
                                        <td><?= getDatebyIndex($slot['date']) ?></td>
                                        <td><?= substr($slot['start'], 0, 5) . ' - ' . substr($slot['end'], 0, 5) ?></td>
                                        <td><a href="add.php?id=<?= $slot['slot_id'] ?>&lab=lab2">Edit</a> </td>
                                        <td><a href="/backend/api/labslots/delete.php?delete_id=<?= $slot['slot_id'] ?>" role="button">Delete</a> </td>
                                    </tr>
                                <?php }; ?>
                            <?php } ?>
                            <!-- Add more rows as needed -->
                        </tbody>
                    </table>

                    <!-- CCNA Lab Table -->
                    <div class="title">
                        <div class="title">
                            <h2>CCNA Lab</h2>
                            <a href="add.php?lab=ccna"><img src="/images/Add_round.svg" alt=""> Add a slot</a>
                        </div>
                    </div>
                    <table class="lab-table">
                        <thead>
                            <tr>
                                <th>Course-offering</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Lab Day</th>
                                <th>Lab Time Slot</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (isset($labslots['ccna'])) { ?>
                                <?php foreach ($labslots['ccna'] as $key => $slot) { ?>
                                    <tr>
                                        <td><?= $slot['course'] ?></td>
                                        <td><?= $slot['course'] ?></td>
                                        <td><?= $slot['course'] ?></td>
                                        <td><?= getDatebyIndex($slot['date']) ?></td>
                                        <td><?= substr($slot['start'], 0, 5) . ' - ' . substr($slot['end'], 0, 5) ?></td>
                                        <td><a href="add.php?id=<?= $slot['slot_id'] ?>&lab=ccna">Edit</a> </td>
                                        <td><a href="/backend/api/labslots/delete.php?delete_id=<?= $slot['slot_id'] ?>" role="button">Delete</a> </td>
                                    </tr>
                                <?php }; ?>
                            <?php } ?>
                            <!-- Add more rows as needed -->
                        </tbody>
                    </table>

                    <!-- Seminar Room Table -->
                    <div class="title">
                        <div class="title">
                            <h2>Seminar Room</h2>
                            <a href="add.php?lab=sr"><img src="/images/Add_round.svg" alt=""> Add a slot</a>
                        </div>
                    </div>
                    <table class="lab-table">
                        <thead>
                            <tr>
                                <th>Course-offering</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Lab Day</th>
                                <th>Lab Time Slot</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (isset($labslots['sr'])) { ?>
                                <?php foreach ($labslots['sr'] as $key => $slot) { ?>
                                    <tr>
                                        <td><?= $slot['course'] ?></td>
                                        <td><?= $slot['course'] ?></td>
                                        <td><?= $slot['course'] ?></td>
                                        <td><?= getDatebyIndex($slot['date']) ?></td>
                                        <td><?= substr($slot['start'], 0, 5) . ' - ' . substr($slot['end'], 0, 5) ?></td>
                                        <td><a href="add.php?id=<?= $slot['slot_id'] ?>&lab=sr">Edit</a> </td>
                                        <td><a href="/backend/api/labslots/delete.php?delete_id=<?= $slot['slot_id'] ?>" role="button">Delete</a> </td>
                                    </tr>
                                <?php }; ?>
                            <?php } ?>
                            <!-- Add more rows as needed -->
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>
</body>

</html>