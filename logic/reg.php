<?php
session_start();
if(isset($_POST['register'])) {
    if (!isset($_POST['email'], $_POST['pass'])) {
        die("Something went wrong...");
    }

    include 'db.php';

    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $name = $_POST['name'];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

    if (mysqli_num_rows($result) > 0) {
        $email_error = "Данная почта уже зарегистрирована";
    }

    $result = mysqli_query($conn, "INSERT INTO `users` (`name`, `email`, `password`) VALUES('$name', '$email', $pass)");

    $_SESSION['email'] = $email;
    header('Location: /');
}