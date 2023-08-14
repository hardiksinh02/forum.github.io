<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>idiscuss</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>

    <!-- INSERT INTO `thread` (`thread_id`, `thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `created`) VALUES (NULL, 'PHP login system validation not work', 'php login in index.php home page in button click to open modal and fill details and wrong details to show on top alert.how to this validation in php login system. and sign up page in alert show.to ill all detailsand sign up page in alert show.to ill all details', '2', '0', current_timestamp()); -->

    <?php


    $id = $_GET['thread'];


    include 'part/_nav.php';

    include "part/_db.php";
    if (isset($_SESSION['id'])) {
        $userid = $_SESSION['id'];
    }
    $emerror = true;
    $comalert = false;

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $comment = $_POST['comment_con'];

        $sql = "INSERT INTO `comments` (`comment_content`, `thread_id`, `commented_by`) VALUES ('$comment', '$id', '$userid')";
        $result = mysqli_query($con, $sql);
        if ($result) {
            $comalert = true;
        }
    }

    if ($comalert) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your Comment Has been added..
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }

    $sql = "SELECT * FROM thread WHERE thread_id = $id";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    $thread_cat_id = $row['thread_cat_id'];
    $thread_user_id = $row['thread_user_id'];

    $sql2 = "SELECT * FROM user WHERE id = $thread_user_id";
    $result2 = mysqli_query($con, $sql2);
    $row2 = mysqli_fetch_assoc($result2);
    $user_post = $row2['email'];

    echo '<div class="container">  
            <div class="jumbotron rounded-3 p-4 m-5 bg-dark-subtle">
                <h1 class="display-4">' . $row['thread_title'] . '</h1>
                <p class="lead">' . $row['thread_desc'] . '</p>
                <hr class="my-4">
                <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
                <p>Posted by: <em>'.$user_post.'</em></p>
            </div>
          </div>';
    ?>

    <!-- form add comment -->

    <div class="container">
        <h3 class="mb-4">Post A Comment</h3>

        <?php

        if (isset($_SESSION['id'])) {
            echo '

        <form action="' . $_SERVER['REQUEST_URI'] . '" method="post">
            <div class="mb-3">
                <label for="comment_con" class="form-label">Type your Comment</label>
                <textarea class="form-control" id="comment_con" name="comment_con" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-success">Post Comment</button>
        </form>';
        } else {
            echo '
    <div class="jumbotron jumbotron-fluid p-4 mt-2 bg-dark-subtle">
                <div class="container">
                    <h1 class="display-4">You are not logged in. Please Login to be able to post Comment</h1>
            </div>';
        }
        ?>
    </div>
    <!-- end of form add comment-->


    <!-- start show Questions -->


    <div class="container mt-4">
        <h3 class="mb-4">Discussions</h3>

        <?php

        $sql = "SELECT * FROM comments WHERE thread_id = $id";
        $result = mysqli_query($con, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
            $emerror = false;
            $comment_time = $row['comment_time'];
            $comment_content = $row['comment_content'];
            $comment_content = str_replace(">", "&gt;", $comment_content);
            $comment_content = str_replace("<", "&lt;", $comment_content);
            $commented_by = $row['commented_by'];

            $sql1 = "SELECT * FROM user WHERE id = $commented_by";
            $result1 = mysqli_query($con, $sql1);
            $row1 = mysqli_fetch_assoc($result1);
            $user = $row1['email'];

            echo '<div class="media d-flex">
            <div>
                <img src="img/profile.png" class="me-3" width="34" alt="...">
            </div>
            <div class="media-body d-inline">
            <a href="#" class="text-decoration-none text-dark"><p class="fw-bold my-0">' . $user . '  ' . $comment_time . '</p></a>
                <p>' . $comment_content . '</p>
            </div>
        </div>';
        }

        if ($emerror) {
            echo '<div class="jumbotron jumbotron-fluid p-4 mt-2 bg-dark-subtle">
                    <div class="container">
                        <h1 class="display-4">No Comments found</h1>
                        <p class="lead">Be the first person to ask question</p>
                    </div>
                </div>
    ';
        }

        ?>

        <!-- <div class="media mt-4 d-flex">
            <div>
                <img src="img/profile.png" class="me-3" width="44" alt="...">
            </div>
            <div class="media-body d-inline">
                <h5 class="mt-0">Audio Driver problem</h5>
                <p>Will you do the same for me? It's time to face the music I'm no longer your muse. Heard it's
                    beautiful, be the judge and my girls gonna take a vote. I can feel a phoenix inside of me. Heaven is
                    jealous of our love, angels are crying from up above. Yeah, you take me to utopia.</p>
            </div>
        </div> -->
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous">
    </script>
</body>

</html>