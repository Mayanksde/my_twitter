<?php
include 'includes/db.php';

if (isset($_POST['post_id'])) 
{
    $post_id = $_POST['post_id'];
    session_start();
    $user_id = $_SESSION['user_id'];

    // Insert retweet into database
    $sql = "INSERT INTO posts (user_id, content, image_path, created_at) SELECT '$user_id', content, image_path, NOW() FROM posts WHERE id = '$post_id'";
    if ($conn->query($sql) === TRUE) {
        echo "Post retweeted successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>
