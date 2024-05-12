    <?php

    include_once($_SERVER['DOCUMENT_ROOT'] . "/config.php");
    include_once($_SERVER['DOCUMENT_ROOT'] . "/includes/header.php");
    // include_once($_SERVER['DOCUMENT_ROOT'] . "/backend/api/topics/slider/upload.php");
    // include_once($_SERVER['DOCUMENT_ROOT'] . "/backend/api/topics/slider/get.php");


    // Retrieve the values from $_GET array
    $id = $_GET['id'];
    $name = $_GET['name'];
    $type = $_GET['type'];
    $title = $_GET['topic'];
    function getImages($directory)
    {
        $images = glob($directory . "*.{jpg,jpeg,png,gif}", GLOB_BRACE);
        return $images;
    }

    // Fetch images from directory
    $image_directory = "../../images/$name/$title/";
    // sample data for images(id, image, from_date, to_date, order)
    $images = array(array('id' => 1, 'image' => 'image1.jpg', 'from_date' => '2021-10-01', 'to_date' => '2021-10-10', 'order' => 1), array('id' => 2, 'image' => 'image2.jpg', 'from_date' => '2021-10-11', 'to_date' => '2021-10-20', 'order' => 2), array('id' => 3, 'image' => 'image3.jpg', 'from_date' => '2021-10-21', 'to_date' => '2021-10-30', 'order' => 3));
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
        <div class="manage-board manage-topic-slide">
            <div class="row">
                <div class="col-md-9">
                    <div class="container">
                        <div id="topics-slider">
                            <h4>Slides</h4>

                            <!-- Display uploaded images in table format -->
                            <div class="image-table">
                                <div class="bg-dark text-light image-row">
                                    <p>Image</p>
                                    <p>From date</p>
                                    <p>To date</p>
                                    <p class="text-center" style="grid-column: 4/6;">Order</p>
                                </div>
                                <?php foreach ($images as $key => $image) { ?>
                                    <div class="image-row">
                                        <img src="https://placehold.co/500x300?text=<?= $image['image'] ?>" alt="">
                                        <p class="from"><?= $image['from_date'] ?></p>
                                        <p class="to"><?= $image['to_date'] ?></p>
                                        <button class="btn up text-success fs-3"><i class="fa-solid fa-caret-up"></i></button>
                                        <button class="btn up text-info fs-3"><i class="fa-solid fa-caret-down"></i></button>
                                        <button class="btn up text-danger"><i class="fa-solid fa-trash"></i></button>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <nav id="sidebar" class="navbar navbar-dark bg-dark col-md-3">
                    <p class="navbar-brand"><a href="/">Add new Slide</p>
                    <form action="/backend/api/topics/slider/upload.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="topic_id" value="<?= $id ?>">
                        <input type="hidden" name="board_name" value="<?= $name ?>">
                        <input type="hidden" name="topic_type" value="<?= $type ?>">
                        <input type="hidden" name="topic_title" value="<?= $title ?>">
                        <div class="mb-3">
                            <input type="file" name="files" id="file" accept="image/*">
                            <label for="file">
                                <img src="https://placehold.co/500x300?text=Select a image" alt="">
                            </label>
                        </div>
                        <div class="mb-3">
                            <label for="from_date" class="form-label">From</label>
                            <input type="date" class="form-control" id="from_date" name="from_date" value="<?= date('Y-m-d') ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="to_date" class="form-label">To</label>
                            <input type="date" class="form-control" id="to_date" name="to_date" value="<?= $new_date = date('Y-m-d', strtotime(date('Y-m-d') . ' +' . 10 . ' days')); ?>" required>
                        </div>
                        <button class="btn btn-success w-100" type="submit">Add Slide</button>
                    </form>
                </nav>
            </div>
        </div>
        <script>
            const imageFilePreview = document.querySelector('.manage-topic-slide form label img')
            const imageFile = document.querySelector('.manage-topic-slide form input[type="file"]')

            imageFile.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function() {
                        imageFilePreview.src = `${reader.result}`;
                    }
                    reader.readAsDataURL(file);
                }
            });
        </script>

    </body>

    </html>