<header>
    <a href="/" class="logo"><i class="fa-solid fa-database"></i></i></a>
    <nav class="navbar">
        <ul>
            <li><a href="/">Главная</a></li>
            <li><a href="/blog.php?id=<?php echo $id ?>">Мой блог</a></li>
            <li><a href="/contact.php">Контакты</a></li>
        </ul>
    </nav>
    <?php if(!$isset){ ?><a class="login-btn" href="/login.php">Войти</a><?php } ?>
</header>