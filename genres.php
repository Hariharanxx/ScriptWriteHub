<?php
session_start();
include("db.php");

// Fetch available genres from database
$genres = $conn->query("SELECT DISTINCT genre FROM stories")->fetchAll(PDO::FETCH_ASSOC);

// Fetch stories based on selected genre
$genre_filter = isset($_GET['genre']) ? $_GET['genre'] : '';
$query = "SELECT * FROM stories";
if (!empty($genre_filter) && $genre_filter !== 'all') {
    $query .= " WHERE genre = :genre";
}
$stmt = $conn->prepare($query);
if (!empty($genre_filter) && $genre_filter !== 'all') {
    $stmt->bindParam(':genre', $genre_filter);
}
$stmt->execute();
$stories = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Genres - ScriptWriteHub</title>
    <link rel="stylesheet" href="css/style5.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Inter:wght@300;500;700&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <h1 class="genres-title">Explore Stories by Genre</h1>
        <nav>
            <a href="homepage.php">Home</a>
            <a href="land.html">Logout</a>
        </nav>
    </header>

    <main class="genres-container">
        <div class="genre-filters">
            <a href="genres.php?genre=all" class="filter-btn">All</a>
            <?php foreach ($genres as $genre): ?>
                <a href="genres.php?genre=<?= urlencode($genre['genre']) ?>" class="filter-btn"><?= htmlspecialchars($genre['genre']) ?></a>
            <?php endforeach; ?>
        </div>

        <div class="stories-list">
            <?php if (!empty($stories)): ?>
                <?php foreach ($stories as $story): ?>
                    <div class="story-card" data-genre="<?= htmlspecialchars($story['genre']) ?>">
                        <h3><?= htmlspecialchars($story['title']) ?></h3>
                        <p><strong>Genre:</strong> <?= htmlspecialchars($story['genre']) ?></p>
                        <p><strong>Description:</strong> <?= isset($story['short_description']) ? htmlspecialchars(substr($story['short_description'], 0, 100)) : 'No description avaliable' ?>...</p>
                        <a href="story.php?id=<?= $story['id'] ?>" class="read-btn">Read</a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No stories available in this genre.</p>
            <?php endif; ?>
        </div>
    </main>

    <script src="js/scripts.js?v=<?php echo time(); ?>"></script>
</body>
</html>
