<?php
session_start();
include 'logic/db.php';

if (!isset($_SESSION['email'])) {
    die("Error");
}

$email = $_SESSION['email'];
$isset = true;
$post_id = $_GET['post_id'];
$db_id= mysqli_fetch_assoc(mysqli_query($conn, "SELECT user_id FROM posts WHERE id='$post_id'"));
$db_id = $db_id['user_id'];

$result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
$row = mysqli_fetch_assoc($result);
$name = $row['name'];
$id = $row['id'];

if($db_id != $id){
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


$post = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM posts WHERE id='$post_id'"));
$post_title = $post['title'];
$post_text = $post['text'];
$image_url = mysqli_fetch_assoc(mysqli_query($conn, "SELECT image_url FROM posts WHERE id='$post_id'"));
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
    <link href="stylesheets/style.css" rel="stylesheet" type="text/css">
    <script src="https://kit.fontawesome.com/012beec9f6.js" crossorigin="anonymous"></script>
</head>
<body>
<?php include 'inc/header.php'; ?>
<main>
    <div class="container">
        <div class="posts">
                <form class="edit-container" method="post" action="logic/editLogic.php" enctype="multipart/form-data">
                    <input type="hidden" name="post_id" value="<?php echo $post_id ?>">
                    <div class="edit-title">
                        <input type="text" name="post_title" value="<?php echo $post_title ?>">
                    </div>
                    <div class="edit-text">
                        <textarea name="post_text" rows="5"><?php echo $post_text ?></textarea>
                    </div>
                    <div class="edit-images">
                        <?php for ($i = 0; $i < count($image); $i++) { ?>
                            <div>
                                <img src="<?php echo '../db/' . $image[$i]; ?>" alt="post-image"/>
                                <a href="logic/deletePostImage.php?id=<?php echo $post_id ?>&image=<?php echo $i ?>">Удалить</a>
                            </div>
                        <?php } ?>
                    </div>
                    <button type="submit">Сохранить</button>
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