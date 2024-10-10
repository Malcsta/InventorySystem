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

$adminsStmt = $db->prepare("SELECT username, email FROM users
                         WHERE admin = 1");
$adminsStmt->execute();
$admins = $adminsStmt->fetchAll(PDO::FETCH_ASSOC);

$activeRentalsStmt = $db->prepare("SELECT rentals.*, users.username, users.email FROM rentals 
                                     JOIN users ON rentals.user_id = users.id 
                                     WHERE rentals.active = 1");
$activeRentalsStmt->execute();
$activeRentals = $activeRentalsStmt->fetchAll(PDO::FETCH_ASSOC);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Control Panel</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <div class="header">
        <a href="main.php"><img src="images/ajlogo.png" alt="logo"></a>
    </div>
    <div class="container">
        <h1>Admin Control Panel</h1>
        <h2>Active Rentals:</h2>
        <p>Rentals exceeding 30 days will appear red.</p>

        <?php if (count($activeRentals) > 0): ?>
        <div class="activerentals">
                <table>
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Email</th>
                            <th>Tool Name</th>
                            <th>Rental Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($activeRentals as $rental): ?>
                            <?php
                                $rentalDate = new DateTime($rental['rental_date']);
                                $currentDate = new DateTime();
                                $interval = $currentDate->diff($rentalDate);
                                $isOver30Days = $interval->days > 30;
                            ?>
                            <tr>
                                <td><?php echo htmlspecialchars($rental['username']); ?></td>
                                <td><?php echo htmlspecialchars($rental['email']); ?></td>
                                <td><?php echo htmlspecialchars($rental['tool_name']); ?></td>
                                <td style="color: <?php echo $isOver30Days ? 'red' : 'black'; ?>; font-weight: <?php echo $isOver30Days ? 'bold' : 'normal'; ?>;">
                                    <?php echo htmlspecialchars($rental['rental_date']); ?>
                                </td>
                                <td><?php echo htmlspecialchars($rental['active'] ? 'Active' : 'Inactive'); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div>No active rentals found.</div>
            <?php endif; ?>

        </div>
        <h2>Administrative Access:</h2>
        <div class="adminlisting">
            <table>
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($admins as $admin): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($admin['username']); ?></td>
                            <td><?php echo htmlspecialchars($admin['email']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>