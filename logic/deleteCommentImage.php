<?php
session_start();

if(!isset($_SESSION['email'])) {
    header("Location: /");
}

include "db.php";

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

if (isset($_GET['id']) && isset($_GET['image'])) {
    $id = $_GET['id'];
    $image = $_GET['image'];
    $email = $_SESSION['email'];

    $row = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE email='$email'"));
    $user_id = $row['id'];
    $row2 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM comments WHERE id='$id'"));
    $post_id = $row2['post_id'];

    if($user_id == $row2['user_id']){
        $query = "SELECT image_url FROM comments WHERE id='$id'";
        $result = mysqli_query($conn, $query);
        $result = mysqli_fetch_assoc($result);

        $image_url = str_split_by_space($result['image_url']);
        $file_pointer = "../db/" . $image_url[$image];

        unlink($file_pointer);
        unset($image_url[$image]);

        $image_str = implode(" ", $image_url) . " ";
        mysqli_query($conn, "UPDATE comments SET image_url = '$image_str' WHERE id='$id'");

        header("Location: /post.php?id=" . $post_id);
        mysqli_close($conn);
    }
}