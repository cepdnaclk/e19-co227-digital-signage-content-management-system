<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
include_once($_SERVER['DOCUMENT_ROOT'] . "/includes/header.php");
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/boards.php";

if (isset($_GET['id'])) {
    if (isAdminBoard($_GET['id'])) {
        $board = getBoard($_GET['id']);
        if (isset($board['error']))
            header("Location: /?error=" . $board['error']);
    } else {
        header("Location: /");
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/board.css">
    <title>Admin panel | <?= $_GET['id'] ? "Edit " . $board['board_name'] : "Create board" ?></title>
</head>

<body>
    <div class="container mt-5 py-5">
        <h3>Edit board: <?= $board['board_name'] ?></h3>
        <div class="row pt-3">
            <div class="col-md-6">
                <form action="<?= isset($_GET['id']) ? "/backend/api/boards/add.php" : "/backend/api/boards/edit.php" ?>" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="boardName" class="form-label">Board Name</label>
                        <input type="text" class="form-control" id="boardName" name="boardName" placeholder="Ex:- Myboard" value="<?= isset($board['board_name']) ? $board['board_name'] : "" ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="logofile" class="form-label">Select a logo</label>
                        <input class="form-control" type="file" id="logofile" name="logofile" required>
                    </div>
                    <div class="mb-3">
                        <label for="orgname" class="form-label">Organization name</label>
                        <input type="text" class="form-control" id="orgname" name="orgname" placeholder="Ex:- My organization" value="<?= isset($board['theme']['orgname']) ? $board['theme']['orgname'] : "" ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="bgfile" class="form-label">Select a background</label>
                        <input class="form-control" type="file" id="bgfile" name="bgfile">
                        <p><em>If you select image that similer to public display aspect ratio will better</em></p>
                    </div>
                    <div class="d-flex gap-5">
                        <div class="mb-3 d-flex flex-column align-items-center">
                            <label for="color-primary" class="form-label">primary color</label>
                            <input type="color" class="form-control" id="color-primary" name="color-primary" value="<?= isset($board['theme']['colorPrimary']) ? $board['theme']['colorPrimary'] : "#e80909" ?>">
                        </div>
                        <div class="mb-3 d-flex flex-column align-items-center">
                            <label for="color-secondary" class="form-label">secondary color</label>
                            <input type="color" class="form-control" id="color-secondary" name="color-secondary" value="<?= isset($board['theme']['colorSecondary']) ? $board['theme']['colorSecondary'] : "#e0d90c" ?>">
                        </div>
                    </div>
                    <?php if (isset($_GET['id'])) { ?>
                        <input type="text" class="d-none" name="oldlogofile" value="<?= $board['theme']['logo'] ?>">
                        <input type="text" class="d-none" name="oldbgfile" value="<?= $board['theme']['bg'] ?>">
                    <?php } ?>
                    <button type="submit" class="btn btn-success w-100 mt-3">
                        <h6 class="my-1"><?= isset($_GET['id']) ? "Update" : "Create" ?></h6>
                    </button>
                </form>
            </div>
            <div class="col-md-6">
                <div class="preview" style="background-image: url(<?= isset($board['theme']['bg']) ? $board['theme']['bg'] : '/images/sample-background.avif'  ?>);">
                    <div class="header">
                        <img src="<?= isset($board['theme']['logo']) ? $board['theme']['logo'] : "/images/signage.png"  ?>" alt="" class="logo">
                        <p class="logo-text">My Organization</p>
                    </div>
                    <div class="sidebar">
                        <div class="item active"></div>
                        <div class="item"></div>
                        <div class="item"></div>
                        <div class="item"></div>
                    </div>
                    <div class="content">
                        <div class="bar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const logoInput = document.getElementById('logofile');
        const logoPreview = document.querySelector('.container .logo');
        const logoText = document.querySelector('.logo-text');
        const orgName = document.getElementById('orgname');
        const preview = document.querySelector('.preview');
        const primaryColor = document.getElementById('color-primary');
        const secondaryColor = document.getElementById('color-secondary');
        const bgFile = document.getElementById('bgfile');

        logoInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function() {
                    logoPreview.src = reader.result;
                }
                reader.readAsDataURL(file);
            }
        });

        orgName.addEventListener('input', function() {
            logoText.innerText = this.value;
        });

        bgFile.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function() {
                    preview.style.backgroundImage = `url(${reader.result})`;
                }
                reader.readAsDataURL(file);
            }
        });

        primaryColor.addEventListener('input', function() {
            preview.style.setProperty('--primary-color', this.value);
        });

        secondaryColor.addEventListener('input', function() {
            preview.style.setProperty('--secondary-color', this.value);
        });
    </script>
</body>

</html>