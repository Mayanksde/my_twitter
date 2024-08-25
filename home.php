<?php
include 'includes/db.php';
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

// Get current user's information
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM user WHERE id = $user_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $name = $user['name'];
    $profile_image = $user['profile_image'];
} else {
    echo "User not found.";
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="css/styles_home.css">
    
    <style>
        .background-section {
            background-image: url('images/bg1.jpg');
            background-size: cover; 
            background-repeat: no-repeat; 
            height: 9rem; 
            width: 100%; 
            position: absolute;
            top: 2rem;
            border: 1px solid black;
            }
    </style>
</head>
<body>
    <header>
        <div class="navbar">
            <div class="navbar-left">
                <a href="#">Home</a>
                <a href="#">Moments</a>
                <a href="#">Notifications</a>
                <a href="#">Messages</a>
            </div>
            <div class="navbar-center">
                <img src="images/logoIMG.png" alt="Logo"> 
            </div>
            <div class="navbar-right">
                <a href="profile.php"><img src="<?php echo htmlspecialchars($profile_image); ?>" alt="Profile" class="profile-photo"></a>
                <a href="logout.php">Logout</a>
            </div>
        </div>
    </header>
    <div class="background-section"></div> 
    <main>
        <div class="container">
            <!-- Left Section -->
            <div class="left-section">
                <img src="<?php echo htmlspecialchars($profile_image); ?>" alt="Profile Photo" class="profile-photo">
                <p><?php echo htmlspecialchars($name); ?></p>
            </div>
            
            <!-- Middle Section -->
            <div class="middle-section">
                <h2>Tweets</h2>
                <form action="post.php" method="post" enctype="multipart/form-data" class="post-form">
                    <textarea name="content" placeholder="What's happening?" required></textarea>
                    <input type="file" name="image" accept="image/*">
                    <input type="submit" value="Post">
                </form>
                <!-- to display posts fetched by fetch_posts.php -->
                <div id="posts">
                    <?php include 'fetch_posts.php'; ?>
                </div>
            </div>

            <!-- Right Section -->
            <div class="right-section">
                <ul>
                    <li>#Follow_AajTak</li>
                    <li>#Follow_AbpNews</li>
                    <li>#Follow_AajTak</li>
                    <li>#Follow_AajTak</li>
                    <li>#Follow_Tv9Bharatvarsh</li>
                </ul>
            </div>

        </div>
    </main>
    <script src="js/scripts.js"></script>
</body>
</html>
