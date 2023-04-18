<?php
$post_id = $_POST['id'];
$post_title = $_POST['title'];
$post_text = $_POST['text'];

$query = "UPDATE posts SET title='$post_title', text='$post_text', WHERE id='$post_id'";
mysqli_query($conn, $query);