<?php
// Start the session
session_start();

// Database connection
require 'connect.php'; 

$message = ""; // Initialize message variable

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['signin'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare the query to get user data
    $stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);

    // Fetch the user's data
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verify the password
    if ($user && password_verify($password, $user['password'])) {
        // Store user info in session
        $_SESSION['user_id'] = $user['id'];    
        $_SESSION['username'] = $user['username'];  
        $_SESSION['admin'] = $user['admin'];  

        // Redirect to the main page
        header("Location: main.php");
        exit();
    } else {
        // Invalid credentials message
        $message = "<div class='error'>Invalid username or password!</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>Sign In</title>
</head>
<body>
    <div class=header>
        <a href="index.php"><img src="images/ajlogo.png" alt="logo"></a>
    </div>
    <div class="container">
        <form method="post" action="">
            <h2>Sign In</h2>
            <input class="signin" type="text" name="username" placeholder="Username" required>
            <input class="signin" type="password" name="password" placeholder="Password" required>
            <button class="signin" type="submit" name="signin">Sign In</button>
        </form>
        <?php if (!empty($message)) echo $message; // Display the error message ?>
    </div>
</body>
</html>