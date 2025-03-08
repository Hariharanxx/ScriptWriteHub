<?php
session_start();
include("db.php"); // Ensure DB connection is correct

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = isset($_POST['title']) ? trim($_POST['title']) : '';
    $content = isset($_POST['content']) ? trim($_POST['content']) : '';

    if (!isset($_SESSION['user_id'])) {
        die("Error: You must be logged in to submit a story.");
    }

    $user_id = $_SESSION['user_id'];

    // ✅ Verify if user_id exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE id = :user_id");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();

    if ($stmt->rowCount() == 0) {
        die("Error: User ID does not exist.");
    }

    try {
        // ✅ Insert story into database
        $query = "INSERT INTO stories (title, content, user_id) VALUES (:title, :content, :user_id)";
        $stmt = $conn->prepare($query);

        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
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
            window.location.href = 'homepage.php'; // Redirect to homepage
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
