<?php
require('connect.php');

session_start();

if (!isset($_SESSION['user_id'])) {
    echo "You must be signed in to view this page.";
    exit();
}

$stmt = $db->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {

    echo "<div class='error'>User not found!</div>";
    exit();
}

$username = $user['username']; 
$isAdmin = $user['admin']; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>Inventory</title>
</head>
<body>
    <div class=header>
        <a href="main.php"><img src="images/ajlogo.png" alt="logo"></a>
    </div>
    <div class="optioncontainer">
        <h1 class="">Good afternoon <?php echo $_SESSION['username'] . "!"; ?></h1>
        <h1>What would you like to do?</h1>
        <div class="options">
            <a href="rental.php" class="optionlinks">Rent an item</a>
            <a href="return.php" class="optionlinks">Return an item</a>
            <a href="inventory.php" class="optionlinks">View my items</a>
        </div>
        <div>
        <?php if ($isAdmin == 1): ?>
            <div class="admincontrols">
                <a href="admincontrolpanel.php" class="adminlink">Admin Control Panel</a>
            </div>
        <?php endif; ?>
        <div class="admincontrols">
            <a class="logout" href="logout.php">Log Out</a>
        </div>
        </div>
    </div>
</body>
</html>