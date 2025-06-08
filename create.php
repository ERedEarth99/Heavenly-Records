<?php
include 'db.php';
include 'header.php';
// both refer to the same database connection file and header file
// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form inputs
    $title = $_POST['title'];        // Album title
    $artist = $_POST['artist'];      // Music artist
    $genre = $_POST['genre'];        // Genre (Rock, Jazz, etc.)
    $year = $_POST['year'];          // Release year
    $format = $_POST['format'];      // Format (Vinyl, CD, etc.)
    $condition = $_POST['condition']; // Condition (New, Used, etc.)

    // Insert into database (fixed reserved keyword `condition`)
    $stmt = $pdo->prepare("INSERT INTO records (`title`, `artist`, `genre`, `year`, `format`, `condition`) 
                           VALUES (:title, :artist, :genre, :year, :format, :condition)");
    $stmt->execute([
        ':title' => $title,
        ':artist' => $artist,
        ':genre' => $genre,
        ':year' => $year,
        ':format' => $format,
        ':condition' => $condition
    ]);

    // Redirect after submission
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add New Record - Heavenly Records</title>
</head>
<body>
    <h1>➕ Add a New Vinyl Record</h1>
    <form method="POST">

        <!-- Album Title -->
        <label>Album Title:</label><br>
        <input type="text" name="title" required> <!-- Album name, e.g., Thriller --><br><br>

        <!-- Artist -->
        <label>Artist:</label><br>
        <input type="text" name="artist" required> <!-- Artist name, e.g., Michael Jackson --><br><br>

        <!-- Genre -->
        <label>Genre:</label><br>
        <input type="text" name="genre"> <!-- Genre of music, e.g., Rock, Hip-Hop --><br><br>

        <!-- Release Year -->
        <label>Release Year:</label><br>
        <input type="number" name="year"> <!-- Year released, e.g., 1982 --><br><br>

        <!-- Format -->
        <label>Format:</label><br>
        <input type="text" name="format"> <!-- Media type, e.g., Vinyl, CD, Cassette --><br><br>

        <!-- Condition -->
        <label>Condition:</label><br>
        <input type="text" name="condition"> <!-- Record condition, e.g., New, Good, Used --><br><br>

        <button type="submit">💾 Add Record</button>
    </form>
    <br>
    <a href="index.php">⬅️ Back to Collection</a>
    <?php include 'footer.php'; ?>
</body>
</html>
<?php
// Close the database connection (if needed) and footer
// Not required here since PDO closes automatically when script ends
?>  
