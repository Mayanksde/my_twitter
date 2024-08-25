<?php
include 'includes/db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$name = "";
$email = "";

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM user WHERE id = $user_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $name = $user['name']; 
    $email = $user['email'];
} else {
    echo "User not found.";
    exit();
}

// form submission
if (isset($_POST['update_profile'])) 
{
    $new_name = $_POST['name'];
    $new_email = $_POST['email'];
    $new_password = $_POST['password'];

    $update_sql = "UPDATE user SET name = '$new_name', email = '$new_email' WHERE id = $user_id";
    if ($conn->query($update_sql) === TRUE) 
    {
        echo "Profile updated successfully.";
        // Update $name variable to reflect changes
        $name = $new_name;
        $_SESSION['name'] = $new_name;
    } else {
        echo "Error updating profile: " . $conn->error;
    }

    // update password if user change that
    if (!empty($new_password)) {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $update_password_sql = "UPDATE user SET password = '$hashed_password' WHERE id = $user_id";
        if ($conn->query($update_password_sql) === TRUE) {
            echo "Password updated successfully.";
        } else {
            echo "Error updating password: " . $conn->error;
        }
    }

    // handle profile picture upload
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


        $check = getimagesize($_FILES["profile_picture"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["profile_picture"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // checking file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) 
        {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
                // update user profile image db
                $update_image_sql = "UPDATE user SET profile_image = '$target_file' WHERE id = $user_id";
                if ($conn->query($update_image_sql) === TRUE) {
                    // session update
                    $_SESSION['profile_image'] = $target_file;
                    echo "Profile picture updated successfully.";
                } else {
                    echo "Error updating profile picture: " . $conn->error;
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

    header("Location: home.php");
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Update</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <h1>Profile Update</h1>
    </header>
    <main>
        <h2>Update Profile</h2>
        
        <form action="profile.php" method="POST" enctype="multipart/form-data">
            <input type="text" name="name" placeholder="Name" value="<?php echo htmlspecialchars($name); ?>" required>
            <input type="email" name="email" placeholder="Email" value="<?php echo htmlspecialchars($email); ?>" required>
            <input type="password" name="password" placeholder="New Password">
            <input type="file" name="profile_picture">
            <button type="submit" name="update_profile">Update Profile</button>
        </form>
        
    </main>
</body>
</html>
