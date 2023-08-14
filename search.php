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

    <?php

    include 'part/_nav.php';
    include "part/_db.php";

    ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous">
    </script>
</body>

<div class="container mt-4">
    <h1>Search result for <em>"<?php echo $_GET['query'] ?>" </em></h1>
</div>
<div class="container mt-5">
    <h3 class="mb-4">Browse Questions</h3>

    <?php

    $search = $_GET['query'];

    $sql = "select * from thread where match (thread_title, thread_desc) against ('$search')";
    $result = mysqli_query($con, $sql);
    $searcherror = true;

    while ($row = mysqli_fetch_assoc($result)) {
        $searcherror = false;
        $thread_id = $row['thread_id'];
        $thread_title = $row['thread_title'];
        $thread_desc = $row['thread_desc'];



        echo '<div class="media d-flex">
        <div class="media-body d-inline">
            <h5 class="mt-0"><a class="text-decoration-none text-dark" href="thread.php?thread=' . $thread_id . '">' . $thread_title . '</a></h5>
            <p>' . $thread_desc . '</p>
        </div>
    </div>';

    }


    if ($searcherror) {
        echo '
    <div class="jumbotron jumbotron-fluid p-4 mt-2 bg-dark-subtle">
                    <div class="container">
                        <h1 class="display-4">No Threads found</h1>
                        <p>Suggestions:</p>
                        <ul>
                            <li>Make sure that all words are spelled correctly.</li>
                            <li>Try different keywords.</li>
                            <li>Try more general keywords.</li>
                        </ul>
                    </div>
                  </div>
    ';
    }

    ?>


</div>

</html>