-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th8 24, 2023 lúc 12:03 PM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `user_management`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_data`
--

CREATE TABLE `user_data` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(30) NOT NULL,
  `role` enum('Admin','User') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `user_data`
--

INSERT INTO `user_data` (`id`, `name`, `email`, `password`, `role`) VALUES
(1, 'Lampart Admin', 'lampart@gmail.com', '123456', 'Admin'),
(2, 'Nguyễn Văn Anh', 'vananh@gmail.com', 'vananh123', 'User'),
(3, 'Trần Đức Minh', 'ducminh@gmail.com', 'ducminh123', 'User'),
(4, 'Nguyễn Thị Hương', 'thihuong@gmail.com', 'thihuong123', 'User'),
(5, 'Trần Thị Mai Anh', 'maianh@gmail.com', 'maianh123', 'User'),
(6, 'Nguyễn Huy Đức', 'huyduc@gmail.com', 'huyduc123', 'User'),
(7, 'Trần Thị Thu Hà', 'thuha@gmail.com', 'thuha123', 'User'),
(8, 'Trần Minh Khánh', 'minhkhanh@gmail.com', 'minhkhanh123', 'User'),
(9, 'Lê Thị Mai Linh', 'mailinh@gmail.com', 'mailinh123', 'User'),
(10, 'Hoàng Thanh Tùng', 'thanhtung@gmail.com', 'thanhtung123', 'User'),
(11, 'Lê Quang Tuấn', 'quangtuan@gmail.com', 'quangtuan123', 'User'),
(12, 'Hoàng Thị Thanh Hương', 'thanhhuong@gmail.com', 'thanhhuong123', 'User');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `user_data`
--
ALTER TABLE `user_data`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `user_data`
--
ALTER TABLE `user_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
