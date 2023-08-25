<?php
require 'connect.php';
session_start();

// Check if the user is logged in via an active session or a "remember_email" cookie
if (isset($_SESSION['email']) || isset($_COOKIE["remember_email"])) {
    $email = isset($_SESSION['email']) ? $_SESSION['email'] : $_COOKIE["remember_email"];

    // SQL query to retrieve the user's role based on their email
    $query = "SELECT `role` FROM `user_data` WHERE `email` = '$email'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $userRole = $row['role'];
    } else {
        $userRole = 'User';  // If the query didn't return results, set a default role to 'User'
    }
} else {
    // If there's no active session and no "remember_email" cookie, redirect the user to the login page
    header("Location: login.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Set character encoding & configure viewport for responsive design-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Set the page title and favicon -->
    <title>Dashboard</title>
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

<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="index.html">
                            <img src="image/Logo.png" alt="" />
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                        <li>
                            <a href="dashboard.php">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- END HEADER MOBILE-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="logo">
                    <a href="index.html">
                        <img src="image/Logo.png" alt="" />
                    </a>
                </div>
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <div class="header-button">
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">                                        
                                        <?php
                                        // Select the 'name' column from the 'user_data' table based on '$email'
                                        $query = "SELECT `name` FROM `user_data` WHERE `email` = '$email'";
                                        $result = mysqli_query($conn, $query);
                                        if ($result && mysqli_num_rows($result) > 0) {
                                            $row = mysqli_fetch_assoc($result);
                                        }
                                        ?>
                                        <div class="image">
                                            <img src="image/avatar.webp" alt="Khánh Đức" />
                                        </div>
                                        <div class="content js-acc-btn">
                                            <a class="js-acc-btn" href="#">
                                            <?php echo $row['name']; //display the 'name' ?>
                                            </a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    <a href="#">
                                                        <img src="image/avatar.webp" alt="Khánh Đức" />
                                                    </a>
                                                </div>
                                                <div class="content">
                                                <h5 class="name">
                                                <?php echo $row['name']; ?>
                                                </h5>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="#">
                                                        <i class="zmdi zmdi-account"></i>Account</a>
                                                </div>
                                                <div class="account-dropdown__item">
                                                    <a href="#">
                                                        <i class="zmdi zmdi-settings"></i>Setting</a>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__footer">
                                                <a href="logout.php"><i class="zmdi zmdi-power"></i>Logout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- END HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <?php 
                        // Allows searching for Admin
                        if ($userRole === 'Admin' ) {
                        ?>
                            <form class="form-header" action="search.php" method="POST">
                                <input class="au-input au-input--xl" type="text" name="txtsearch" placeholder="Tìm kiếm tên người dùng..." />
                                <button class="au-btn--submit" type="submit" name="search" value="search">
                                    <i class="zmdi zmdi-search"></i>
                                </button>
                        </form>
                        <?php
                        }
                        // SQL query to count total users
                        $sql = "SELECT COUNT(*) as total FROM `user_data`";
                        $result = mysqli_query($conn, $sql);
                        
                        // Check if the query was successful
                        if ($result) {
                            $row = mysqli_fetch_assoc($result);
                            $totalUsers = $row['total'];
                        } else {
                            $totalUsers = 0; // Set a default of 0 in case of query error
                        }

                        // Determine the number of users per page
                        $usersPerPage = 5; // Number of users displayed per page
                        $totalPages = ceil($totalUsers / $usersPerPage); // Calculates the total number of pages required

                        if (isset($_GET['page']) && is_numeric($_GET['page'])) {
                            // Check if the 'page' parameter is set and is a numeric value
                            $currentPage = intval($_GET['page']); // Set the current page to the value provided in the URL
                        } else {
                            $currentPage = 1;   //Default to the first page
                        }
                        
                        // Calculate LIMIT and OFFSET for data query
                        $offset = ($currentPage - 1) * $usersPerPage;

                        // SQL query to fetch user data with pagination
                        $sql = "SELECT * FROM `user_data` LIMIT $usersPerPage OFFSET $offset";
                        $result = mysqli_query($conn, $sql);

                        // Display the list of users
                        if (mysqli_num_rows($result) > 0) {
                            $counter = ($currentPage - 1) * $usersPerPage + 1; // Calculate the starting user number on the current page
                            ?>
                            <div class="row">
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
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                // Condition allows displaying user information for Admin and the logged-in User
                                                if ($userRole === 'Admin' || ($userRole === 'User' && $row['email'] === $email)) {
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
                                                }
                                                $counter++;
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                            <!-- Display Pagination -->
                            <?php
                            // Check if the user's role is 'Admin' and there are more than one page of users
                            if ($userRole === 'Admin' && $totalPages > 1) {
                            ?>
                            <div class="row">
                                <nav class="blog-pagination justify-content-center d-flex">
                                    <ul class="pagination">
                                        <?php 
                                        for ($i = 1; $i <= $totalPages; $i++) {
                                            // Determine if the current page is active
                                            $active = ($i == $currentPage) ? 'active' : '';
                                            // Generate a list item for the page link with appropriate styling
                                            echo "<li class='page-item $active'><a href='?page=$i' class='page-link'>$i</a></li>";
                                        }
                                        ?>
                                    </ul>
                                </nav>
                            </div>
                            <?php
                            }
                        } else {
                            // Display a message when no results are found
                            echo '<div class="row"><div class="table-responsive table--no-card m-b-30"><table class="table table-borderless table-striped table-earning"><tbody><tr><td colspan="5">No users found.</td></tr></tbody></table></div></div>';
                        }
                        ?>

                        <!--================ start footer Area  =================-->	
                            <div class="border_line"></div>
                            <div class="row footer-bottom d-flex justify-content-between align-items-center">
                                <p class="col-lg-6 col-sm-12 footer-text">
                                    Copyright &copy;<script>document.write(new Date().getFullYear());</script> - All rights reserved</a>
                                </p>
                            </div>
                    <!--================ End footer Area  =================-->
                </div>
            </div>
        </div>
    </div>

    <!-- Load jQuery library -->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Load Bootstrap library (v4.1) for enhanced UI components -->
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Load Animsition library (for page transitions) -->
    <script src="vendor/animsition/animsition.min.js"></script>
    <!-- Load the main JavaScript file for custom scripts -->
    <script src="js/main.js"></script>

</body>

</html>