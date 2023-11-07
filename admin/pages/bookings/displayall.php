<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/bookings.php";

if (isset($_GET['resultencoded'])) {
    // Decode the URL parameter
    $result_encoded = $_GET['resultencoded'];
    
    
    // Decode the JSON string to get the original data
    
    $resultarr = json_decode(urldecode($result_encoded), true);
    
//     echo (is_array($resultarr));
//     echo(isset($resultarr));
//     print_r($resultarr);
//     print_r($resultarr[0]['b_date']); //Debug
//     foreach ($resultarr as $row) {
//         print_r($row['b_date']);}

    
 }
?>

<!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="/css/displayall.css"> 
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
                        include_once(APP_ROOT . "/includes/header.php");
                        ?>
                        <main class="bookings">
                            <div class="container">
                                <h1>All Bookings</h1>
                               
                                    <div class="title">
                                        <h2></h2>
                                    
                                
                                </div>
                                <table class="bookings-table">
                                        <div class="table-headers">
                                        <tr>
                                            
                                            <th>Date</th>
                                            <th>Timeslot</th>
                                            <th>No of Seats</th>
                                            <th>Reserved For</th>
                                            <th>Contact No</th>
                                            <th>Added By</th>
                                           
                                        </tr>
                                        </div>
                                    
                                    <tbody>
                                
                                    <?php 
                                    
                                    if (isset($resultarr)) {
                                        
                                        foreach ($resultarr as $row) {
                                            
                                            ?>
                                                    <div class='card-content'>
                                                    <tr>
                                                    
                                                        
                                                        
                                                        <td><?= $row["b_date"] ?></td>
                                                        <td><?= $row["b_timeslot"] ?></td>
                                                        <td><?= $row["b_seats"] ?></td>
                                                        <td><?= $row["b_for"] ?></td>
                                                        <td><?= $row["b_contact"] ?></td>
                                                        <td><?= $row["b_by"] ?></td>
                                                        
                                                        <td><a href="editbooking.php?id=<?= $row['b_id'] ?>" class="btn btn-edit" >Edit</a></td>
                                                        <td><a href="/backend/api/bookings/delete.php?delete_id=<?= $row['b_id'] ?>" class="btn btn-delete" role="button">Delete</a></td>
                                                    </tr>
                                                    </div>
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