<?php
require 'db.php'; // Connect to MySQL

if ($_SERVER["REQUEST_METHOD"] == "POST") { // Check if form is submitted
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Encrypt password

    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->execute([$username, $email, $password]);

    header("Location: login.php"); // Redirect to login after registration
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - ScriptWriteHub</title>
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Playfair+Display:wght@500&display=swap" rel="stylesheet">
</head>
<body>
    <div class="form-container">
        <h1 class="form-title">Join ScriptWriteHub</h1>
        <form id="register-form" action="register.php" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" class="btn">Register</button>
            <p class="form-text">Already have an account? <a href="login.php">Login</a></p>
        </form>
    </div>
    <script src="js/scripts.js"></script>
</body>
</html>
