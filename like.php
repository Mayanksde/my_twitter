<?php
include 'includes/db.php';

if (isset($_POST['post_id'])) {
    $post_id = $_POST['post_id'];
    
    // Check if the user has already liked that post
    session_start();
    $user_id = $_SESSION['user_id'];

    // if already liked
    $check_sql = "SELECT * FROM likes WHERE user_id = '$user_id' AND post_id = '$post_id'";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows == 0) {
        // Inserting like in db
        $sql = "INSERT INTO likes (user_id, post_id) VALUES ('$user_id', '$post_id')";
        if ($conn->query($sql) === TRUE) {
            echo "Post liked successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "You have already liked this post.";
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>