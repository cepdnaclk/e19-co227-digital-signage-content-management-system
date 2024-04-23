<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
include_once($_SERVER['DOCUMENT_ROOT'] . "/includes/header.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/board.css">
    <title>Admin panel | </title>
</head>

<body>
    <div class="container mt-5 py-5">
        <h3>Create a Board</h3>
        <div class="row pt-3">
            <div class="col-md-6">
                <form action="/backend/api/boards/add.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="boardName" class="form-label">Board Name</label>
                        <input type="text" class="form-control" id="boardName" name="boardName" placeholder="Ex:- Myboard" required>
                    </div>
                    <div class="mb-3">
                        <label for="logofile" class="form-label">Select a logo</label>
                        <input class="form-control" type="file" id="logofile" name="logofile" required>
                    </div>
                    <div class="mb-3">
                        <label for="orgname" class="form-label">Organization name</label>
                        <input type="text" class="form-control" id="orgname" name="orgname" placeholder="Ex:- My organization" required>
                    </div>
                    <div class="mb-3">
                        <label for="bgfile" class="form-label">Select a background</label>
                        <input class="form-control" type="file" id="bgfile" name="bgfile" required>
                        <p><em>If you select image that similer to public display aspect ratio will better</em></p>
                    </div>
                    <div class="d-flex gap-5">
                        <div class="mb-3 d-flex flex-column align-items-center">
                            <label for="color-primary" class="form-label">primary color</label>
                            <input type="color" class="form-control" id="color-primary" name="color-primary" value="#e80909">
                        </div>
                        <div class="mb-3 d-flex flex-column align-items-center">
                            <label for="color-secondary" class="form-label">secondary color</label>
                            <input type="color" class="form-control" id="color-secondary" name="color-secondary" value="#e0d90c">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success w-100 mt-3">
                        <h6 class="my-1">Create</h6>
                    </button>
                </form>
            </div>
            <div class="col-md-6">
                <div class="preview">
                    <div class="header">
                        <img src="/images/signage.png" alt="" class="logo">
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