<?php
session_start();
include("db.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch all contacts
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

// Handle message send
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['message'], $_POST['to_user_id'])) {
    $msg = trim($_POST['message']);
    $to_user_id = (int)$_POST['to_user_id'];

    if (!empty($msg)) {
        $insert = $conn->prepare("INSERT INTO messages (sender_id, receiver_id, message) VALUES (:sender, :receiver, :message)");
        $insert->execute([
            ':sender' => $user_id,
            ':receiver' => $to_user_id,
            ':message' => $msg
        ]);
    }

    header("Location: inbox.php?to_user_id=$to_user_id");
    exit();
}

// Load selected chat
$selected_user = null;
$messages = [];
if (isset($_GET['to_user_id'])) {
    $to_user_id = (int)$_GET['to_user_id'];
    $user_stmt = $conn->prepare("SELECT username FROM users WHERE id = :id");
    $user_stmt->execute([':id' => $to_user_id]);
    $selected_user = $user_stmt->fetch(PDO::FETCH_ASSOC);

    $chat = $conn->prepare("SELECT * FROM messages 
        WHERE (sender_id = :sender AND receiver_id = :receiver)
           OR (sender_id = :receiver AND receiver_id = :sender)
        ORDER BY timestamp ASC");
    $chat->execute([':sender' => $user_id, ':receiver' => $to_user_id]);
    $messages = $chat->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inbox - ScriptWriteHub</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
        }

        header {
            background: #1a1a1a;
            color: white;
            padding: 15px 20px;
            font-size: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header a {
            color: #1E90FF;
            text-decoration: none;
            font-weight: bold;
        }

        .main-container {
            flex: 1;
            display: flex;
            height: calc(100vh - 60px);
        }

        .sidebar {
            width: 300px;
            background: #fff;
            border-right: 1px solid #ccc;
            overflow-y: auto;
        }

        .chat-area {
            flex: 1;
            background: #fafafa;
            padding: 20px;
            display: flex;
            flex-direction: column;
        }

        .contact {
            display: flex;
            align-items: center;
            padding: 15px;
            border-bottom: 1px solid #eee;
            cursor: pointer;
        }

        .contact:hover {
            background: #f2f2f2;
        }

        .profile-icon {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: #999;
            margin-right: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 18px;
        }

        .contact img {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 12px;
        }

        .contact-name {
            font-weight: bold;
            color: #333;
        }

        .chat-title {
            font-weight: bold;
            margin-bottom: 10px;
            font-size: 18px;
        }

        #message-container {
            flex: 1;
            overflow-y: auto;
            margin-bottom: 10px;
        }

        .message-box {
            padding: 10px 15px;
            border-radius: 20px;
            max-width: 70%;
            margin-bottom: 8px;
        }

        .from-me {
            background: #1E90FF;
            color: white;
            margin-left: auto;
        }

        .from-them {
            background: #e4e6eb;
            margin-right: auto;
        }

        .message-form {
            display: flex;
            gap: 10px;
        }

        .message-form input[type="text"] {
            flex: 1;
            padding: 10px;
            border-radius: 20px;
            border: 1px solid #ccc;
        }

        .message-form button {
            padding: 10px 20px;
            background: #1E90FF;
            color: white;
            border: none;
            border-radius: 20px;
            cursor: pointer;
        }

        .message-form button:hover {
            background: #0A75C2;
        }

        a.no-style {
            text-decoration: none;
            color: inherit;
        }
    </style>
</head>
<body>

<header>
    <div>Inbox</div>
    <a href="homepage.php">Home</a>
</header>

<div class="main-container">
    <div class="sidebar">
        <?php foreach ($contacts as $user): ?>
            <div class="contact" onclick="window.location='inbox.php?to_user_id=<?= $user['id']; ?>'">
                <?php if (!empty($user['profile_picture'])): ?>
                    <a href="view_profile.php?id=<?= $user['id']; ?>" onclick="event.stopPropagation();" class="no-style">
                        <img src="uploads/<?= htmlspecialchars($user['profile_picture']); ?>"  />
                    </a>
                <?php else: ?>
                    <a href="view_profile.php?id=<?= $user['id']; ?>" onclick="event.stopPropagation();" class="no-style">
                        <div class="profile-icon"><?= strtoupper(substr($user['username'], 0, 1)); ?></div>
                    </a>
                <?php endif; ?>
                <span class="contact-name"><?= htmlspecialchars($user['username']); ?></span>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="chat-area">
        <?php if ($selected_user): ?>
            <div class="chat-title">Chat with <?= htmlspecialchars($selected_user['username']); ?></div>

            <div id="message-container">
                <?php foreach ($messages as $msg): ?>
                    <div class="message-box <?= $msg['sender_id'] == $user_id ? 'from-me' : 'from-them'; ?>">
                        <?= nl2br(htmlspecialchars($msg['message'])); ?>
                    </div>
                <?php endforeach; ?>
            </div>

            <form class="message-form" method="POST" action="inbox.php" onsubmit="scrollToBottom()">
                <input type="hidden" name="to_user_id" value="<?= $to_user_id; ?>">
                <input type="text" name="message" placeholder="Type a message..." required>
                <button type="submit" name="send">Send</button>
            </form>
        <?php else: ?>
            <div class="chat-title">Select a conversation</div>
        <?php endif; ?>
    </div>
</div>

<script>
    function scrollToBottom() {
        setTimeout(() => {
            const container = document.getElementById("message-container");
            if (container) {
                container.scrollTop = container.scrollHeight;
            }
        }, 100);
    }

    window.onload = scrollToBottom;
</script>

</body>
</html>
