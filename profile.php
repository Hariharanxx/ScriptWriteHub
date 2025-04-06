<?php
session_start();
include("db.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user info
$query = "SELECT username, bio, profile_picture FROM users WHERE id = :user_id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - ScriptWriteHub</title>
    <link rel="stylesheet" href="css/style4.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Inter:wght@300;500;700&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <h1 class="profile-title">Your Profile</h1>
        <nav>
            <a href="dashboard.php">Dashboard</a>
            <a href="homepage.php">Home</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>

    <main class="profile-container">
        <div class="profile-info">
            <img src="<?php echo !empty($user['profile_picture']) ? 'uploads/' . htmlspecialchars($user['profile_picture']) : 'images/default-profile.png'; ?>" alt="Profile Picture" class="profile-pic">
            <h2 class="username"><?php echo htmlspecialchars($user['username']); ?></h2>
            <p class="bio"><?php echo htmlspecialchars($user['bio']); ?></p>
            <a href="edit_profile.php"><button class="edit-profile-btn">Edit Profile</button></a>
        </div>

        <section class="script-section">
            <h3>Your Uploaded Stories</h3>
            <ul class="script-list">
                <?php
                $scripts = $conn->prepare("SELECT id, title FROM stories WHERE user_id = :user_id");
                $scripts->bindParam(':user_id', $user_id);
                $scripts->execute();
                while ($script = $scripts->fetch(PDO::FETCH_ASSOC)) {
                    echo '<li><a href="story.php?id=' . htmlspecialchars($script['id']) . '" target="_blank">' . htmlspecialchars($script['title']) . '</a></li>';
                }
                ?>
            </ul>
        </section>
    </main>

    <script src="js/scripts.js?v=<?php echo time(); ?>"></script>
</body>
</html>
