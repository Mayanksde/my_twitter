<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>my_twitter</title>
    <link rel="stylesheet" href="css/styles_index.css">
</head>
<body>
    <div class="container">
        <!-- Left section -->
        <div class="left-section">
            <h2>Welcome to Twitter Clone</h2>
            <h3>Connect with friends and the world around you.</h3>
            <h3>See what's happening now.</h3>
        </div>

        <!-- Right section -->
        <div class="right-section">
            <img src="images/logoIMG.png" alt="Logo">
            <h2>Join Twitter</h2>
            <div class="buttons">
                <button onclick="showForm('signup')">Sign Up</button>
                <button onclick="showForm('login')">Login</button>
            </div>

            <!-- Signup sorm -->
            <div id="signupForm">
                <form action="signup.php" method="POST">
                    <input type="text" name="name" placeholder="Name" required><br>
                    <input type="email" name="email" placeholder="Email" required><br>
                    <input type="password" name="password" placeholder="Password" required><br>
                    <button type="submit">Sign Up</button>
                </form>
            </div>

            <!-- Login Form -->
            <div id="loginForm">
                <form action="login.php" method="POST">
                    <input type="email" name="email" placeholder="Email" required><br>
                    <input type="password" name="password" placeholder="Password" required><br>
                    <button type="submit">Login</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function showForm(formId) {
            // document.getElementById('signupForm').style.display = 'none';
            // document.getElementById('loginForm').style.display = 'none';
            document.getElementById(formId + 'Form').style.display = 'block';
        }
    </script>
</body>
</html>
