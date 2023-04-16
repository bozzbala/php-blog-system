<?php
session_start();
if(isset($_POST['register'])) {
    if (!isset($_POST['email'], $_POST['pass'])) {
        $error = "Что-то пошло не так";
    }

    include 'db.php';

    $email = $_POST['email'];
    $pass = $_POST['pass'];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' AND password='$pass'");

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['email'] = $email;
        header('Location: /');
    } else {
        $error = "Что-то пошло не так";
    }
}