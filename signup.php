<?php
include 'includes/db.php';

session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // insert user data in db
    $sql = "INSERT INTO user (name, email, password) VALUES ('$name', '$email', '$hashed_password')";

    if ($conn->query($sql) === TRUE) {
        // Get the inserted user ID
        $user_id = $conn->insert_id;

        // Set the session variables
        $_SESSION['user_id'] = $user_id;
        $_SESSION['name'] = $name;

        // Redirect to the home page
        header("Location: home.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        // header("Location: index.php");
        // exit();
    }
}
$conn->close();
?>
