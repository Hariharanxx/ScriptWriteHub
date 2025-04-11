<?php
session_start();
include("db.php");

if (!isset($_SESSION['user_id']) || !isset($_GET['to_user_id'])) {
    header("Location: login.php");
    exit();
}

$sender_id = $_SESSION['user_id'];
$receiver_id = $_GET['to_user_id'];

// Handle new message
if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_POST['message'])) {
    $msg = trim($_POST['message']);
    $insert = $conn->prepare("INSERT INTO messages (sender_id, receiver_id, message) VALUES (:sender, :receiver, :message)");
    $insert->execute([
        ':sender' => $sender_id,
        ':receiver' => $receiver_id,
        ':message' => $msg
    ]);
}

// Fetch chat history
$chat = $conn->prepare("SELECT m.*, u.username FROM messages m
                        JOIN users u ON m.sender_id = u.id
                        WHERE (sender_id = :sender AND receiver_id = :receiver)
                           OR (sender_id = :receiver AND receiver_id = :sender)
                        ORDER BY m.timestamp ASC");
$chat->execute([':sender' => $sender_id, ':receiver' => $receiver_id]);
$messages = $chat->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Chat</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f0f0f0; margin: 0; padding: 0; }
        .chat-container { max-width: 600px; margin: 40px auto; background: white; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px #ccc; }
        .msg { margin: 10px 0; }
        .from-me { text-align: right; }
        .from-me .bubble { background: #1E90FF; color: white; }
        .from-them .bubble { background: #eee; }
        .bubble { display: inline-block; padding: 10px 15px; border-radius: 18px; max-width: 70%; }
        form { display: flex; gap: 10px; margin-top: 20px; }
        input[type="text"] { flex: 1; padding: 10px; border-radius: 5px; border: 1px solid #ccc; }
        button { padding: 10px 20px; background: #1E90FF; color: white; border: none; border-radius: 5px; cursor: pointer; }
    </style>
</head>
<body>
<div class="chat-container">
    <h2>Chat</h2>

    <?php foreach ($messages as $msg): ?>
        <div class="msg <?php echo $msg['sender_id'] == $sender_id ? 'from-me' : 'from-them'; ?>">
            <div class="bubble">
                <strong><?php echo htmlspecialchars($msg['username']); ?>:</strong><br>
                <?php echo nl2br(htmlspecialchars($msg['message'])); ?>
            </div>
        </div>
    <?php endforeach; ?>

    <form method="POST">
        <input type="text" name="message" placeholder="Type your message..." required>
        <button type="submit">Send</button>
    </form>
</div>
</body>
</html>
