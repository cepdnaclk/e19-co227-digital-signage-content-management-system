<?php

include_once($_SERVER['DOCUMENT_ROOT'] . "/config.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/includes/header.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/backend/functions/topic.php");


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/topic.css">
    <title>Admin panel | Topic</title>
</head>

<body>
    <div class="container topic mt-5 py-5">
        <h3>Create a Topic</h3>
        <form action="/backend/api/topics/add.php" method="post" class="mt-3">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Ex:- Upcoming Evenets" value="<?= isset($board['board_name']) ? $board['board_name'] : "" ?>" required>
                    </div>
                    <div class="icons">
                        <label for="filterInput" class="form-label">Icon</label>
                        <input class="form-control" id="filterInput" name="filterInput" rows="3" placeholder="search for icon">
                        <ul id="itemList"> </ul>
                    </div>
                </div>
                <div class="col-md-6 d-flex flex-column">
                    <h5 class="mb-4">Select theme</h5>
                    <div class="themes">
                        <div class="theme">
                            <input type="radio" name="theme" id="timetable" value="0" checked>
                            <label for="timetable">
                                <img src="/images/timetable_theme.png" alt="">
                                <p>Timetable</p>
                            </label>
                        </div>
                        <div class="theme">
                            <input type="radio" name="theme" id="slider" value="1">
                            <label for="slider">
                                <img src="/images/slider_theme.png" alt="">
                                <p>Slider</p>
                            </label>
                        </div>
                        <div class="theme">
                            <input type="radio" name="theme" id="image" value="2">
                            <label for="image">
                                <img src="/images/image_theme.png" alt="">
                                <p>Image</p>
                            </label>
                        </div>
                        <div class="theme">
                            <input type="radio" name="theme" id="video" value="3">
                            <label for="video">
                                <img src="/images/video_theme.png" alt="">
                                <p>Video</p>
                            </label>
                        </div>
                        <div class="theme">
                            <input type="radio" name="theme" id="qr" value="4">
                            <label for="qr">
                                <img src="/images/qr_theme.png" alt="">
                                <p>QR & link</p>
                            </label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success mt-auto">Create</button>
                </div>
            </div>
            <div class="d-none">
                <input type="text" name="board_id" value="<?= $_GET['id'] ?>">
                <input type="text" name="board_name" value="<?= $_GET['name'] ?>">
            </div>
        </form>
    </div>
    <script>
        // read json file
        document.onreadystatechange = async function() {
            if (document.readyState === 'complete') {
                let icons = [];

                icons = await fetch("/js/fontawsome.json")
                    .then(response => response.json())
                    .then(data => {
                        return data;
                    })
                    .catch(err => {
                        window.reload();
                    });

                icons.forEach((icon, index) => {
                    const itemList = document.getElementById('itemList');
                    const li = document.createElement('li');
                    const input = document.createElement('input');
                    const label = document.createElement('label');
                    const i = document.createElement('i');

                    input.type = 'radio';
                    input.id = index;
                    input.name = 'icon';
                    input.value = icon;

                    if (icon === 'fas fa-arrow-alt-circle-right') {
                        input.checked = true;
                    }

                    label.htmlFor = index;
                    i.classList = `${icon}`
                    label.appendChild(i);

                    li.appendChild(input);
                    li.appendChild(label);
                    itemList.appendChild(li);
                });

                const itemList = document.getElementById('itemList');
                const filterInput = document.getElementById('filterInput');

                filterInput.addEventListener('keyup', () => {
                    const filterValue = filterInput.value.toUpperCase();
                    const listItems = itemList.querySelectorAll('li');

                    listItems.forEach((listItem) => {
                        const itemText = listItem.querySelector('input').value.toUpperCase();
                        // filter the elements if contains search value
                        if (itemText.indexOf(filterValue) > -1) {
                            listItem.style.display = '';
                        } else {
                            listItem.style.display = 'none';
                        }
                    });
                });
            }
        }
    </script>
</body>

</html>