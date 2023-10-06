<?php include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php" ?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="/css/adduser.css">
    <title>Register New User</title>
</head>

<body>
    <div class="flex-box">
        <div class="left">
            <?php include_once(APP_ROOT . "/includes/sidebar.php");
            sidebar(2);
            ?>
        </div>

        <?php
        include_once(APP_ROOT . "/includes/header.php");
        ?>
        <div class="right">
            <div class="register-user container">
                <h2><?= $clearenceStatus[$_SESSION['clearense']] > 1 ? 'Register New User' : 'Register new Course Coordinator' ?></h2>
                <div class="form-container">
                    <form action="/backend/adduser.php" method="POST" onsubmit="return validateForm()">
                        <?php if ($clearenceStatus[$_SESSION['clearense']] > 1) { ?>
                            <div class="role-selection">
                                <p>Select User Role:</p></br>
                                <div class="role">
                                    <input type="radio" id="role1" name="user_role" value="admin" required checked>
                                    <label for="role1">
                                        Admin
                                    </label>
                                    <input type="radio" id="role2" name="user_role" value="course_coordinator" required>
                                    <label for="role2">
                                        Course Coordinator
                                    </label>
                                </div>
                            </div>
                        <?php } ?>
                        <label for="username">Username:</label>
                        <input type="text" name="username" id="username" required>
                        <br><br>

                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" required>
                        <br><br>

                        <label for="password">Password:</label>
                        <input type="password" name="password" id="password" required>
                        <br><br>

                        <label for="confirm_password">Confirm Password:</label>
                        <input type="password" name="confirm_password" id="confirm_password" required>
                        <br><br>

                        <!-- Additional Fields for Course Coordinator -->
                        <div class="course-coordinator-fields" style="display: none;">
                            <label for="coordination_count">Select How Many Courses to Coordinate:</label>
                            <input type="number" name="coordination_count" id="coordination_count">
                            <br><br>

                            <div class="course-list">
                                <!-- Course Selection Dropdowns Will be Generated Here Based on coordination_count -->
                            </div>
                        </div>

                        <input type="submit" value="Register User">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Show/Hide Additional Fields for Course Coordinator Role
        const userRoleRadio = document.querySelectorAll('input[name="user_role"]');
        const coordinatorFields = document.querySelector('.course-coordinator-fields');

        userRoleRadio.forEach((radio) => {
            radio.addEventListener('change', function() {
                if (this.value === 'course_coordinator') {
                    coordinatorFields.style.display = 'block';
                } else {
                    coordinatorFields.style.display = 'none';
                }
            });
        });

        // Generate Course Selection Dropdowns Based on coordination_count
        const coordinationCountInput = document.getElementById('coordination_count');
        const courseListContainer = document.querySelector('.course-list');

        coordinationCountInput.addEventListener('input', function() {
            const count = parseInt(this.value);

            // Remove existing dropdowns
            courseListContainer.innerHTML = '';

            // Generate new dropdowns
            for (let i = 1; i <= count; i++) {
                const label = document.createElement('label');
                label.textContent = `Select course ${i} under coordination:`;
                const select = document.createElement('select');
                // Add options to select here (You can populate it dynamically from your database)
                select.innerHTML = '<option value="course1">Course 1</option><option value="course2">Course 2</option><option value="course3">Course 3</option>';
                courseListContainer.appendChild(label);
                courseListContainer.appendChild(select);
                courseListContainer.appendChild(document.createElement('br'));
            }
        });

        // Simple client-side validation
        function validateForm() {
            const password = document.getElementById('password').value;
            const confirm_password = document.getElementById('confirm_password').value;

            if (password !== confirm_password) {
                alert("Password and Confirm Password do not match.");
                return false;
            }

            return true;
        }
    </script>
</body>

</html>