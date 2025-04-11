<?php
session_start();
include("db.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Get distinct users from messages
$query = "
    SELECT DISTINCT 
        u.id, u.username, u.profile_picture 
    FROM users u
    JOIN messages m ON 
        (u.id = m.sender_id AND m.receiver_id = :user_id)
        OR (u.id = m.receiver_id AND m.sender_id = :user_id)
    WHERE u.id != :user_id
";

$stmt = $conn->prepare($query);
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Inbox</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f7f7f7; padding: 20px; }
        .contact { background: #fff; padding: 15px; margin-bottom: 10px; border-radius: 8px; box-shadow: 0 0 5px rgba(0,0,0,0.1); display: flex; align-items: center; }
        .contact img { width: 50px; height: 50px; border-radius: 50%; margin-right: 15px; }
        .contact a { text-decoration: none; color: #333; font-size: 18px; font-weight: bold; }
    </style>
</head>
<body>
    <h2>Your Inbox</h2>
    <?php if (count($contacts) > 0): ?>
        <?php foreach ($contacts as $user): ?>
            <div class="contact">
                <img src="uploads/<?php echo htmlspecialchars($user['profile_picture'] ?? 'default-profile.png'); ?>" alt="profile">
                <a href="message.php?to_user_id=<?php echo $user['id']; ?>">
                    <?php echo htmlspecialchars($user['username']); ?>
                </a>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No messages yet.</p>
    <?php endif; ?>
</body>
</html>
