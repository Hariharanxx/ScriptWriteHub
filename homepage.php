<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - ScriptWriteHub</title>
    <link rel="stylesheet" href="css/styles1.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Inter:wght@300;500;700&display=swap" rel="stylesheet">
</head>
<body>
    <header>
    <h1 class="home-title">Welcome to ScriptWriteHub</h1>
    <div class="hamburger" id="hamburger">
        <div></div>
        <div></div>
        <div></div>
    </div>
    <nav class="nav-links" id="navLinks">
        <a href="dashboard.php">Dashboard</a>
        <a href="profile.php">Profile</a>
        <a href="inbox.php">Inbox</a>
        <a href="logout.php">Logout</a>
    </nav>
     <div class="overlay" id="overlay"></div>
</header>

    <main class="home-main">
        <h2 class="tagline">"Upload Your Script to Give Life"</h2>
        <p>Your creativity deserves the spotlight. Share your story with the world.</p>
        <a href="upload.php" class="btn">Upload your story</a>
    </main>

    <section class="genres-section">
        <h2 class="genres-title">🎬 Discover & Connect with Amazing Stories!</h2>
        <p>Browse scripts across different genres and engage with talented filmmakers.</p>
        <a href="genres.php" class="btn genres-btn">Explore All Genres</a>
    </section>

    <section class="quotes-section">
        <h3>Cinematic Wisdom</h3>
        <div class="quotes">
            <blockquote>
                "A script should breathe life into a film, not just tell a story."  
                <span>- Mani Ratnam</span>
            </blockquote>
            <blockquote>
                "Cinema is the mirror of society, and the script is its soul."  
                <span>- Kamal Haasan</span>
            </blockquote>
            <blockquote>
                "A good story haunts the writer before it haunts the audience."  
                <span>- Mysskin</span>
            </blockquote>
        </div>
    </section>

    <section class="cta-section">
        <h2>🎥 Ready to Share Your Story?</h2>
        <p>Join the community of filmmakers and bring your script to life.</p>
        <a href="upload.php" class="btn">Start Uploading</a>
    </section>

    
    <footer>
        <div class="footer-content">
            <p>© 2025 ScriptWriteHub. All Rights Reserved.</p>
            <nav class="footer-nav">
                <a href="includes/about.html">About</a>
                <a href="includes/contact.html">Contact</a>
                <a href="includes/privacy.html">Privacy Policy</a>
                <a href="includes/terms.html">Terms of Service</a>
            </nav>
        </div>
    </footer>
     <script src="js/scripts.js?v=<?php echo time(); ?>"></script>
</body>
</html>
