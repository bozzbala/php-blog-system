<?php
session_start();
$id = '';
$isset = false;
if(isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $isset = true;
    include 'logic/db.php';
    $result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    $row = mysqli_fetch_assoc($result);
    $name = $row['name'];
    $id = $row['id'];
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Main page</title>
    <link href="stylesheets/style.css" rel="stylesheet" type="text/css">
    <script src="https://kit.fontawesome.com/012beec9f6.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php include 'inc/header.php'; ?>
    <main>
        <div class="container">
            <div class="posts">
                <form class="form-post" action="/logic/add-post.php" method="post" enctype="multipart/form-data">
                    <div class="form-control">
                        <input class="form-input" name="title" type="text" placeholder="Введите заголовок" required/>
                    </div>
                    <div class="form-control">
                        <textarea class="form-textarea" name="text" rows="5" placeholder="Расскажите миру о своих приключениях!" required></textarea>
                    </div>
                    <div class="form-btn">
                        <input class="form-files" type="file" name="upload[]" multiple>
                        <button type="submit" name="submit">Опубликовать</button>
                    </div>
                </form>

                <div class="feed">
                    <div class="post">
                        <a href="#" class="post-author">Temirlan</a>
                        <div class="post-container">
                            <div class="post-title">
                                <div class="post-title__text">Вот такие дела</div>
                                <div class="post-title__buttons">
                                    <a href="/edit.php"><i class="fa-solid fa-pen"></i></a>
                                    <a href="/delete.php"><i class="fa-solid fa-trash"></i></a>
                                </div>
                            </div>
                            <div class="post-text">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi cum, distinctio ea ex fuga laborum magnam necessitatibus sequi tenetur veritatis! Deleniti expedita temporibus voluptatem! Ipsum molestiae nisi quaerat sint tenetur?
                            </div>
                            <div class="post-images">
                                <img src="https://images.unsplash.com/photo-1575936123452-b67c3203c357?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8aW1hZ2V8ZW58MHx8MHx8&w=1000&q=80" alt="post-image"/>
                                <img src="https://images.unsplash.com/photo-1575936123452-b67c3203c357?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8aW1hZ2V8ZW58MHx8MHx8&w=1000&q=80" alt="post-image"/>
                                <img src="https://images.unsplash.com/photo-1575936123452-b67c3203c357?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8aW1hZ2V8ZW58MHx8MHx8&w=1000&q=80" alt="post-image"/>
                            </div>
                        </div>
                    </div>
                    <div class="post">
                        <a href="#" class="post-author">Temirlan</a>
                        <div class="post-container">
                            <div class="post-title">
                                <div class="post-title__text">Вот такие дела</div>
                                <div class="post-title__buttons">
                                    <a href="/edit.php"><i class="fa-solid fa-pen"></i></a>
                                    <a href="/delete.php"><i class="fa-solid fa-trash"></i></a>
                                </div>
                            </div>
                            <div class="post-text">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi cum, distinctio ea ex fuga laborum magnam necessitatibus sequi tenetur veritatis! Deleniti expedita temporibus voluptatem! Ipsum molestiae nisi quaerat sint tenetur?
                            </div>
                            <div class="post-images">
                                <img src="https://images.unsplash.com/photo-1575936123452-b67c3203c357?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8aW1hZ2V8ZW58MHx8MHx8&w=1000&q=80" alt="post-image"/>
                                <img src="https://images.unsplash.com/photo-1575936123452-b67c3203c357?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8aW1hZ2V8ZW58MHx8MHx8&w=1000&q=80" alt="post-image"/>
                                <img src="https://images.unsplash.com/photo-1575936123452-b67c3203c357?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8aW1hZ2V8ZW58MHx8MHx8&w=1000&q=80" alt="post-image"/>
                            </div>
                        </div>
                    </div>
                    <div class="post">
                        <a href="#" class="post-author">Temirlan</a>
                        <div class="post-container">
                            <div class="post-title">
                                <div class="post-title__text">Вот такие дела</div>
                                <div class="post-title__buttons">
                                    <a href="/edit.php"><i class="fa-solid fa-pen"></i></a>
                                    <a href="/delete.php"><i class="fa-solid fa-trash"></i></a>
                                </div>
                            </div>
                            <div class="post-text">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi cum, distinctio ea ex fuga laborum magnam necessitatibus sequi tenetur veritatis! Deleniti expedita temporibus voluptatem! Ipsum molestiae nisi quaerat sint tenetur?
                            </div>
                            <div class="post-images">
                                <img src="https://images.unsplash.com/photo-1575936123452-b67c3203c357?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8aW1hZ2V8ZW58MHx8MHx8&w=1000&q=80" alt="post-image"/>
                                <img src="https://images.unsplash.com/photo-1575936123452-b67c3203c357?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8aW1hZ2V8ZW58MHx8MHx8&w=1000&q=80" alt="post-image"/>
                                <img src="https://images.unsplash.com/photo-1575936123452-b67c3203c357?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8aW1hZ2V8ZW58MHx8MHx8&w=1000&q=80" alt="post-image"/>
                            </div>
                        </div>
                    </div>
                    <div class="post">
                        <a href="#" class="post-author">Temirlan</a>
                        <div class="post-container">
                            <div class="post-title">
                                <div class="post-title__text">Вот такие дела</div>
                                <div class="post-title__buttons">
                                    <a href="/edit.php"><i class="fa-solid fa-pen"></i></a>
                                    <a href="/delete.php"><i class="fa-solid fa-trash"></i></a>
                                </div>
                            </div>
                            <div class="post-text">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi cum, distinctio ea ex fuga laborum magnam necessitatibus sequi tenetur veritatis! Deleniti expedita temporibus voluptatem! Ipsum molestiae nisi quaerat sint tenetur?
                            </div>
                            <div class="post-images">
                                <img src="https://images.unsplash.com/photo-1575936123452-b67c3203c357?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8aW1hZ2V8ZW58MHx8MHx8&w=1000&q=80" alt="post-image"/>
                                <img src="https://images.unsplash.com/photo-1575936123452-b67c3203c357?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8aW1hZ2V8ZW58MHx8MHx8&w=1000&q=80" alt="post-image"/>
                                <img src="https://images.unsplash.com/photo-1575936123452-b67c3203c357?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8aW1hZ2V8ZW58MHx8MHx8&w=1000&q=80" alt="post-image"/>
                            </div>
                        </div>
                    </div>
                    <div class="post">
                        <a href="#" class="post-author">Temirlan</a>
                        <div class="post-container">
                            <div class="post-title">
                                <div class="post-title__text">Вот такие дела</div>
                                <div class="post-title__buttons">
                                    <a href="/edit.php"><i class="fa-solid fa-pen"></i></a>
                                    <a href="/delete.php"><i class="fa-solid fa-trash"></i></a>
                                </div>
                            </div>
                            <div class="post-text">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi cum, distinctio ea ex fuga laborum magnam necessitatibus sequi tenetur veritatis! Deleniti expedita temporibus voluptatem! Ipsum molestiae nisi quaerat sint tenetur?
                            </div>
                            <div class="post-images">
                                <img src="https://images.unsplash.com/photo-1575936123452-b67c3203c357?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8aW1hZ2V8ZW58MHx8MHx8&w=1000&q=80" alt="post-image"/>
                                <img src="https://images.unsplash.com/photo-1575936123452-b67c3203c357?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8aW1hZ2V8ZW58MHx8MHx8&w=1000&q=80" alt="post-image"/>
                                <img src="https://images.unsplash.com/photo-1575936123452-b67c3203c357?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8aW1hZ2V8ZW58MHx8MHx8&w=1000&q=80" alt="post-image"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="profile">
                <?php if($isset){?>
                <div><?php echo $name ?></div>
                <a href="blog.php?id=<?php echo $id; ?>">Мой блог</a>
                <a href="logout.php">Выйти</a>
                <?php } else {?>
                    <a href="login.php">Войдите чтобы воспользоваться</a>
                <?php } ?>
            </div>
        </div>
    </main>
</body>
</html>