<?php 
    // Database connection configuration
    $host = "localhost";       
    $username = "root";        
    $password = "";           
    $dbname = "user_management";

    // Create a new MySQLi database connection
    $conn = new mysqli($host, $username, $password, $dbname);
    
    // Check if the connection fails
    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }
?>
