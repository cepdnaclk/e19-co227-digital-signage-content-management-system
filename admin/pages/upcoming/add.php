<?php include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php" ?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="/css/addnewevent.css">
    <title>New Event Information Form</title>
    <style>
        .container {
            padding: 1rem 0;
            background-color: var(--color-1);
            box-shadow: 0 0 0 1000px var(--color-1);
        }

        .container .title {
            filter: invert();
        }

        .container .title a {
            opacity: 1;
            color: black;
        }
    </style>
</head>

<body>
    <div class="flex-box">
        <div class="left">
            <?php
            include_once(APP_ROOT . "/includes/sidebar.php");
            sidebar(3, 1);
            ?>
        </div>

        <?php
        include_once(APP_ROOT . "/includes/header.php");
        ?>
        <div class="right">
            <div class="add-events">
                <div class="container">
                    <div class="title">
                        <div>
                            <h1><a href="./">Upcoming Events ></a>Add Event</h1>
                            <p>Add a new upcoming event</p>
                        </div>
                    </div>
                </div>
                <div class="form-container">
                    <form action="/backend/api/upcoming/add.php" method="POST" enctype="multipart/form-data">
                        <input type="file" name="e_img" id="e_img" accept="image/*" required>
                        <label for="e_img">
                            <p>Select a Image</p>
                            <img src="" alt="">
                        </label>
                        <br>
                        <label for="e_name">Name:</label>
                        <input type="text" name="e_name" id="e_name">
                        <br>
                        <label for="e_date">Date:</label>
                        <input type="date" name="e_date" id="e_date">
                        <br>
                        <label for="e_time">Time:</label>
                        <input type="time" name="e_time" id="e_time">
                        <br>
                        <label for="e_venue">Venue:</label>
                        <input type="text" name="e_venue" id="e_venue">
                        <br>
                        <label for="display_from">Display from:</label>
                        <input type="date" name="display_from" id="display_from" required>
                        <br>
                        <label for="display_to">Display to:</label>
                        <input type="date" name="display_to" id="display_to" required>
                        <br>
                        <div style="display: flex;align-items:center;gap:1rem;">
                            <label style="margin: 0;" for="published">Published</label>
                            <input type="checkbox" name="published" id="published">
                        </div>
                        <br>
                        <input type="submit" value="Upload">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        const imageInput = document.querySelector('#e_img')
        const previewImage = document.querySelector('#e_img + label img')
        const imageInputText = document.querySelector('#e_img + label p')

        imageInput.addEventListener('input', (e) => {
            if (e.target.files.length) {
                const file = e.target.files[0];
                previewImage.style.display = "block"
                imageInputText.classList.add("active")
                previewImage.src = URL.createObjectURL(file)
            }
            else {
                previewImage.style.display = "none"
                imageInputText.classList.remove("active")
            }
        })
    </script>
</body>

</html>