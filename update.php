<?php
// Include database connection and header
include 'db.php';
include 'header.php';


// Check if an ID was passed via URL
if (!isset($_GET['id'])) {
    die("Missing record ID.");
}

$id = $_GET['id'];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Grab updated values from form
    $title = $_POST['title'];
    $artist = $_POST['artist'];
    $genre = $_POST['genre'];
    $year = $_POST['year'];
    $format = $_POST['format'];
    $condition = $_POST['condition'];

    // Fix: Wrap `condition` in backticks to avoid SQL error
    $stmt = $pdo->prepare("UPDATE records 
        SET `title` = :title, `artist` = :artist, `genre` = :genre, 
            `year` = :year, `format` = :format, `condition` = :condition 
        WHERE `id` = :id");

    $stmt->execute([
        ':title' => $title,
        ':artist' => $artist,
        ':genre' => $genre,
        ':year' => $year,
        ':format' => $format,
        ':condition' => $condition,
        ':id' => $id
    ]);

    header('Location: index.php');
    exit;
}

// Fetch existing record
$stmt = $pdo->prepare("SELECT * FROM records WHERE id = :id");
$stmt->execute([':id' => $id]);
$record = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$record) {
    die("Record not found.");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Record - Heavenly Records</title>
</head>
<body>
    <h1>✏️ Edit Record</h1>

    <form method="POST">
        <label>Album Title:</label><br>
        <input type="text" name="title" value="<?= htmlspecialchars($record['title']) ?>" required><br><br>

        <label>Artist:</label><br>
        <input type="text" name="artist" value="<?= htmlspecialchars($record['artist']) ?>" required><br><br>

        <label>Genre:</label><br>
        <input type="text" name="genre" value="<?= htmlspecialchars($record['genre']) ?>"><br><br>

        <label>Release Year:</label><br>
        <input type="number" name="year" value="<?= htmlspecialchars($record['year']) ?>"><br><br>

        <label>Format:</label><br>
        <input type="text" name="format" value="<?= htmlspecialchars($record['format']) ?>"><br><br>

        <label>Condition:</label><br>
        <input type="text" name="condition" value="<?= htmlspecialchars($record['condition']) ?>"><br><br>

        <button type="submit">💾 Save Changes</button>
    </form>
    <br>
    <a href="index.php">⬅️ Back to Collection</a>
<?php include 'footer.php'; ?>
</body>
</html>
<?php
// Close the database connection and shows the footer 