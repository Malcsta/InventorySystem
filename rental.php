<?php
// Database connection
require 'connect.php'; // Ensure this path is correct

session_start();

if (!isset($_SESSION['user_id'])) {
    echo "You must be signed in to view this page.";
    exit();
}

// Fetch available tools (where is_available = 1)
$stmt = $db->prepare("SELECT * FROM tools WHERE is_available = 1");
$stmt->execute();
$tools = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>Available Tools for Rental</title>
</head>
<body>
    <div class=header>
        <a href="main.php"><img src="images/ajlogo.png" alt="logo"></a>
    </div>
    <div class="container">
        <h1>Available Tools for Rental</h1>
        <?php if ($tools): ?>
            <ul>
                <?php foreach ($tools as $tool): ?>
                    <li>
                        <h2><?php echo htmlspecialchars($tool['name']); ?></h2>
                        <p><?php echo htmlspecialchars($tool['description']); ?></p>
                        <p>Amount left: <?php echo htmlspecialchars($tool['quantity_left']);?></p> 
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No tools are currently available for rental.</p>
        <?php endif; ?>
    </div>
</body>
</html>