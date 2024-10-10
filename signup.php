<?php

session_start();

require 'connect.php';

$message = ""; // Initialize message variable

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['signup'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Secure password

    // Check if username or email already exists
    $stmt = $db->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
    $stmt->execute([$username, $email]); // Use array for parameters
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch results

    if (count($result) > 0) {
        $message = "<div class='error'>Username or email already taken!</div>"; // Error message
    } else {
        // Insert new user
        $stmt = $db->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        if ($stmt->execute([$username, $email, $password])) {
            $_SESSION['signup_success'] = "Sign-up successful! You can now sign in."; // Set session message
            header("Location: index.php"); // Redirect to index.php
            exit(); // Prevent further code execution
        } else {
            $message = "<div class='error'>Error: " . htmlspecialchars($stmt->errorInfo()[2]) . "</div>"; // Display PDO error
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>Sign Up</title>
</head>
<body>
    <div class="header">
        <a href="index.php"><img src="images/ajlogo.png" alt="logo"></a>
    </div>
    <div class="container">
        <form method="post" action="">
            <h2>Sign Up</h2>
            <input class="signup" type="text" name="username" placeholder="Username" required>
            <input class="signup" type="email" name="email" placeholder="Email" required>
            <input class="signup" type="password" name="password" placeholder="Password" required>           
            <button class="signup" type="submit" name="signup">Sign Up</button>
        </form>
        <?php if (!empty($message)) echo $message; // Display the error message ?>
    </div>
</body>
</html>