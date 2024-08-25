<?php
include 'includes/db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

// handle comment submission
if (isset($_POST['submit_comment'])) {
    $user_id = $_SESSION['user_id'];
    $post_id = $_POST['post_id'];
    $comment_content = $_POST['comment_content'];

    // insert comment in db
    $insert_sql = "INSERT INTO comments (user_id, post_id, content, created_at) VALUES ($user_id, $post_id, '$comment_content', NOW())";
    if ($conn->query($insert_sql) === TRUE) {
        echo "Comment added successfully.";
        header("Location: home.php");
        exit();
    } else {
        echo "Error adding comment: " . $conn->error;
    }
}
$conn->close();
?>
