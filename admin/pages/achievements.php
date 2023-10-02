<?php include_once "../config.php" ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/achievements.css">
    <title>IT Center | Achievements</title>
</head>

<body>
    <div class="flex-box">
        <div class="left">
            <?php
            include_once(APP_ROOT . "/includes/sidebar.php");
            sidebar(3);
            ?>
        </div>
        <div class="right">
            <?php
            include_once(APP_ROOT . "/includes/header.php");
            ?>
            <main class="achievements">
                <div class="container">
                    <div class="title">
                        <h1>Achievements</h1>
                        <a href="/pages/addachievement.php"><img src="../images/Add_round.svg" alt=""> Add Achievement</a>
                    </div>
                    <div class="card-container">
                        <!-- Card 1 -->
                        <div class="card">
                            <img src="../images/achievements-posters/image-1.png" alt="Add Event Image">
                            <div class="card-content">
                                <h2 class="card-title">National ICT Award Winner</h2>
                                <p class="card-description">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                            </div>
                            <!-- Card actions with icons -->
                            <div class="card-actions">
                                <button class="edit-button"><span class="icon">&#9998;</span>Edit</button>
                                <button class="delete-button"><span class="icon">&#128465;</span>Delete</button>
                            </div>

                        </div>

                        <!-- Card 2 -->
                        <div class="card">
                            <img src="../images/achievements-posters/image-2.png" alt="Add Event Image">
                            <div class="card-content">
                                <h2 class="card-title">Epic Lanka ICT Award Winner</h2>
                                <p class="card-description">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                            </div>
                            <!-- Card actions with icons -->
                            <div class="card-actions">
                                <button class="edit-button"><span class="icon">&#9998;</span>Edit</button>
                                <button class="delete-button"><span class="icon">&#128465;</span>Delete</button>
                            </div>

                        </div>

                    </div>
                </div>
            </main>
        </div>
    </div>
</body>

</html>