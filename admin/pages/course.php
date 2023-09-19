<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/course.css"> 
    <title>IT Center | Courses</title>
</head>

<body>
    <?php include('../includes/header.php'); ?>

    <main class="course">
        <div class="container">
            <h1>Courses</h1>
            <p>Currently Offered Courses by Us</p>

            <div class="table-container">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-left">Course</th>
                                <th class="text-left">Description</th>
                                <th class="text-center"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Sample Rows -->
                            <tr>
                                <td class="text-left">CCNA 200-301</td>
                                <td class="text-left">Cisco Certified Network Associate</td>
                                <td class="text-center">
                                    <button class="btn btn-primary">Edit</button>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-left">Sample Course</td>
                                <td class="text-left">Sample Description</td>
                                <td class="text-center">
                                    <button class="btn btn-primary">Edit</button>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-left">Another Course</td>
                                <td class="text-left">Another Description</td>
                                <td class="text-center">
                                    <button class="btn btn-primary">Edit</button>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-left">Yet Another Course</td>
                                <td class="text-left">Yet Another Description</td>
                                <td class="text-center">
                                    <button class="btn btn-primary">Edit</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="add-course text-center">
                    <button class="btn btn-success">Add New Course</button>
                </div>
            </div>
        </div>
    </main>

    <?php include('../includes/footer.php'); ?>
</body>

</html>
