<?php
session_start();
include 'db.php';

if(isset($_POST['submit'])){
    $comment_id = $_POST['comment_id'];
    $comment_text = $_POST['comment_text'];
    $post = mysqli_fetch_assoc(mysqli_query($conn, "SELECT post_id FROM comments WHERE id='$comment_id'"));
    $post_id = $post['post_id'];
    $query = "UPDATE comments SET text='$comment_text' WHERE id='$comment_id'";
    mysqli_query($conn, $query);
    header("Location: /post.php?id=" . $post_id);
    exit();
}
if (!isset($_SESSION['email'])) {
    die("Error");
}

$email = $_SESSION['email'];
$isset = true;
$comment_id = $_GET['comment_id'];
$db_id= mysqli_fetch_assoc(mysqli_query($conn, "SELECT user_id FROM comments WHERE id='$comment_id'"));
$db_id = $db_id['user_id'];

$result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
$row = mysqli_fetch_assoc($result);
$name = $row['name'];
$id = $row['id'];

if($db_id != $id){
    header("Location: /");
    exit();
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


$comment = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM comments WHERE id='$comment_id'"));
$comment_text = $comment['text'];
$image_url = mysqli_fetch_assoc(mysqli_query($conn, "SELECT image_url FROM comments WHERE id='$comment_id'"));
$image = str_split_by_space($image_url['image_url']);

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Main page</title>
    <link href="../stylesheets/style.css" rel="stylesheet" type="text/css">
    <script src="https://kit.fontawesome.com/012beec9f6.js" crossorigin="anonymous"></script>
</head>
<body>
<?php include '../inc/header.php'; ?>
<main>
    <div class="container">
        <div class="posts">
                <form class="edit-container" method="post" action="editComment.php" enctype="multipart/form-data">
                    <input type="hidden" name="comment_id" value="<?php echo $comment_id ?>">
                    <div class="edit-text">
                        <textarea name="comment_text" rows="5"><?php echo $comment_text ?></textarea>
                    </div>
                    <div class="edit-images">
                        <?php for ($i = 0; $i < count($image); $i++) { ?>
                            <div>
                                <img src="<?php echo '../db/' . $image[$i]; ?>" alt="post-image"/>
                                <a href="deleteCommentImage.php?id=<?php echo $comment_id ?>&image=<?php echo $i ?>">Удалить</a>
                            </div>
                        <?php } ?>
                    </div>
                    <button name="submit" type="submit">Сохранить</button>
                </form>
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