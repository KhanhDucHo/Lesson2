<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Title and favicon -->
        <link rel="icon" href="image/favicon.png" type="image/png">
        <title>Edit</title>
        <!-- CSS -->
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/responsive.css">
    </head>
    <body>
    </body>
</html>

<?php 
require 'connect.php';
// Check if the 'id' parameter is set in the URL 
if(isset($_GET['id'])){
    $id = $_GET['id'];
}
// Check if the 'edit' form has been submitted
if(isset($_POST['edit'])){
    // Retrieve values from the 'edit' form
    $name = $_POST['name'];
    $email = $_POST['email'];
    print_r($_POST);
    // Update user data based on the provided 'id'
    $sql = "UPDATE `user_data` SET `name` = '$name', `email`= '$email' WHERE `id` = '$id'";
    $result = mysqli_query($conn, $sql);
    // Redirect the user to the dashboard page after editing
    header("location: dashboard.php");
}
// Retrieve user data based on the provided 'id'
$sql = "SELECT * FROM `user_data` WHERE `id` = '$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
?>

<form method="POST" action="">
    <label>Name</label><input type="text" name = "name" value="<?php echo $row['name']; ?>" /><br /><br />
    <label>Email</label><input type="text" name = "email" value="<?php echo $row['email']; ?>" /><br /><br /><br />
    <input type="submit" name="edit" value="EDIT" />
</form>