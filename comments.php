<?php
session_start();
require 'db.php'; // Your DB connection

if (isset($_POST['comment'], $_POST['story_id'], $_SESSION['user_id'])) {
    $comment = trim($_POST['comment']);
    $story_id = intval($_POST['story_id']);
    $user_id = $_SESSION['user_id'];

    if ($comment !== '') {
        $stmt = $conn->prepare("INSERT INTO comments (story_id, user_id, comment) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $story_id, $user_id, $comment);
        $stmt->execute();
    }
}

header("Location: story.php?id=" . $story_id);
exit();
