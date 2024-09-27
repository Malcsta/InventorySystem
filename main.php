<?php
require('connect.php');

session_start();

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
        <a href="index.php" class="home">Sign out</a>
    </div>
    <div class="optioncontainer">
        <h1 class="">Good afternoon <?php echo $_SESSION['username'] . "!"; ?></h1>
        <h1>What would you like to do?</h1>
        <div class="options">
            <a href="rental.php">Rent an item</a>
            <a href="return.php">Return an item</a>
            <a href="inventory.php">View my items</a>
        </div>
        <form action="create.php" method="POST">

        </form>
    </div>
</body>
</html>