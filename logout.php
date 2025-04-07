<!-- filepath: c:\xampp\htdocs\ScriptWriteHub\logout.php -->
<?php
// Start the session
session_start();

// Destroy all session data
session_unset();
session_destroy();

// Redirect to the index page
header("Location: index.php");
exit();
?>