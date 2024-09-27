<?php
// Database connection
require 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['signup'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Secure password

    // Check if username or email already exists
    $stmt = $db->prepare("SELECT * FROM users WHERE username=? OR email=?");
    $stmt->execute([$username, $email]); // Use array for parameters
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch results

    if (count($result) > 0) {
        echo "Username or email already taken!";
    } else {
        // Insert new user
        $stmt = $db->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        if ($stmt->execute([$username, $email, $password])) {
            echo "Sign-up successful! You can now sign in.";
        } else {
            echo "Error: " . $stmt->errorInfo()[2]; // Display PDO error
        }
    }
}
?>

<form method="post" action="">
    <h2>Sign Up</h2>
    <input type="text" name="username" placeholder="Username" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit" name="signup">Sign Up</button>
</form>