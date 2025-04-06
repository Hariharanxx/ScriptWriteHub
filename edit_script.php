<?php
session_start();
include("db.php");

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Check for story ID
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Invalid request.");
}

$story_id = $_GET['id'];
$user_id = $_SESSION['user_id'];

// Fetch the story
$query = "SELECT * FROM stories WHERE id = :id AND user_id = :user_id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':id', $story_id);
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$story = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$story) {
    die("Unauthorized access or story not found.");
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $short_description = $_POST['short_description'];
    $genre = $_POST['genre'];
    $content = $_POST['content'];

    $update = "UPDATE stories SET title = :title, short_description = :short_description, genre = :genre, content = :content WHERE id = :id AND user_id = :user_id";
    $update_stmt = $conn->prepare($update);
    $update_stmt->bindParam(':title', $title);
    $update_stmt->bindParam(':short_description', $short_description);
    $update_stmt->bindParam(':genre', $genre);
    $update_stmt->bindParam(':content', $content);
    $update_stmt->bindParam(':id', $story_id);
    $update_stmt->bindParam(':user_id', $user_id);
    $update_stmt->execute();

    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Story</title>
    <link rel="stylesheet" href="css/style3.css">
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f7f7f7;
            color: #333;
            margin: 0;
            padding: 0;
        }

        header {
            background: #121212;
            padding: 20px;
            text-align: center;
            font-size: 24px;
            color: #fff;
        }

        nav {
            position: absolute;
            top: 20px;
            right: 30px;
        }

        nav a {
            color: #fff;
            margin-left: 20px;
            text-decoration: none;
            font-size: 16px;
        }

        .form-container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        form label {
            display: block;
            margin-top: 20px;
            margin-bottom: 8px;
            font-weight: bold;
        }

        form input[type="text"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
        }

        form button {
            margin-top: 25px;
            padding: 12px 20px;
            background-color: #0078D7;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        form button:hover {
            background-color: #005fa3;
        }

        .ck-editor__editable {
            min-height: 400px;
        }
    </style>
</head>
<body>
    <header>
        Edit Your Story
        <nav>
            <a href="dashboard.php">Dashboard</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>

    <main class="form-container">
        <form method="POST">
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" value="<?php echo htmlspecialchars($story['title']); ?>" required>

            <label for="short_description">Short Description:</label>
            <input type="text" name="short_description" id="short_description" value="<?php echo htmlspecialchars($story['short_description']); ?>" required>

            <label for="genre">Genre:</label>
            <input type="text" name="genre" id="genre" value="<?php echo htmlspecialchars($story['genre']); ?>" required>

            <label for="content">Story Content:</label>
            <textarea name="content" id="content" required><?php echo htmlspecialchars_decode($story['content']); ?></textarea>

            <button type="submit">Update Story</button>
        </form>
    </main>

    <script>
        ClassicEditor
            .create(document.querySelector('#content'), {
                toolbar: {
                    items: [
                        'heading', '|',
                        'bold', 'italic', 'underline', 'strikethrough', '|',
                        'bulletedList', 'numberedList', '|',
                        'link', 'blockQuote', 'insertTable', 'undo', 'redo'
                    ]
                },
                placeholder: 'Start writing your story here...'
            })
            .catch(error => {
                console.error(error);
            });
    </script>
</body>
</html>
