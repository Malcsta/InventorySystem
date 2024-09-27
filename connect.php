<?php

/*******w******** 
    Name: Malcolm White
    Date: 2024-09-27
    Description: This page contains the logic that is used to connect the PHP files to the database.
****************/

define('DB_DSN', 'mysql:host=localhost;dbname=toolrentalapp;charset=utf8');
define('DB_USER', 'Admin');
define('DB_PASS', 'FuzzYouMama');

try {
    // Try creating new PDO connection to MySQL.
    $db = new PDO(DB_DSN, DB_USER, DB_PASS, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (PDOException $e) {
    print "Error: " . $e->getMessage();
    die();
}
?>