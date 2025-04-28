<?php
session_start();
include("db.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$current_user_id = $_SESSION['user_id'];
$view_user_id = isset($_GET['id']) ? $_GET['id'] : $current_user_id;

// Fetch user info
$query = "SELECT id, username, bio, profile_picture FROM users WHERE id = :user_id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':user_id', $view_user_id);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    die("User not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile - ScriptWriteHub</title>
    <link rel="stylesheet" href="css/style4.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Inter:wght@300;500;700&display=swap" rel="stylesheet">
</head>
<body>
<header>
    <h1 class="profile-title"><?php echo ($current_user_id == $view_user_id) ? 'Your Profile' : htmlspecialchars($user['username']) . "'s Profile"; ?></h1>
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

        <?php if ($current_user_id == $view_user_id): ?>
            <a href="edit_profile.php"><button class="edit-profile-btn">Edit Profile</button></a>
        <?php else: ?>
            <a href="inbox.php?to=<?php echo $user['id']; ?>"><button class="edit-profile-btn">Message</button></a>
        <?php endif; ?>
    </div>

    <section class="script-section">
        <h3><?php echo ($current_user_id == $view_user_id) ? 'Your Uploaded Stories' : 'Uploaded Stories'; ?></h3>
        <ul class="script-list">
            <?php
            $scripts = $conn->prepare("SELECT id, title FROM stories WHERE user_id = :user_id");
            $scripts->bindParam(':user_id', $view_user_id);
            $scripts->execute();
            while ($script = $scripts->fetch(PDO::FETCH_ASSOC)) {
                echo '<li><a href="story.php?id=' . htmlspecialchars($script['id']) . '">' . htmlspecialchars($script['title']) . '</a></li>';
            }
            ?>
        </ul>
    </section>
</main>

<script src="js/scripts.js?v=<?php echo time(); ?>"></script>
</body>
</html>
