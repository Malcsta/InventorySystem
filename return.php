<?php
// Database connection
require 'connect.php'; // Ensure this path is correct

session_start();

if (!isset($_SESSION['user_id'])) {
    echo "You must be signed in to view this page.";
    exit();
}

$user_id = $_SESSION['user_id'];
$stmt = $db->prepare("
    SELECT rentals.tool_name, rentals.rental_date
    FROM rentals
    WHERE rentals.user_id = ?
");
$stmt->execute([$user_id]);
$rented_tools = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>Return an item</title>
</head>
<body>
    <div class=header>
        <a href="main.php"><img src="images/ajlogo.png" alt="logo"></a>
    </div>
    <div class="container">
        <h1>Which item would you like to return?</h1>
        <?php if ($rented_tools): ?>
            <ul>
                <?php foreach ($rented_tools as $tool): ?>
                    <li>
                        <h2><?php echo htmlspecialchars($tool['tool_name']); ?></h2>
                        <p>Rented on: <?php echo htmlspecialchars($tool['rental_date']); ?></p>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>You have not rented any tools yet.</p>
        <?php endif; ?>
    </div>
</body>
</html>

