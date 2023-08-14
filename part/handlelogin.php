<?php
session_start();
include "_db.php";
$loginerror = "false";
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $email = $_POST['email'];
    $pass = $_POST['pass'];

    $sql = "SELECT * FROM user WHERE email = '$email'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            if ($email == $row['email'] && password_verify($pass, $row['pass'])) {
                
                $_SESSION['id'] = $row['id'];
                $_SESSION['email'] = $row['email'];

                header("Location:/tuvoc/php_practice/forum/index.php?loginsuccess=true");
                exit;
            }else{
            $loginerror = "Wrong Password";
            header("Location:/tuvoc/php_practice/forum/index.php?error=$loginerror");
            }
        }
    }else{
        $loginerror = "You Are Not Registred";
        header("Location:/tuvoc/php_practice/forum/index.php?error=$loginerror");
    }

}


?>