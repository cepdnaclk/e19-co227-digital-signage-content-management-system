<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/config.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/includes/header.php");
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/support.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/boards.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/dashboard.css">
    <title>Admin Panel</title>
</head>

<body>
    <div class="container mt-5 pt-5">
        <div class="d-flex align-items-center justify-content-between">
            <h3>Your Boards</h3>
            <a href="/pages/board.php" class="btn btn-primary"><i class="fa-solid fa-plus me-2"></i> New Board</a>
        </div>
        <div class="row-cols-1 row-cols-md-3 row-cols-lg-5 mt-4">
            <div class="col">
                <div class="card">
                    <img src="https://placehold.co/800?text=IT+center&font=raleway" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">IT center</h5>
                        <p class="card-text">by Kavishkagaya</p>
                        <a href="#" class="btn btn-success">Manage</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>