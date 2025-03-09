<?php
session_start();
include("db.php"); // Ensure DB connection is correct

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = isset($_POST['title']) ? trim($_POST['title']) : '';
    $short_description = isset($_POST['short_description']) ? trim($_POST['short_description']) : '';
    $content = isset($_POST['content']) ? $_POST['content'] : ''; // ✅ Remove trim() to preserve HTML formatting
    $genre = isset($_POST['genre']) ? trim($_POST['genre']) : 'Uncategorized'; 

    if (!isset($_SESSION['user_id'])) {
        die("Error: You must be logged in to submit a story.");
    }

    $user_id = $_SESSION['user_id'];

    // ✅ Verify if user_id exists in users table
    $stmt = $conn->prepare("SELECT id FROM users WHERE id = :user_id");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();

    if ($stmt->rowCount() == 0) {
        die("Error: User ID does not exist.");
    }

    try {
        // ✅ Insert story with formatted content into database
        $query = "INSERT INTO stories (title, short_description, content, genre, user_id) VALUES (:title, :short_description, :content, :genre, :user_id)";
        $stmt = $conn->prepare($query);

        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':short_description', $short_description);
        $stmt->bindParam(':content', $content, PDO::PARAM_STR); // ✅ Save HTML content
        $stmt->bindParam(':genre', $genre);
        $stmt->bindParam(':user_id', $user_id);

        if ($stmt->execute()) {
            echo "<!DOCTYPE html>
<html>
<head>
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
</head>
<body>
    <script>
        Swal.fire({
            title: 'Success!',
            text: 'Your story has been uploaded!',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href = 'genres.php'; // ✅ Redirect to genres page instead of homepage
        });
    </script>
</body>
</html>";

            exit(); // ✅ Stop further execution
        } else {
            echo "Error uploading story.";
        }
    } catch (PDOException $e) {
        echo "Database error: " . $e->getMessage(); // ✅ Show error if insert fails
    }
}
?>
