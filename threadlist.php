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
$id = $_GET['catno'];

include "part/_db.php";

include 'part/_nav.php';

if(isset($_SESSION['id'])){
$userid = $_SESSION['id'];
}
$comalert = false;

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $th_title = $_POST['threadtitle'];
    $th_desc = $_POST['threaddesc'];

    $sql = "INSERT INTO thread (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`) VALUES ('$th_title', '$th_desc', '$id', '$userid')";
    $result = mysqli_query($con, $sql);
    if($result){
         $comalert = true;
    }
}

    if($comalert){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your Thread Has been added please wait for comunity to respond.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }


    $sql = "SELECT * FROM category WHERE cat_id = $id";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);

    $emerror = true;

    echo '<div class="container">  
            <div class="jumbotron rounded-3 p-4 m-5 bg-dark-subtle">
                <h1 class="display-4">Welcome to ' . $row['cat_name'] . ' forum</h1>
                <p class="lead">' . $row['cat_desc'] . '</p>
                <hr class="my-4">
                <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
                <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a>
            </div>
          </div>';
    ?>


    <?php
    

    ?>


<!-- form add comment -->

<div class="container">
    <h3 class="mb-4">Start a discussions</h3>
    <?php

if(isset($_SESSION['id'])){
echo '

        <form action="'.$_SERVER['REQUEST_URI'].'" method="post">
            <div class="mb-3">
                <label for="threadtitle" class="form-label">Problem Title</label>
                <input type="text" class="form-control" id="threadtitle" name="threadtitle"
                    aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">Keep your title as short and crips as possible</div>
            </div>
            <div class="mb-3">
                <label for="threaddesc" class="form-label">Ellaborate your concern</label>
                <textarea class="form-control" id="threaddesc" name="threaddesc" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-success">Submit</button>
        </form>
        ';
    }else{
        echo '
        <div class="jumbotron jumbotron-fluid p-4 mt-2 bg-dark-subtle">
                    <div class="container">
                        <h1 class="display-4">You are not logged in. Please Login to be able to post Thread</h1>
                </div>';
    }

    ?>
    </div>

    <!-- end of form add comment-->




    <!-- start show Questions -->
    <div class="container mt-5">
        <h3 class="mb-4">Browse Questions</h3>

        <?php

        $sql = "SELECT * FROM thread WHERE thread_cat_id = $id";
        $result = mysqli_query($con, $sql);
        
                           

        while ($row = mysqli_fetch_assoc($result)) {
            $emerror = false;
            $create_time = $row['created'];
            $thread_id = $row['thread_id'];
            $thread_title = $row['thread_title'];
            $thread_desc = substr($row['thread_desc'], 0, 200);
            $th_user_id = $row['thread_user_id'];
            $sql1 = "SELECT * FROM user WHERE id = $th_user_id";
            $result1 = mysqli_query($con, $sql1);
            $row1 = mysqli_fetch_assoc($result1);
            $user = $row1['email'];

            echo '
            <div class="media d-flex">
                <div>
                    <img src="img/profile.png" class="me-3" width="34" alt="...">
                </div>
                <div class="media-body d-inline">
                <a href="#" class="text-decoration-none text-dark"><p class="fw-bold my-0">'.$user.' '.$create_time.'</p></a>
                    <h5 class="mt-0"><a class="text-decoration-none" href="thread.php?thread='.$thread_id.'">' .$thread_title. '</a></h5>
                    <p>' .$thread_desc. '...</p>
                </div>
            </div>';
        }

        if ($emerror) {
            echo '<div class="jumbotron jumbotron-fluid p-4 mt-2 bg-dark-subtle">
                    <div class="container">
                        <h1 class="display-4">No Threads found</h1>
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