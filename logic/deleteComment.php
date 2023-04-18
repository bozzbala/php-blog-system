<?php
session_start();
if (!isset($_POST['comment_id'], $_POST['user_id'])) {
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


include 'db.php';
$email = $_SESSION['email'];
$user_id = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id FROM users WHERE email='$email'"));
$comment_id = $_POST['comment_id'];
$post = mysqli_query($conn, "SELECT * FROM comments WHERE id='$comment_id'");
$post_fetch = mysqli_fetch_assoc($post);
if ($_POST['user_id'] != $user_id['id']) {
    header("Location: /");
    die("sessions dont match");
} else {
    $image_url = str_split_by_space($post_fetch['image_url']);
    for($i = 0; $i < count($image_url); $i++) {
        $file_pointer = "./db/" . $image_url[$i];
        echo $file_pointer . "<br><br>";
        unlink($file_pointer);
        unset($image_url[$i]);
    }
    mysqli_query($conn, "DELETE FROM comments WHERE id='$comment_id'");
    header("Location: /post.php?id=" . $_POST['post_id']);
}