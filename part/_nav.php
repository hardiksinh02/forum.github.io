<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">idiscuss</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" style="color: rgba(255, 255, 255, 0.952);" href="contact.php">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" style="color: rgba(255, 255, 255, 0.952);" href="about.php">About</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" style="color: rgba(255, 255, 255, 0.952);" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Top Category
                    </a>
                    <ul class="dropdown-menu">
                        <?php
                        include "part/_db.php";
                         $sql = "SELECT * FROM category";
                             $result = mysqli_query($con, $sql);
                             
                             while($row = mysqli_fetch_assoc($result)){
                                echo '
                                    <li><a class="dropdown-item" href="threadlist.php?catno=' .$row['cat_id']. '">'.$row['cat_name'].'</a></li>
                        ';
                    }
                        ?>
                    </ul>
                </li>
            </ul>
            <form class="d-flex me-3" role="search" action="/tuvoc/php_practice/forum/search.php" method="get">
                <input class="form-control me-2" type="search" name="query" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
            <?php

            session_start();

            if (isset($_SESSION['id'])) {
                echo '
                <p class="text-light my-0 me-3">Welcome ' . $_SESSION['email'] . '</p>
                <a class="btn btn-outline-danger" href="/tuvoc/php_practice/forum/logout.php">Log out</a>
                ';
            } else {
                echo '
            <button class="btn btn-success me-2" type="button" data-bs-toggle="modal"
                data-bs-target="#loginmodal">Login</button>

            <button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#signupmodal">Sign
                up</button>
                ';
            }

            // if (isset($_SESSION['id'])) {
            //     echo '
            //     <script> alert("You Are Login Successfully");</script>
            //     ';
            // }

            ?>
        </div>
    </div>
</nav>

<?php
include 'login.php';
include 'signup.php';

if (isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == true) {
    echo '
        <div class="rounded-0 my-0 alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> You are sign up you can now login.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        ';
}


if (isset($_GET['loginsuccess']) && $_GET['loginsuccess'] == true) {
    echo '
        <div class="rounded-0 my-0 alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> You are logged in Successfully.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        ';
}

if (isset($_GET['error']) && $_GET['error'] != "false") {
    echo '
        <div class="rounded-0 my-0 alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> ' . $_GET['error'] . '.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
}

if (isset($_GET['loginerror']) && $_GET['loginerror'] != "false") {
    echo '
        <div class="rounded-0 my-0 alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> ' . $_GET['loginerror'] . '.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
}

?>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>