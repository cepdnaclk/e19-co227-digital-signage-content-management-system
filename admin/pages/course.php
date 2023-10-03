<?php include_once "../config.php" ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/course.css">
    <title>IT Center | Courses</title>
</head>

<body>
    <div class="flex-box">
        <div class="left">
            <?php
            include_once(APP_ROOT . "/includes/sidebar.php");
            sidebar(1);
            ?>
        </div>
        <div class="right">
            <?php
            include_once(APP_ROOT . "/includes/header.php");
            ?>
            <main class="course">
                <div class="container">
                    <div class="title">
                        <div>
                            <h1>Courses</h1>
                            <p>Currently Offered Courses by Us</p>
                        </div>
                        <a href="/pages/addcourse.php" class="btn btn-success"><img src="../images/Add_round.svg" alt=""> Add New Course</a>
                    </div>

                    <div class="table-container">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-left">Course</th>
                                        <th class="text-left">Description</th>
                                        <th class="text-center"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Sample Rows -->
                                    <tr>
                                        <td class="text-left">CCNA 200-301</td>
                                        <td class="text-left">Cisco Certified Network Associate</td>
                                        <td class="text-center">
                                            <button class="btn btn-publish" id="publishButton">Publish</button>&emsp;
                                            <button class="btn btn-preview">Preview</button>&emsp;
                                            <a href="/pages/coursemanage.php"><button class="btn btn-manage">Manage</button></a>&emsp;
                                            <button class="btn btn-delete">Delete</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">IT 201</td>
                                        <td class="text-left">Web Development Basics</td>
                                        <td class="text-center">
                                            <button class="btn btn-publish">Publish</button>&emsp;
                                            <button class="btn btn-preview">Preview</button>&emsp;
                                            <a href="/pages/coursemanage.php"><button class="btn btn-manage">Manage</button></a>&emsp;
                                            <button class="btn btn-delete">Delete</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">ML 510</td>
                                        <td class="text-left">Advanced Machine Learning</td>
                                        <td class="text-center">
                                            <button class="btn btn-publish">Publish</button>&emsp;
                                            <button class="btn btn-preview">Preview</button>&emsp;
                                            <a href="/pages/coursemanage.php"><button class="btn btn-manage">Manage</button></a>&emsp;
                                            <button class="btn btn-delete">Delete</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">CP 101</td>
                                        <td class="text-left">Introduction to Computer Hardware</td>
                                        <td class="text-center">
                                            <button class="btn btn-publish">Publish</button>&emsp;
                                            <button class="btn btn-preview">Preview</button>&emsp;
                                            <a href="/pages/coursemanage.php"><button class="btn btn-manage">Manage</button></a>&emsp;
                                            <button class="btn btn-delete">Delete</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- JavaScript to toggle "Publish" and "Unpublish" and add a highlight effect -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const publishButtons = document.querySelectorAll(".btn-publish");
            
            publishButtons.forEach(button => {
                let isPublished = true; // Initial state

                // Function to toggle the button state and text
                function togglePublishButton() {
                    isPublished = !isPublished;
                    if (isPublished) {
                        button.textContent = "Publish";
                        button.classList.remove("btn-unpublish");
                        button.classList.add("btn-publish");
                    } else {
                        button.textContent = "Unpublish";
                        button.classList.remove("btn-publish");
                        button.classList.add("btn-unpublish");
                    }
                }

                // Add a click event listener to toggle the button
                button.addEventListener("click", togglePublishButton);
            });
        });
    </script>
</body>

</html>
