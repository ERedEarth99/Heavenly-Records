<?php
// Include database connection and the header
include 'db.php';
include 'header.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Heavenly Records - Collection</title>
    <link rel="stylesheet" href="style.css"> <!-- Optional: Add styles here -->
</head>
<body>
    <!-- Link to add new record -->
    <a href="create.php">➕ Add New Record</a>

    <!-- Table to display records -->
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Album Title</th>
                <th>Artist</th>
                <th>Genre</th>
                <th>Year</th>
                <th>Format</th>
                <th>Condition</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php
        // Fetch records from DB
        $stmt = $pdo->query("SELECT * FROM records ORDER BY id DESC");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>{$row['id']}</td>";
            echo "<td>{$row['title']}</td>";
            echo "<td>{$row['artist']}</td>";
            echo "<td>{$row['genre']}</td>";
            echo "<td>{$row['year']}</td>";
            echo "<td>{$row['format']}</td>";
            echo "<td>{$row['condition']}</td>";
            echo "<td>
                    <a href='update.php?id={$row['id']}'>Edit</a> | 
                    <a href='delete.php?id={$row['id']}' onclick=\"return confirm('Are you sure?');\">Delete</a>
                  </td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
    <?php include 'footer.php'; ?>
</body>
</html>
<?php
// Close the database connection and shows the footer