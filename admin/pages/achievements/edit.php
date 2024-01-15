<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/achivements.php";

$a_id = $_GET['edit_id'];
if (isset($a_id)) {
    $row = getAchivementById($a_id);
    if (isset($row['error']) && !isset($_GET['error'])) {
        header("Location: ?error={$row['error']}");
    }

    $a_name = $row['a_name'];
    $a_date = $row['a_date'];
    $a_desc = $row['a_desc'];
    $a_img = $row['a_img'];
}

?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="/css/addachievement.css">
    <title>Edit Achievement Information Form</title>
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
                            <h1><a href="./">Achievements ></a>Edit Achivement</h1>
                            <p>Edit a
                                <?= $a_name; ?> Achievement
                            </p>
                        </div>
                    </div>
                </div>
                <div class="form-container">
                    <form action="/backend/api/achivements/edit.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="a_id" id="a_id" value="<?= $a_id; ?>">
                        <br>
                        <input type="file" name="a_img" id="a_img" accept="image/*" required>
                        <label for="a_img">
                            <p>Select a Image</p>
                            <img src="<?= $a_img ?>" alt="">
                        </label> <!--Debug -- Image path not loading to form-->
                        <input type="text" name="a_img_loc" style="display:none" value="<?= $a_img ?>">
                        <br>
                        <label for="a_name">Achievement Title:</label>
                        <input type="text" name="a_name" id="a_name" value="<?= $a_name; ?>">
                        <br>
                        <label for="a_desc">Description:</label>
                        <textarea name="a_desc" id="a_desc" rows="6"><?= $a_desc; ?></textarea>
                        <br>
                        <label for="a_date">Date:</label>
                        <input type="date" name="a_date" id="a_date" value="<?= $a_date; ?>">
                        <br>
                        <input type="submit" value="Update">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        const imageInput = document.querySelector('#a_img')
        const previewImage = document.querySelector('#a_img + label img')
        const imageInputText = document.querySelector('#a_img + label p')

        previewImage.style.display = "block"
        imageInputText.classList.add("active")

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