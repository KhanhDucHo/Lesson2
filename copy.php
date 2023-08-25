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
        // Create a copy of the user with an incrementing ordinal number
        $baseName = $row['name'];
        $newName = $baseName;
        $copyNumber = 0;
        while (true) {
            // Check if the copy name already exists
            $sql = "SELECT * FROM `user_data` WHERE `name` = '$newName'";
            $result = mysqli_query($conn, $sql);         
            if (mysqli_num_rows($result) > 0) {
                // Name already exists, try with another incrementing ordinal number
                $copyNumber++;
                $newName = $baseName . ' ' . $copyNumber;
            } else {
                // Name doesn't exist, use this new name
                break;
            }
        }
        $newEmail = $row['email'];
        $newPassword = $row['password'];
        $newRole = $row['role'];
        // Insert the copy into the database with the same password and role
        $sql = "INSERT INTO `user_data` (`name`, `email`, `password`, `role`) VALUES ('$newName', '$newEmail', '$newPassword', '$newRole')";
        $result = mysqli_query($conn, $sql);
        if($result) {
            header("location: dashboard.php");
        } else {
            echo "Error creating copy: " . mysqli_error($conn);
        }
    } else {
        echo "User not found!";
    }
} else {
    echo "Invalid request!";
}
?>

