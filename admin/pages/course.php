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
                                        <th class="text-left">Code</th>
                                        <th class="text-left">Course Name</th>
                                        <th class="text-center"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Fetch courses data from the backend
            fetch('../backend/course.php')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(courses => {
                    if (courses.length > 0) {
                        const tbody = document.querySelector("tbody");
                        courses.forEach(course => {
                            const row = document.createElement("tr");
                            row.innerHTML = `
                                <td class="text-left">${course.c_code}</td>
                                <td class="text-left">${course.c_name}</td>
                                <td class="text-center">
                                    <button class="btn btn-publish" data-course-id="${course.c_id}">Publish</button>
                                    <button class="btn btn-preview" data-course-id="${course.c_id}">Preview</button>
                                    <a href="/pages/coursemanage.php" class="btn btn-manage" data-course-id="${course.c_id}">Manage</a>
                                    <button class="btn btn-delete" data-course-id="${course.c_id}">Delete</button>
                                </td>
                            `;
                            tbody.appendChild(row);

                            // Add click event listener to the "Manage" button
                            const manageButton = row.querySelector('.btn-manage');
                            manageButton.addEventListener('click', function () {
                                const courseId = this.getAttribute('data-course-id');
                                this.href = `/pages/coursemanage.php?c_id=${courseId}`;
                            });
                        });
                    }
                })
                .catch(error => {
                    console.error('There was a problem with the fetch operation:', error);
                });
        });
    </script>
</body>

</html>
