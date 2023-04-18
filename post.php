<?php
session_start();
if(!isset($_GET['id'])){
    header("Location: /");
}
include 'logic/db.php';
$isset = false;
$id='';
if(isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $isset = true;
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

$post_id = $_GET['id'];
$post_info = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM posts WHERE id='$post_id'"));
$allcomments = mysqli_query($conn, "SELECT * FROM comments WHERE post_id='$post_id' ORDER BY id DESC");
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
    <link href="stylesheets/post.css" rel="stylesheet" type="text/css">
    <script src="https://kit.fontawesome.com/012beec9f6.js" crossorigin="anonymous"></script>
</head>
<body>
<?php include 'inc/header.php'; ?>
<main>
    <div class="container">
        <div class="posts">

            <div class="feed">
                <?php
                    $user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE id='" . $post_info['user_id'] . "'"));
                    $image = str_split_by_space($post_info['image_url']);
                    ?>
                    <div class="post">
                        <a href="/blog.php?id=<?php echo $user['id'] ?>" class="post-author"><?php echo $user['name'] ?></a>
                        <div class="post-container">
                            <div class="post-title">
                                <div class="post-title__text"><?php echo $post_info['title'] ?></div>
                            </div>
                            <div class="post-text">
                                <?php echo $post_info['text'] ?>
                            </div>
                            <div class="post-images">
                                <?php for ($i = 0; $i < count($image); $i++) { ?>
                                    <img src="<?php echo '../db/' . $image[$i]; ?>" alt="post-image"/>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <form class="comment-container" action="logic/addComment.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="user_id" value="<?php echo $id ?>">
                        <input type="hidden" name="post_id" value="<?php echo $_GET['id']?>">
                        <textarea rows="5" name="text"></textarea>
                        <input type="file" name="upload[]" multiple="multiple">
                        <button type="submit" name="submit">Отправить</button>
                    </form>

                <?php while($comment = mysqli_fetch_assoc($allcomments)) {?>
                    <div class="comment-container">
                        <div class="comment-text"><?php echo $comment['text']?></div>
                        <div class="comment-images">
                            <?php
                            $image = str_split_by_space($comment['image_url']);
                            for ($i = 0; $i < count($image); $i++) { ?>
                            <img src="<?php echo '../db/' . $image[$i]; ?>" alt="post-image"/>
                            <?php } ?>
                        </div>
                        <div class="comment-buttons">
                            <?php if ($id == $comment['user_id']) { ?>
                                <form action="logic/editComment.php" method="get">
                                    <input type="hidden" name="comment_id" value="<?php echo $comment['id']; ?>" />
                                    <button type="submit" id="edit"><i
                                                class="fa-solid fa-pen"></i></button>
                                </form>
                                <form action="logic/deleteComment.php" method="post">
                                    <input type="hidden" name="comment_id" value="<?php echo $comment['id']; ?>" />
                                    <input type="hidden" name="user_id" value="<?php echo $comment['user_id']; ?>" />
                                    <button type="submit" id="delete"><i
                                                class="fa-solid fa-trash"></i></button>
                                </form>
                            <?php } ?>
                        </div>
                        <?php
                        $comment_user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE id=" . $comment['user_id'] . ""));
                        ?>
                        <a class="comment-author" href="/blog.php?id=<?php echo $comment_user['id'] ?>">
                            <?php
                            echo $comment_user['name'];
                            ?>
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="profile">
            <?php if($isset){?>
                <div><?php echo $name ?></div>
                <a href="blog.php?id=<?php echo $id ?>">Мой блог</a>
                <a href="logout.php">Выйти</a>
            <?php } else {?>
                <a href="login.php">Войдите чтобы воспользоваться</a>
            <?php } ?>
        </div>
    </div>
</main>
</body>
</html>