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
    <!-- 🔹 Quill.js Styles -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
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
            <div id="editor" style="height: 300px;"></div> <!-- 🔹 Quill Editor -->
            <input type="hidden" name="content" id="story-content"> <!-- Hidden Input -->

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

    <!-- 🔹 Quill.js Scripts -->
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script>
        var quill = new Quill('#editor', {
            theme: 'snow'  // 'snow' theme gives a clean, modern UI
        });

        // When the form is submitted, copy Quill content into the hidden input
        document.querySelector("form").onsubmit = function() {
            document.querySelector("#story-content").value = quill.root.innerHTML;
        };
    </script>
       <script src="js/scripts.js"></script>
</body>
</html>

