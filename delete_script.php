<?php
session_start();
include("db.php");

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Validate and sanitize the story ID
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Invalid request.");
}

$story_id = $_GET['id'];
$user_id = $_SESSION['user_id'];

// Verify story belongs to the logged-in user
$query = "SELECT * FROM stories WHERE id = :id AND user_id = :user_id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':id', $story_id, PDO::PARAM_INT);
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt->execute();

if ($stmt->rowCount() == 0) {
    die("Unauthorized or story not found.");
}

// ✅ Delete the comments linked to this story
$delete_comments = "DELETE FROM comments WHERE story_id = :story_id";
$comment_stmt = $conn->prepare($delete_comments);
$comment_stmt->bindParam(':story_id', $story_id, PDO::PARAM_INT);
$comment_stmt->execute();

// ✅ Now delete the story
$delete = "DELETE FROM stories WHERE id = :id";
$del_stmt = $conn->prepare($delete);
$del_stmt->bindParam(':id', $story_id, PDO::PARAM_INT);
$del_stmt->execute();

header("Location: dashboard.php");
exit();
?>
