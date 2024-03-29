<?php include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php" ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/course.css">
    <title>IT Center | Courses</title>
</head>

<body>
    <div class="flex-box">
        <div class="left">
            <?php
            include_once(APP_ROOT . "/includes/sidebar.php");
            sidebar(1, 0);
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
                        <?php if ($clearenceStatus[$_SESSION['clearense']] > 0) { ?>
                                    
                            <a href="/pages/course/add.php" class="btn btn-success"><img src="/images/Add_round.svg" alt="">
                            Add New Course</a>
                            <?php } ?>
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
            fetch('/backend/api/course/index.php')
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
                            <a href="/backend/api/course/publish.php?c_id=${course.c_id}" class="btn btn-publish" data-course-id="${course.c_id}">
                                ${course.published == 1 ? 'Unpublish' : 'Publish'}
                            </a>&nbsp;
                            <a href="/pages/course/coursemanage.php" class="btn btn-manage" data-course-id="${course.c_id}">Manage</a>&nbsp;
                            <a href="/pages/course/delete.php?c_id=${course.c_id}" class="btn btn-delete" data-course-id="${course.c_id}">Delete</a>
                        </td>
                    `;
                            tbody.appendChild(row);

                            // Add click event listener to the "Manage" button
                            const manageButton = row.querySelector('.btn-manage');
                            manageButton.addEventListener('click', function () {
                                const courseId = this.getAttribute('data-course-id');
                                this.href = `/pages/course/manage.php?c_id=${courseId}&mode=img`;
                            });
                        });
                    }
                })
                .catch(error => {
                    console.error('There was a problem with the fetch operation:', error);
                });
        });


        // Add click event listener to the "Delete" button
        const deleteButtons = document.querySelectorAll('.btn-delete');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();
                const courseId = this.getAttribute('data-course-id');
                const courseName = this.closest('tr').querySelector('.text-left').textContent;

                // Show a confirmation dialog
                if (confirm(`Are you sure you want to delete the course "${courseName}"?`)) {
                    // If the user confirms, send a DELETE request to delete the course
                    fetch(`/backend/api/course/index.php?c_id=${courseId}`, {
                        method: 'DELETE',
                    })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            // Remove the row from the table
                            this.closest('tr').remove();
                        })
                        .catch(error => {
                            console.error('There was a problem with the fetch operation:', error);
                        });
                }
            });
        });
    </script>
</body>

</html>