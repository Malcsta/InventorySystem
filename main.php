<?php
require('connect.php');

session_start();

if (!isset($_SESSION['user_id'])) {
    echo "You must be signed in to view this page.";
    exit();
}

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
    <div class="home">
        <a href="logout.php" class="home">Sign out</a>
    </div>
    <div class="optioncontainer">
        <h1 class="">Good afternoon <?php echo $_SESSION['username'] . "!"; ?></h1>
        <h1>What would you like to do?</h1>
        <div class="options">
            <a href="rental.php" class="optionlinks">Rent an item</a>
            <a href="return.php" class="optionlinks">Return an item</a>
            <a href="inventory.php" class="optionlinks">View my items</a>
        </div>
        <form action="create.php" method="POST">

        </form>
    </div>
</body>
</html>