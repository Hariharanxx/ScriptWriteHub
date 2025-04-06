<?php
session_start();
include("db.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bio = $_POST['bio'];

    $profile_picture = null;
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
        $target_dir = "uploads/";
        $file_name = basename($_FILES["profile_picture"]["name"]);
        $target_file = $target_dir . time() . "_" . $file_name;

        if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
            $profile_picture = basename($target_file);
        }
    }

    $sql = "UPDATE users SET bio = :bio" . ($profile_picture ? ", profile_picture = :profile_picture" : "") . " WHERE id = :user_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':bio', $bio);
    if ($profile_picture) {
        $stmt->bindParam(':profile_picture', $profile_picture);
    }
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();

    header("Location: profile.php");
    exit();
}

// Fetch current data
$stmt = $conn->prepare("SELECT bio FROM users WHERE id = :user_id");
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Profile - ScriptWriteHub</title>
    <link rel="stylesheet" href="css/style4.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #121212;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .edit-profile-container {
            background-color: #1e1e1e;
            padding: 30px 40px;
            border-radius: 10px;
            width: 100%;
            max-width: 500px;
            box-shadow: 0 0 15px rgba(0,0,0,0.6);
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #00bfff;
        }

        label {
            display: block;
            margin: 12px 0 6px;
        }

        textarea, input[type="file"] {
            width: 100%;
            padding: 10px;
            background-color: #2a2a2a;
            border: 1px solid #444;
            border-radius: 6px;
            color: #fff;
            resize: none;
        }

        input[type="submit"] {
            background-color: #00bfff;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            margin-top: 20px;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #009acd;
        }
    </style>
</head>
<body>
    <div class="edit-profile-container">
        <h2>Edit Profile</h2>
        <form method="POST" enctype="multipart/form-data">
            <label for="bio">Bio:</label>
            <textarea name="bio" rows="5"><?php echo htmlspecialchars($user['bio']); ?></textarea>

            <label for="profile_picture">Profile Picture:</label>
            <input type="file" name="profile_picture">

            <input type="submit" value="Save Changes">
        </form>
    </div>
</body>
</html>
