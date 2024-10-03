<?php
require('connect.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory System</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <div class="header">
        <a href="index.php"><img src="images/ajlogo.png" alt="logo"></a>
    </div>
    <div class="container">
        <h1>Welcome to the ArtsJunktion Tool Inventory System.</h1>
        <h2>Sign in or sign up below:</h2>
        <div class="signdiv">
            <a class="sign" href="signin.php">Sign in</a>
            <a class="sign" href="signup.php">Sign up</a>
        </div>
        <div class="aboutdiv">
            <p class="about">ArtsJunktion is excited to provide a diverse selection of equipment, stationery, and materials for Winnipeg's growing art community.</p>
            <p class="about">Signing up is quick and simple! Just hit the button above to get started.</p>
            <p class="about"><p>
            <p class="about2">Copyright © 2024 By Malcolm White, for ArtsJunktion Ltd.</p>
        </div>
    </div>
</body>
</html>