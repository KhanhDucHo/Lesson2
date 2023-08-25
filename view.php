<?php 
require 'connect.php';
// Check if the 'id' parameter is set
if(isset($_GET['id'])){
    $id = $_GET['id'];
    // Retrieve user information based on the provided 'id'
    $sql = "SELECT * FROM `user_data` WHERE `id` = '$id'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        // Display user details
        echo "<h1>User Details</h1>";
        echo "<p><strong>Name:</strong> " . $row['name'] . "</p>";
        echo "<p><strong>Email:</strong> " . $row['email'] . "</p>";
        echo "<p><strong>Role:</strong> " . $row['role'] . "</p>";
    } else {
        echo "User not found!";
    }
} else {
    echo "Invalid request!";
}
?>
