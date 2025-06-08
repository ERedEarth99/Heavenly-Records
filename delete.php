<?php
// Include the database connection
include 'db.php';

// Check if 'id' is passed via URL
if (!isset($_GET['id'])) {
    die("Missing record ID.");
}

// Get the ID from the URL
$id = $_GET['id'];

// Prepare the DELETE query
$stmt = $pdo->prepare("DELETE FROM records WHERE id = :id");

// Execute the query with the provided ID
$stmt->execute([':id' => $id]);

// Redirect back to the main page
header('Location: index.php');
exit;
?>
<?php
// Close the database connection