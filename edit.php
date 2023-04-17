<?php
session_start();
if (!isset($_POST['post_id'], $_POST['user_email'])) {
    header("Location: /");
}

if (!isset($_SESSION['email'])) {
    header("Location: /");
}
function str_split_by_space($str)
{
    $result = array();
    $new_str = "";
    for ($i = 0; $i < strlen($str) - 1; $i++) {
        $new_str .= $str[$i];
        if ($str[$i + 1] == ' ') {
            array_push($result, trim($new_str));
            $new_str = "";
        }
    }
    return $result;
}

include 'logic/db.php';
$email = $_SESSION['email'];
$post_id = $_POST['post_id'];
$check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
$post = mysqli_query($conn, "SELECT * FROM posts WHERE id='$post_id'");
$post_fetch = mysqli_fetch_assoc($post);
$check = mysqli_fetch_assoc($check);
if ($_POST['user_email'] != $email) {
    header("Location: /");
    die("sessions dont match");
} else {
    $image_url = str_split_by_space($post_fetch['image_url']);
    for($i = 0; $i < count($image_url); $i++) {
        $file_pointer = "./db/" . $image_url[$i];
        unlink($file_pointer);
        unset($image_url[$i]);
    }
    mysqli_query($conn, "DELETE FROM posts WHERE id='$post_id'");
    header("Location: /");
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Авторизация</title>
    <link href="stylesheets/auth.css" rel="stylesheet" type="text/css">
    <script src="https://kit.fontawesome.com/012beec9f6.js" crossorigin="anonymous"></script>
</head>
<body>
<div class="auth-container">
    <form method="post" action="login.php">
        <div class="auth">
            <div class="logo"><i class="fa-solid fa-database"></i></div>
            <div class="auth-group">
                <label for="email">Электронная почта</label>
                <input class=auth-control" type="email" placeholder="Почта" name="email" id="email" required/>
                <?php if (isset($email_error)): ?>
                    <span><?php echo $email_error; ?></span>
                <?php endif ?>
            </div>
            <div class="auth-group">
                <label for="pass">Пароль</label>
                <input class=auth-control" type="password" placeholder="Ваш пароль" name="pass" id="pass" required/>
            </div>
            <button type="submit" name="register">Войти</button>
            <br>
            <a href="registration.php">У меня нет аккаунта</a>
        </div>
    </form>
</div>
</body>
</html>