<?php
$host = 'localhost';
$db_name = 'task6';
$username = 'username';
$password = 'password';

try {
    // Making DB connection
    $pdo = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}