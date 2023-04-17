<?php
session_start();
if (!isset($_POST['post_id'], $_POST['user_email'])) {
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


include 'logic/db.php';
$email = $_SESSION['email'];
$post_id = $_POST['post_id'];
$check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
$post = mysqli_query($conn, "SELECT * FROM posts WHERE id='$post_id'");
$post_fetch = mysqli_fetch_assoc($post);
$check = mysqli_fetch_assoc($check);
if ($_POST['user_email'] != $email) {
    header("Location: /");
    die("sessions dont match");
} else {
    $image_url = str_split_by_space($post_fetch['image_url']);
    for($i = 0; $i < count($image_url); $i++) {
        $file_pointer = "./db/" . $image_url[$i];
        unlink($file_pointer);
        unset($image_url[$i]);
    }
    mysqli_query($conn, "DELETE FROM posts WHERE id='$post_id'");
    header("Location: /");
}