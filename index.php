<?php
session_start();
$id = '';
$isset = false;
include 'logic/db.php';
$allposts = mysqli_query($conn, "SELECT * FROM posts ORDER BY id DESC");
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $isset = true;
    include 'logic/db.php';
    $result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    $row = mysqli_fetch_assoc($result);
    $name = $row['name'];
    $id = $row['id'];
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
                <?php if(isset($_SESSION['new-post-error'])){ ?>
                <h3 style="color: red;"><?php echo $_SESSION['new-post-error']?></h3>
                <?php } unset($_SESSION['new-post-error']); ?>
                <div class="form-control">
                    <input class="form-input" name="title" type="text" placeholder="Введите заголовок"/>
                </div>
                <div class="form-control">
                    <textarea class="form-textarea" name="text" rows="5"
                              placeholder="Расскажите миру о своих приключениях!"></textarea>
                </div>
                <div class="form-btn">
                    <input class="form-files" type="file" id="image_url" name="upload[]" multiple="multiple">
                    <button type="submit" name="submit">Опубликовать</button>
                </div>
            </form>

            <div class="feed">
                <?php while ($post = mysqli_fetch_assoc($allposts)) {
                    $user_id = $post['user_id'];
                    $userinfo = mysqli_query($conn, "SELECT * FROM users WHERE id='$user_id'");
                    $user = mysqli_fetch_assoc($userinfo);
                    $image = str_split_by_space($post['image_url']);
                    $post_id = $post['id'];
                    ?>
                    <div class="post">
                        <a href="/blog.php?id=<?php echo $user['id'] ?>"
                           class="post-author"><?php echo $user['name'] ?></a>
                        <div class="post-container">
                            <div class="post-title">
                                <div class="post-title__text"><?php echo $post['title'] ?></div>
                                <div class="post-title__buttons">
                                    <?php if ($id == $user_id) { ?>
                                        <form action="edit.php" method="get">
                                            <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>" />
                                            <button type="submit" id="edit"><i
                                                        class="fa-solid fa-pen"></i></button>
                                        </form>
                                        <form action="delete.php" method="post">
                                            <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>" />
                                            <input type="hidden" name="user_email" value="<?php echo $user['email']; ?>" />
                                            <button type="submit" id="delete"><i
                                                        class="fa-solid fa-trash"></i></button>
                                        </form>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="post-text">
                                <?php echo $post['text'] ?>
                            </div>
                            <div class="post-images">
                                <?php for ($i = 0; $i < count($image); $i++) { ?>
                                    <img src="<?php echo '../db/' . $image[$i]; ?>" alt="post-image"/>
                                <?php } ?>
                            </div>
                            <a class="comments-num" href="post.php?id=<?php echo $post_id ?>">
                                <?php
                                $comments = mysqli_query($conn, "SELECT * FROM comments WHERE post_id='$post_id'");
                                echo "<i class='fa-solid fa-comment'></i> " . mysqli_num_rows($comments) . " comments";
                                ?>
                            </a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="profile">
            <?php if ($isset) { ?>
                <div><?php echo $name ?></div>
                <a href="blog.php?id=<?php echo $id; ?>">Мой блог</a>
                <a href="logout.php">Выйти</a>
            <?php } else { ?>
                <a href="login.php">Войдите чтобы воспользоваться</a>
            <?php } ?>
        </div>
    </div>
</main>
</body>
</html>