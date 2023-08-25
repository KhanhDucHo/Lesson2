<?php
require 'connect.php';
session_start();
header('Content-Type: text/html; charset=UTF-8');

// Check if the login form has been submitted
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    // Check if both email and password are provided
    if (!$email || !$password) {
        //  Redirect to the login page and display an error message
        $_SESSION['redirect_from'] = 'handle1';
        header("Location: login.php");
        exit;
    }
    // Query the database to retrieve user information based on the provided email
    $query = "SELECT `email`, `password` FROM `user_data` WHERE `email`='$email'";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $row = mysqli_fetch_array($result);
    // Check if the provided email exists in the database
    if ($email != $row['email']) {
        $_SESSION['redirect_from'] = 'handle2';
        header("Location: login.php");
        exit;
    } else {
        // Check if the provided password matches the database record
        if ($password != $row['password']) {
            $_SESSION['redirect_from'] = 'handle3';
            header("Location: login.php");
            exit;
        }
        // Check if the "Remember me" checkbox is selected
        if (isset($_POST['remember'])) {
            // Store login information in a cookie to enable "Remember me" functionality
            setcookie("remember_email", $email, time() + 3600 * 6); // Cookie expires in 6 hours
        }
        // Set the 'email' session variable to track the logged-in user
        $_SESSION['email'] = $email;
        // Redirect the user to the dashboard page upon successful login
        header("location: dashboard.php");
        exit; 
    }
}
?>
