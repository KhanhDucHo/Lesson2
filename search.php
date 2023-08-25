<?php
require 'connect.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Set character encoding & configure viewport for responsive design-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Set the page title and favicon -->
    <title>Search</title>
    <link rel="icon" href="image/favicon.png" type="image/png">  
    <!-- Load CSS files -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="css/theme.css" media="all">  
    <!-- Load Font Icon files -->
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <!-- Load Vendor CSS files -->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
</head>

<body>

<?php
if(isset($_POST['search'])){
    $s = $_POST['txtsearch'];

    // Check if the variable $s is empty
    if($s == ""){
        echo "Please enter a search term!";
    }else{
        // Search for user names containing the keyword $s
        $sql = "SELECT * FROM `user_data` WHERE `name` LIKE '%$s%'";
        $result = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($result);
        // Check if any results were found
        if($count <= 0){
            echo "No results found with the keyword <b>". $s ."</b>";
        }else{
            echo "<br>"; 
            echo "Found " . $count . " results with the keyword <b>" . $s . "</b>";
            echo "<br><br>";
        }
    }
}
?>

<!-- Display the list of found users -->
<div class="table-responsive table--no-card m-b-30">
    <table class="table table-borderless table-striped table-earning">
        <thead>
            <tr>
                <th>#</th>
                <th>fullname</th>
                <th>email</th>
                <th>role</th>
                <th>operation</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if (mysqli_num_rows($result) > 0) {
                $counter = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td><?php echo $counter ?></td>
                        <td><?php echo $row['name'] ?></td>
                        <td><?php echo $row['email'] ?></td>                                                    
                        <td>
                            <?php
                            if ($row['role'] == "Admin") {
                            ?>
                                <span class="role admin"><?php echo $row['role'] ?></span>
                            <?php } else { ?>
                                <span class="role user"><?php echo $row['role'] ?></span>
                            <?php
                                }
                            ?>
                        </td>
                        <td>
                            <div class="table-data-feature">
                                <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                    <a href="edit.php?id=<?php echo $row['id']; ?>"><i class="zmdi zmdi-edit"></i></a>
                                </button>
                                <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                    <a href="delete.php?id=<?php echo $row['id']; ?>"><i class="zmdi zmdi-delete"></i></a>
                                </button>
                                <button class="item" data-toggle="tooltip" data-placement="top" title="Copy">
                                    <a href="copy.php?id=<?php echo $row['id']; ?>"><i class="zmdi zmdi-copy"></i></a>
                                </button>
                                <button class="item" data-toggle="tooltip" data-placement="top" title="View">
                                    <a href="view.php?id=<?php echo $row['id']; ?>"><i class="zmdi zmdi-eye"></i></a>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <?php
                    $counter++;
                }
            }
            ?>
        </tbody>
    </table>
</div>
<button type="button" class="btn btn-warning">
    <a href="dashboard.php">Dashboard<a>
</button>
</body>

</html>
