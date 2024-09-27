<?php
// Start the session
session_start();

// Database connection
require 'connect.php'; 

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "You must be signed in to view your rented tools.";
    exit();
}

// Fetch the logged-in user's rented tools
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
    <title>Your Rented Tools</title>
</head>
<body>
    <h1>Your Rented Tools</h1>

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

</body>
</html>