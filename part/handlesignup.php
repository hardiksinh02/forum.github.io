<?php

include "_db.php";
$error = "false";

// if(empty($email)){
//     echo "<script>";
//     echo 'alert("Please enter your email")';
//     echo "</script>";
//     }


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $cpass = $_POST['cpass'];
    $passhash = password_hash($pass, PASSWORD_DEFAULT);
    $cpasshash = password_hash($cpass, PASSWORD_DEFAULT);

    $to = $email;
    $subject = "Welcome To I-Discuss";
    $message = 'Dear '.$email.', Welcome To I-Discuss, and thank you for joining us. My name is Hardik, and I am here to show you everything you need for success.';
    $header = "From: rathavihardiksinh2@gmail.com";

    $sql = "SELECT * FROM user WHERE email = '$email'";
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) > 0) {
        $error = "Email Already Use";
        header("Location:/tuvoc/php_practice/forum/index.php?error=$error");
    } else {

        if ($pass == $cpass) {
            $sql = "INSERT INTO user(email,pass,cpass) VALUES('$email','$passhash','$cpasshash')";
            $result = mysqli_query($con, $sql);
            if ($result) {
                mail($to,$subject,$message,$header);
                $showalert = true;
                header ('Location:/tuvoc/php_practice/forum/index.php?signupsuccess=true');
                exit;
            }
        } else {
            $error = "Password Do not Match";
            header("Location:/tuvoc/php_practice/forum/index.php?error=$error");
        }
    }
    // header("Location:/tuvoc/php_practice/forum/index.php?signupsuccess=false&error=$error");
}

?>