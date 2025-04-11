<?php
session_start();
include("db.php");

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Invalid story ID.");
}

$story_id = $_GET['id'];

$query = "SELECT stories.*, users.username FROM stories 
          JOIN users ON stories.user_id = users.id 
          WHERE stories.id = :story_id";

$stmt = $conn->prepare($query);
$stmt->bindParam(':story_id', $story_id);
$stmt->execute();
$story = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$story) {
    die("Story not found.");
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_SESSION['user_id'])) {
    $comment = trim($_POST['comment']);
    if (!empty($comment)) {
        $insert = $conn->prepare("INSERT INTO comments (story_id, user_id, comment, created_at) VALUES (:story_id, :user_id, :comment, NOW())");
        $insert->execute([
            ':story_id' => $story_id,
            ':user_id' => $_SESSION['user_id'],
            ':comment' => $comment
        ]);
    }
    header("Location: story.php?id=" . $story_id);
    exit();
}

$comments_query = $conn->prepare("SELECT c.comment, c.created_at, u.username FROM comments c 
                                  JOIN users u ON c.user_id = u.id 
                                  WHERE c.story_id = :story_id ORDER BY c.created_at DESC");
$comments_query->execute([':story_id' => $story_id]);
$comments = $comments_query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($story['title']); ?> - ScriptWriteHub</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            background-color: #f0f2f5;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #1a1a1a;
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 26px;
            font-weight: bold;
        }
        .container {
            max-width: 800px;
            margin: 30px auto;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .story-title {
            font-size: 30px;
            color: #222; /* Darker title color */
            margin-bottom: 10px;
        }
        .story-meta {
            font-size: 14px;
            color: #555; /* Slightly darker than before */
            margin-bottom: 20px;
        }
        .story-content {
            font-size: 17px;
            color: #444;
            line-height: 1.7;
            margin-bottom: 40px;
            white-space: pre-wrap;
        }
        .comment-section {
            margin-top: 40px;
        }
        .comment-form textarea {
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
            padding: 15px;
            font-size: 15px;
            border-radius: 8px;
            border: 1px solid #ccc;
            resize: vertical;
        }
        .comment-form button {
            margin-top: 10px;
            background-color: #1877f2;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 14px;
            border-radius: 6px;
            cursor: pointer;
        }
        .comment-form button:hover {
            background-color: #0e65d6;
        }
        .comment {
            display: flex;
            align-items: flex-start;
            margin-bottom: 20px;
        }
        .avatar {
            width: 40px;
            height: 40px;
            background-color: #ccc;
            border-radius: 50%;
            margin-right: 15px;
        }
        .comment-box {
            background-color: #f0f2f5;
            padding: 12px 15px;
            border-radius: 10px;
            width: 100%;
        }
        .comment-box .username {
            font-weight: bold;
            font-size: 14px;
            margin-bottom: 5px;
            color: #333;
        }
        .comment-box .time {
            font-size: 12px;
            color: #999;
            margin-top: 4px;
        }
        .back-btn {
            display: inline-block;
            margin-top: 30px;
            background-color: #444;
            color: white;
            text-decoration: none;
            padding: 10px 18px;
            border-radius: 6px;
        }
        .back-btn:hover {
            background-color: #222;
        }
    </style>
</head>
<body>

<header>ScriptWriteHub</header>

<div class="container">
    <div class="story-title"><?php echo htmlspecialchars($story['title']); ?></div>
<div class="story-meta">
    By <a href="view_profile.php?id=<?php echo $story['user_id']; ?>" style="color: #1877f2; text-decoration: none;">
        <?php echo htmlspecialchars($story['username']); ?>
    </a> 
    | Genre: <?php echo htmlspecialchars($story['genre']); ?>
</div>

    <div class="story-content"><?php echo nl2br(htmlspecialchars_decode($story['content'])); ?></div>

    <hr>

    <div class="comment-section">
        <h3>Comments</h3>

        <!-- Comment form -->
        <?php if (isset($_SESSION['user_id'])): ?>
            <form class="comment-form" method="post">
                <textarea name="comment" rows="3" placeholder="Write a comment..." required></textarea>
                <button type="submit">Post Comment</button>
            </form>
        <?php else: ?>
            <p><a href="login.php">Login</a> to post a comment.</p>
        <?php endif; ?>

        <!-- Display comments -->
        <?php foreach ($comments as $comment): ?>
            <div class="comment">
                <div class="avatar"></div>
                <div class="comment-box">
                    <div class="username"><?php echo htmlspecialchars($comment['username']); ?></div>
                    <div><?php echo nl2br(htmlspecialchars($comment['comment'])); ?></div>
                    <div class="time"><?php echo date("F j, Y g:i A", strtotime($comment['created_at'])); ?></div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <a href="genres.php" class="back-btn">Back to Genres</a>
</div>

</body>
</html>
