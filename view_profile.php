<?php
session_start();
include("db.php");

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Invalid user ID.");
}

$profile_id = $_GET['id'];

// Fetch user data
$stmt = $conn->prepare("SELECT username, bio, profile_picture FROM users WHERE id = :id");
$stmt->execute([':id' => $profile_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    die("User not found.");
}

// Fetch user's stories
$scripts = $conn->prepare("SELECT id, title FROM stories WHERE user_id = :id");
$scripts->execute([':id' => $profile_id]);
$stories = $scripts->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($user['username']); ?>'s Profile - ScriptWriteHub</title>
    <link rel="stylesheet" href="css/style4.css?v=<?php echo time(); ?>">
</head>
<body>
    <header>
        <h1><?php echo htmlspecialchars($user['username']); ?>'s Profile</h1>
        <nav>
            <a href="dashboard.php">Dashboard</a>
            <a href="homepage.php">Home</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>

    <main class="profile-container">
        <div class="profile-info">
            <img src="<?php echo !empty($user['profile_picture']) ? 'uploads/' . htmlspecialchars($user['profile_picture']) : 'images/default-profile.png'; ?>"  class="profile-pic">
            <h2 class="username"><?php echo htmlspecialchars($user['username']); ?></h2>
            <p class="bio"><?php echo htmlspecialchars($user['bio']); ?></p>
        </div>

        <section class="script-section">
            <h3><?php echo htmlspecialchars($user['username']); ?>'s Stories</h3>
            <ul class="script-list">
                <?php foreach ($stories as $story): ?>
                    <li>
                        <a href="story.php?id=<?php echo $story['id']; ?>" target="_blank">
                            <?php echo htmlspecialchars($story['title']); ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </section>
    </main>
</body>
</html>
<?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] != $profile_id): ?>
    <form action="inbox.php" method="GET">
        <input type="hidden" name="to_user_id" value="<?php echo $profile_id; ?>">
        <button class="edit-profile-btn" type="submit">Send Message</button>
    </form>
<?php endif; ?>
