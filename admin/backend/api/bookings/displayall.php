<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/bookings.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/facilities.php";
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    hasClearence(1, function () {
        // Get form data
        $f_id = $_GET["f_id"];
        $result = displayall($f_id);

        if (isset($result['error'])) {
            header("Location: /pages/bookings/?error={$result['error']}");
        } else { ?>

           
            
            <!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <!-- <link rel="stylesheet" href="/css/bookings.css"> -->
                <title>IT Center | Bookings</title>
            </head>

            <body>
                
                <div class="flex-box">
                    <div class="left">
                        <?php
                        include_once(APP_ROOT . "/includes/sidebar.php");
                        sidebar(6,0);
                        ?>
                    </div>
                    <div class="right">
                        <?php
                        //include_once(APP_ROOT . "/includes/header.php");
                        ?>
                        <main class="labslots">
                            <div class="container">
                                <h1>All Bookings</h1>
                                

                    
                                <div class="title">
                                    <div class="title">
                                        <h2></h2>
                                    
                                    </div>
                                </div>
                                <table class="bookings-table">
                                    
                                        <tr>
                                            <th>f_id</th>
                                            <th>b_date</th>
                                            <th>b_timeslot</th>
                                            <th>b_for</th>
                                            <th>b_contact</th>
                                           
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    
                                    <tbody>
                                        hhhhh
                                    <?php 
                                    
                                    if (is_array($result)) {
                                        
                                        foreach ($result as $row) {
                                            ?>
                                            
                                                    <tr>
                                                        
                                                        
                                                        <td><?= $row["f_id"] ?></td>
                                                        <td><?= $row["b_date"] ?></td>
                                                        <td><?= $row["b_timeslot"] ?></td>
                                                        <td><?= $row["b_seats"] ?></td>
                                                        <td><?= $row["b_for"] ?></td>
                                                        
                                                        <td><a href="add.php?id=<?= $row['f_id'] ?>&lab=lab1" role="button">Edit</a></td>
                                                        <td><a href="/backend/api/labslots/delete.php?delete_id=<?= $row['f_id'] ?>" role="button">Delete</a></td>
                                                    </tr>
                                            <?php
                                                }
                                            }
                                            ?>

                                    
                                    </tbody>
                                </table>
                            </div>
                        </main>
                    </div>
                </div>
            </body>



            </html>
            
        <?php }
    });
    exit();
} ?>

