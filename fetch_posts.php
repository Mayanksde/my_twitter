<?php
include 'includes/db.php';

// Fetch posts from the database in reverse order including user details
$sql = "SELECT posts.*, user.name FROM posts 
        JOIN user ON posts.user_id = user.id 
        ORDER BY posts.created_at DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) 
{
    while($post = $result->fetch_assoc()) {
        echo '<div class="post">';
        // display the name of the author
        echo '<h3>' . htmlspecialchars($post['name']) . '</h3>';

        // display the content of the post
        echo '<p>' . htmlspecialchars($post['content']) . '</p>';
        // display the post image
        if (!empty($post['image_path'])) {
            echo '<img src="' . htmlspecialchars($post['image_path']) . '" alt="Post image">';
        }
        // Post actions
        echo '<div class="post-actions">';
        echo '<div class="buttons">';
        echo '<form action="like.php" method="post" style="display:inline-block;">';
        echo '<input type="hidden" name="post_id" value="' . $post['id'] . '">';
        echo '<input type="submit" value="Like">';
        echo '</form>';
        echo '<form action="retweet.php" method="post" style="display:inline-block;">';
        echo '<input type="hidden" name="post_id" value="' . $post['id'] . '">';
        echo '<input type="submit" value="Retweet">';
        echo '</form>';
        echo '</div>';

        echo '<div class="timestamp">Posted on ' . htmlspecialchars($post['created_at']) . '</div>';
        echo '</div>'; // post-actions
        echo '</div>'; // post
    }
} else {
    echo '<p>No posts to display.</p>';
}

$conn->close();
?>