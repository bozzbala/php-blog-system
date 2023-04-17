<?php
session_start();
if (!isset($_POST['submit'])) {
    die("Invalid request");
}
include 'db.php';
$email = $_SESSION['email'];
$title = $_POST['title'];
$text = $_POST['text'];
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

$user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `users` WHERE email='$email'"));
$user_id = $user['id'];
mysqli_query($conn, "INSERT INTO `posts` (`title`, `text`, `image_url`, `user_id`) VALUES('$title', '$text', '$filenames', '$user_id')");
header("Location: /");
