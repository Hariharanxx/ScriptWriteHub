<?php
session_start();
include("db.php");

// ✅ Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'] ?? '';

// ✅ Fetch user's uploaded stories
$query = "SELECT * FROM stories WHERE user_id = :user_id ORDER BY id DESC";
$stmt = $conn->prepare($query);
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$stories = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - ScriptWriteHub</title>
    <link rel="stylesheet" href="css/style3.css">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Inter:wght@300;500;700&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <h1 class="dashboard-title">Welcome, <?php echo htmlspecialchars($username); ?>!</h1>
        <nav>
            <a href="upload.php">Upload New Story</a>
            <a href="homepage.php">Home</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>

    <main class="dashboard-container">
        <h2 class="section-title">Your Uploaded Stories</h2>

        <div class="script-list">
            <?php if (count($stories) > 0): ?>
                <?php foreach ($stories as $story): ?>
                    <div class="script-card">
                        <h3>Title: <?php echo htmlspecialchars($story['title']); ?></h3>
                        <p>Description: <?php echo htmlspecialchars($story['short_description']); ?></p>
                        <p><strong>Genre:</strong> <?php echo htmlspecialchars($story['genre']); ?></p>
                        <div class="script-actions">
                            <a href="edit_script.php?id=<?php echo $story['id']; ?>" class="edit-btn">Edit</a>
                            <a href="delete_script.php?id=<?php echo $story['id']; ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this story?');">Delete</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>You haven't uploaded any stories yet.</p>
            <?php endif; ?>
        </div>
    </main>

    <script src="js/scripts.js?v=<?php echo time(); ?>"></script>
</body>
</html>
