<?php
session_start();

// Process the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['display_modal'] = true;
    header("Location: register.php");
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
    <title>Login</title>
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
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="#">
                                <img src="image/Logo.png" alt="CoolAdmin">
                            </a>
                        </div>
                        <div class="login-form">
                            <form action="reg.php" method="POST">
                                <div class="form-group">
                                    <label>Full name</label>
                                    <input class="au-input au-input--full" type="text" name="name" placeholder="Name">
                                </div>
                                <div class="form-group">
                                    <label>Email address</label>
                                    <input class="au-input au-input--full" type="email" name="email" placeholder="Email">
                                    <p>
                                        We'll never share your email with anyone else.
                                    </p>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="au-input au-input--full" type="password" name="password" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <label>Confirm password</label>
                                    <input class="au-input au-input--full" type="password" name="confirm_pass" placeholder="Confirm password">
                                </div>
                                <input name="btn-reg" value="register" class="au-btn au-btn--block au-btn--green m-b-20" type="submit"></button>
                            </form>
                            <div class="register-link">
                                <p>
                                    Already have account?
                                    <a href="login.php">Sign In</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal modal-message fade" id="ModalConfirm1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="fa fa-close"></i>
                    </button>
                    <h2>Thất bại</h2>
                    <p>Vui lòng điền đẩy đủ thông tin. </p>
                </div>
            </div>
        </div>
    </div>
    <div class="modal modal-message fade" id="ModalConfirm2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="fa fa-close"></i>
                    </button>
                    <h2>Thất bại</h2>
                    <p>Mật khẩu xác nhận không chính xác. </p>
                </div>
            </div>
        </div>
    </div>
    <?php
    // Check if the 'redirect_from' session variable is set
    if (isset($_SESSION['redirect_from'])) {     
        // Depending on the value of 'redirect_from', display a corresponding modal window
        if ($_SESSION['redirect_from'] === 'reg1') {
        ?>
        <script>
            // When the window loads, show the 'ModalConfirm1' modal
            window.onload = function() {
                $('#ModalConfirm1').modal('show');
            };
        </script>
        <?php
        } elseif ($_SESSION['redirect_from'] === 'reg2') {
        ?>
        <script>
            window.onload = function() {
                $('#ModalConfirm2').modal('show');
            };
        </script>
        <?php
        }
    }
    // Unset the 'redirect_from' session variable to prevent further redirections
    unset($_SESSION['redirect_from']);
    ?>


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