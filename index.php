<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>idiscuss</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

        <style>
            .card:hover{
                transform: scale(1.05);
            }
        </style>

</head>

<body>

    <?php include 'part/_nav.php';
    include "part/_db.php"; ?>



    <!-- carousel -->
    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="img/carousel-1.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="img/carousel-2.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="img/carousel-3.jpg" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- card -->

    <h3 class="text-center mt-5"> I-discuss category</h3>

    <div class="container-fluid row justify-content-evenly">

        <?php

        $sql = "SELECT * FROM category";
        $result = mysqli_query($con, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $sno = $row['cat_id'];
                echo ' <div class="card p-0 mt-4 col-2 shadow" style="width: 18rem;">
            <img src="img/' . $row['cat_name'] . '.jpg" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">' . $row['cat_name'] . '</h5>
                <p class="card-text">' . substr($row['cat_desc'], 0, 90) . '...</p>
                <a href="threadlist.php?catno=' . $sno . '" class="btn btn-primary">Read more</a>
            </div>
        </div>';
            }
        }
        ?>

    </div>

    <div class="container-fluid bg-dark text-white text-center py-3 mt-5">
        copyright@2023 I-discuss <a href="https://github.com/hardiksinh02/forum.github.io"> Goto git hub repo</a>
    </div>

    <div class></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous">
    </script>
</body>

</html>