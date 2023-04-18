<?php
session_start();
include 'db.php';

if (!isset($_POST['submit'])) {
    die("Invalid request");
}

if(!isset($_SESSION['email'])){
    die("Invalid request: Not logged in!!!!!");
}

$email = $_SESSION['email'];
$text = $_POST['text'];
$post_id = $_POST['post_id'];
$user_id = $_POST['user_id'];
$filenames = "";

$files = $_FILES['upload'];
$total_count = count($_FILES['upload']);

for ($i = 0; $i < $total_count-1; $i++) {
    $target_dir = "../db/";
    //. date("i-s")
    $input_str = trim(basename($_FILES["upload"]["name"][$i]));
    $str = preg_replace("/\s+/", "", $input_str);
    $target_file = $target_dir . $str;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" && $imageFileType != "webp"
    ) {
        $uploadOk = 0;
    }

    if ($uploadOk != 0) {
        if (move_uploaded_file($_FILES["upload"]["tmp_name"][$i], $target_file)) {
            echo "The file " . htmlspecialchars(basename($_FILES["upload"]["name"][$i])) . " has been uploaded.";
            $filenames .= preg_replace("/\s+/", "", $str) . " ";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

mysqli_query($conn, "INSERT INTO `comments` (`text`, `image_url`, `user_id`, `post_id`) VALUES('$text', '$filenames', '$user_id', '$post_id')");
header("Location: /post.php?id=" . $post_id);
