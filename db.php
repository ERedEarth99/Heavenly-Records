<?php
// Database connection settings
$host = 'localhost';
$dbname = 'hrdb';
$username = 'root';
$password = '';

try {
    // Create PDO instance with UTF-8 support
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Enable errors
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
<?php
