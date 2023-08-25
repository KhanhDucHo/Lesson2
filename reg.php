<?php
require 'connect.php';
session_start();

if(isset($_POST['btn-reg']))
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_pass = $_POST['confirm_pass'];

    // Kiểm tra xem tất cả các trường đã được điền đầy đủ
    if(empty($name) || empty($email) || empty($password) || empty($confirm_pass)) {    
        $_SESSION['redirect_from'] = 'reg1';
        header("Location: register.php");
        exit;
    } else {
        // Kiểm tra mật khẩu và xác nhận mật khẩu có trùng khớp hay không
        if($password !== $confirm_pass) {
            // Mật khẩu không trùng khớp, hiển thị modal thông báo lỗi
            $_SESSION['redirect_from'] = 'reg2';
            header("Location: register.php");
            exit;
        } else {
            // Tiến hành thêm dữ liệu vào cơ sở dữ liệu
            $sql = "INSERT INTO `user_data` (`name`, `email`, `password`, `role`) 
            VALUES('$name', '$email', '$password', 'User')";

            if($conn->query($sql) === TRUE) {
                header("location: login.php");
            } else {
                echo "Lỗi {$sql}".$conn->error;
            }
        }
    }
}
?>