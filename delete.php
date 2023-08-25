<?php
require 'connect.php';
// Check if the 'id' parameter is set
if(isset($_GET['id'])){
    $id = $_GET['id'];
}
// Delete a user record based on the provided 'id'
$sql = "DELETE FROM `user_data` WHERE `id` = '$id'";
$result = mysqli_query($conn, $sql);
// Redirect the user to the dashboard page after deleting the record
header("location: dashboard.php");
?>
