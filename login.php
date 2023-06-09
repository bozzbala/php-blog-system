<?php include ('./logic/auth.php');
if(isset($_SESSION['email'])){
    header("Location: /");
}
?>
<!doctype html>
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