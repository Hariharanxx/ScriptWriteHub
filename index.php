<?php
session_start();
$isLoggedIn = isset($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ScriptWriteHub</title>
    <link rel="stylesheet" href="css/styles.css?v=<?php echo time(); ?>" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link
      href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Playfair+Display:wght@500&display=swap"
      rel="stylesheet"
    />
  </head>
  <body>
    <div class="hero">
      <div class="overlay"></div>
      <header>
        <nav>
          <a href="register.php">Register</a>
          <a href="login.php">Login</a>
        </nav>
      </header>

      <div class="content">
        <h1 class="main-title">ScriptWriteHub</h1>
        <h2 class="fade-in">"Where Stories Come to Life"</h2>
        <a
          href="register.php"
          class="btn hover-effect"
          >Join Now</a
        >
      </div>
    </div>
    <script src="js/scripts.js?v=<?php echo time(); ?>"></script>
  </body>
</html>
