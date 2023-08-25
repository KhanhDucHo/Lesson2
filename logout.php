<?php
// Start the session
session_start();

// Clear the "remember_email" cookie by setting its expiration time to the past
if (isset($_COOKIE["remember_email"])) {
    setcookie("remember_email", "", time() - 3600);
}

// Clear the user's session variables related to login (if they exist)
if (isset($_SESSION['email'])) {
    unset($_SESSION['email']);
    unset($_SESSION['role']);
}

// Redirect the user to the login page and prevent caching of the page
header("Location: login.php");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
exit;
?>
