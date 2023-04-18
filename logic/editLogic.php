<?php
session_start();
include_once 'db.php';
$post_id = $_POST['post_id'];
$post_title = $_POST['post_title'];
$post_text = $_POST['post_text'];

$query = "UPDATE posts SET title='$post_title', text='$post_text' WHERE id='$post_id'";
mysqli_query($conn, $query);
header("Location: /");