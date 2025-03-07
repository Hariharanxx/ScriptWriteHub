<?php
$host = "localhost";
$dbname = "scriptwritehub";
$username = "root";  // Default username in XAMPP
$password = "";      // Default password is empty in XAMPP

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
