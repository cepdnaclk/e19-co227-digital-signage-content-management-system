    <?php

    include_once($_SERVER['DOCUMENT_ROOT'] . "/config.php");
    include_once($_SERVER['DOCUMENT_ROOT'] . "/includes/header.php");
    include_once($_SERVER['DOCUMENT_ROOT'] . "/backend/api/topics/slider/upload.php");
    // include_once($_SERVER['DOCUMENT_ROOT'] . "/backend/api/topics/slider/get.php");


    // Retrieve the values from $_GET array
    $id = $_GET['id'];
    $name = $_GET['name'];
    $type = $_GET['type'];
    $title = $_GET['topic'];
    function getImages($directory) {
        $images = glob($directory . "*.{jpg,jpeg,png,gif}", GLOB_BRACE);
        return $images;
    }

    // Fetch images from directory
    $image_directory = "../../images/$name/$title/";
    $images = getImages($image_directory);
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/css/topics-slider.css">
        <link rel="stylesheet" href="/css/manage-board.css">
        <title>Admin panel | Topics-Slider</title>
    </head>

    <body>
        <div class="manage-board">
            <div class="row">
                <nav id="sidebar" class="navbar navbar-dark bg-dark col-md-3">
                    <p class="navbar-brand"><a href="/"><i class="fa-solid fa-circle-left"></i></a> Manage <b><?= $name ?></b></p>
                    <nav class="nav nav-pills flex-column">
                        <a class="nav-link" href="#topics">Topics</a>
                        <a class="nav-link" href="#admins">Admins</a>
                    </nav>
                </nav>
                    <div data-bs-spy="scroll" data-bs-target="#sidebar" data-bs-offset="0" tabindex="0" class="col-md-9">
                    <div class="container">
                        <div id="topics-slider">
                            <div class="d-flex justify-content-between">
                                <h4>Slider Theme Topic -  <?=$title?></h4>
                            </div>
                                <!-- Form to upload images -->
                                <form action="/backend/api/topics/slider/upload.php" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="topic_id" value="<?= $id ?>">
                                <input type="hidden" name="board_name" value="<?= $name ?>">
                                <input type="hidden" name="topic_type" value="<?= $type ?>">
                                <input type="hidden" name="topic_title" value="<?= $title ?>">
                                <label for="file">Choose up to 10 images to upload:</label>
                                <input type="file" name="files[]" id="file" multiple accept="image/*">
                                <input type="submit" value="Upload Images" name="submit">
                                </form>

                                <h4>Uploaded Images</h4>
                                
                            <!-- Display uploaded images in table format -->
                            <div class="image-table">
                            <div class="image-row">
                                <div class="image-cell"><strong></strong></div>
                                <div class="image-cell"><strong><center>Image</center></strong></div>
                            </div>
                            <?php foreach ($images as $index => $image): ?>
                                <div class="image-row" draggable="true" data-index="<?= $index ?>">
                                    <div class="image-cell"><center><?= $index + 1 ?></center></div>
                                    <div class="image-cell"><center><img src="<?= $image ?>" alt="Uploaded Image"></center></div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <!-- JavaScript to handle drag-and-drop -->
                        <script>
                            const imageTable = document.querySelector('.image-table');

                            // Drag start event listener
                            imageTable.addEventListener('dragstart', (event) => {
                                const draggedRow = event.target.closest('.image-row');
                                draggedRow.classList.add('dragging');
                                event.dataTransfer.setData('text/plain', draggedRow.dataset.index);
                            });

                            // Drag over event listener
                            imageTable.addEventListener('dragover', (event) => {
                                event.preventDefault();
                                const draggedIndex = event.dataTransfer.getData('text/plain');
                                const draggedRow = document.querySelector(`.image-row[data-index="${draggedIndex}"]`);
                                const afterRow = getDragAfterElement(imageTable, event.clientY);
                                if (afterRow == null) {
                                    imageTable.appendChild(draggedRow);
                                } else {
                                    imageTable.insertBefore(draggedRow, afterRow);
                                }
                            });

                            // Drag end event listener
                            imageTable.addEventListener('dragend', () => {
                                document.querySelectorAll('.image-row').forEach(row => {
                                    row.classList.remove('dragging');
                                });
                            });

                            // Function to get element after which the dragged element should be inserted
                            function getDragAfterElement(container, y) {
                                const draggableElements = [...container.querySelectorAll('.image-row:not(.dragging)')];
                                return draggableElements.reduce((closest, child) => {
                                    const box = child.getBoundingClientRect();
                                    const offset = y - box.top - box.height / 2;
                                    if (offset < 0 && offset > closest.offset) {
                                        return {
                                            offset: offset,
                                            element: child
                                        };
                                    } else {
                                        return closest;
                                    }
                                }, {
                                    offset: Number.NEGATIVE_INFINITY
                                }).element;
                            }
                        </script>

                                <!-- JavaScript to handle image order
                                <script>
                                    const imageOrderInputs = document.querySelectorAll('input[name="image_order[]"]');
                                    imageOrderInputs.forEach((input, index) => {
                                        input.addEventListener('change', () => {
                                            // Update image order when input value changes
                                            console.log(`Image ${index + 1} order: ${input.value}`);
                                        });
                                    });
                                </script> -->
                        </div>
                    </div>
                    </div>
                </div>


            
        
        </div>
        
    </body>

    </html>