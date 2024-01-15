<?php include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php" ?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="/css/addachievement.css">
    <title>Achievement Information Form</title>
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
            sidebar(3, 3);
            ?>
        </div>

        <?php
        include_once(APP_ROOT . "/includes/header.php");
        ?>
        <div class="right">
            <div class="add-achievement">
                <div class="container">
                    <div class="title">
                        <div>
                            <h1><a href="./">Achievements ></a>Add Achivement</h1>
                            <p>Add a new Achievement</p>
                        </div>
                    </div>
                </div>
                <div class="form-container">
                    <form action="/backend/api/achivements/add.php" method="POST" enctype="multipart/form-data">
                        <input type="file" name="a_img" id="a_img" accept="image/*" required>
                        <label for="a_img">
                            <p>Select a Image</p>
                            <img src="" alt="">
                        </label>
                        <br>
                        <label for="a_name">Achievement Title:</label>
                        <input type="text" name="a_name" id="a_name">
                        <br>
                        <label for="a_desc">Description:</label>
                        <textarea name="a_desc" id="a_desc" rows="6"></textarea>
                        <br>
                        <label for="a_date">Date:</label>
                        <input type="date" name="a_date" id="a_date">
                        <br>
                        <label for="published">Published:</label>
                        <input type="checkbox" name="published" id="published">
                        <br>
                        <input type="submit" value="Upload">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        const imageInput = document.querySelector('#a_img')
        const previewImage = document.querySelector('#a_img + label img')
        const imageInputText = document.querySelector('#a_img + label p')

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