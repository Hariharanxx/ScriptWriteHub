<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Write Your Story - ScriptWriteHub</title>
    <link rel="stylesheet" href="css/style2.css">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Inter:wght@300;500;700&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <h1 class="upload-title">Write & Share Your Story</h1>
        <nav>
            <a href="dashboard.html">Dashboard</a>
            <a href="homepage.php">Home</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>

    <main class="upload-container">
        <form action="upload_process.php" method="POST">
            <label for="story-title">Title of Your Story</label>
            <input type="text" id="story-title" name="title" placeholder="Enter story title" required>

            <!-- 🔹 Added Short Description Field -->
            <label for="short-description">Short Description</label>
            <textarea id="short-description" name="short_description" placeholder="Write a short summary of your story..." required></textarea>

            <label for="story-content">Your Story</label>
            <textarea id="story-content" name="content" placeholder="Write your story here..." required></textarea>

            <!-- 🔹 Genre Dropdown (No Changes) -->
            <label for="genre">Choose a Genre</label>
            <select name="genre" id="genre" required>
                <option value="Aritistic">Aritistic</option>
                <option value="Fantasy">Fantasy</option>
                <option value="Science Fiction">Science Fiction</option>
                <option value="Commercial">Commercial</option>
                <option value="Experimental">Experimental</option>
            </select>

            <button type="submit" class="btn">Publish Story</button>
        </form>
    </main>

    <script src="js/scripts.js"></script>
</body>
</html>
