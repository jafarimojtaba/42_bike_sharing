-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2022 at 12:33 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bike_sharing`
--

-- --------------------------------------------------------

--
-- Table structure for table `activation_code`
--

CREATE TABLE `activation_code` (
  `id` int(11) NOT NULL,
  `email` varchar(80) DEFAULT NULL,
  `intraname` varchar(80) DEFAULT NULL,
  `sent_code` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `activation_code`
--

INSERT INTO `activation_code` (`id`, `email`, `intraname`, `sent_code`) VALUES
(1, 'test1@students.42wolfsburg.de', 'test1', 249981),
(2, 'test1@42wolfsburg.de', 'test2', 282836),
(3, 'test5@students.42wolfsburg.de', 'test5', 325453),
(4, 'test6@students.42wolfsburg.de', 'test6', 911306),
(5, 'test7@42wolfsburg.de', 'test7', 904442),
(6, 'salam@students.42wolfsburg.de', 'salam', 142436),
(7, 'sajad@students.42wolfsburg.de', 'sajad', 838717),
(8, 'sajad2@students.42wolfsburg.de', 'sajad2', 788758);

-- --------------------------------------------------------

--
-- Table structure for table `bike`
--

CREATE TABLE `bike` (
  `id` int(11) NOT NULL,
  `pass_before` varchar(80) DEFAULT NULL,
  `pass_now` varchar(80) DEFAULT NULL,
  `pass_next` varchar(80) DEFAULT NULL,
  `available_status` int(11) DEFAULT NULL,
  `hold_by` varchar(80) DEFAULT 'Nobody'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bike`
--

INSERT INTO `bike` (`id`, `pass_before`, `pass_now`, `pass_next`, `available_status`, `hold_by`) VALUES
(42, NULL, '4242', NULL, 0, 'Nobody'),
(43, '7622', '1116', '7667', 0, 'mjafari');

-- --------------------------------------------------------

--
-- Table structure for table `borrowed_bike`
--

CREATE TABLE `borrowed_bike` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `bike_id` int(11) DEFAULT NULL,
  `date_borrowed` timestamp NULL DEFAULT NULL,
  `date_returned` timestamp NULL DEFAULT NULL,
  `username` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `borrowed_bike`
--

INSERT INTO `borrowed_bike` (`id`, `user_id`, `bike_id`, `date_borrowed`, `date_returned`, `username`) VALUES
(1, 2, 43, '2022-10-10 07:17:42', '2022-10-10 07:17:51', 'mjafari'),
(2, 10, 43, '2022-10-10 10:00:12', '2022-10-10 10:00:16', 'sajad2'),
(3, 10, 43, '2022-10-10 10:00:17', '2022-10-10 10:00:20', 'sajad2'),
(4, 10, 43, '2022-10-10 10:00:28', '2022-10-10 10:00:29', 'sajad2'),
(5, 2, 43, '2022-10-10 10:01:52', NULL, 'mjafari');

-- --------------------------------------------------------

--
-- Table structure for table `new_user`
--

CREATE TABLE `new_user` (
  `id` int(11) NOT NULL,
  `username` varchar(80) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL,
  `authKey` varchar(255) DEFAULT NULL,
  `accessToken` varchar(255) DEFAULT NULL,
  `role` varchar(80) DEFAULT 'student',
  `has_booking` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `new_user`
--

INSERT INTO `new_user` (`id`, `username`, `password`, `email`, `authKey`, `accessToken`, `role`, `has_booking`) VALUES
(2, 'mjafari', '$argon2i$v=19$m=65536,t=4,p=1$elpPcy9UeDFEVkh0Sy9saQ$XW/6d7cMv5F8AT+cZcCUtPygqc9pTYDnjYksQ41XQQE', 'mjafari@students.42wolfsburg.de', '17c671e3b3e12adeb3f2f3019e64eadd', '$2y$10$cFkEQWuCWkGXfFcG4f1GCeUTDg6PaE1vPWjR3bemAGG2sWiNra4R.', 'admin', 1),
(3, 'mjafari3', '$argon2i$v=19$m=65536,t=4,p=1$UVlvMU5zV0V4Rmoza0dmUg$CEK42aTCMEMA+u9xDBcofQGwPCen17TsaXn86KkM6ww', 'mjafari3@students.42wolfsburg.de', '2566e90b17577644fa0f8d561037a4bc', '$2y$10$dPr9fm8AdWn5VhyiWQSsauvO8F/IAI9EfzAafeh/oipCOj1LY4oLq', 'student', 0),
(4, 'mjafari2', '$argon2i$v=19$m=65536,t=4,p=1$QVpGZC5MLnRyNTNvMmEzSw$gBnioa7uth2T8UDEg2gKSNL3NBzq82J8KnmwA5wkbuM', 'mjafari2@students.42wolfsburg.de', 'c4bdd9817823d73e1d50feff8d94dd34', '$2y$10$FMWtvESA95uDove0KneCc.HSwJDrlJNAa.OnkG/8IT9EKHpfXr5s6', 'student', 0),
(5, 'test1', '$argon2i$v=19$m=65536,t=4,p=1$YlVUcXkzdUk4OWNXWC9kZA$1ijE52qDXLb4f8b+tLFR9FZnVaIC1/A87QJIgsG9pnQ', 'test1@students.42wolfsburg.de', 'ff2d966fb44d919206f1192881125dc3', '$2y$10$gGIYHGF6RXXB9zgW1UQgf.yIeJGrFSHUvD9bZ4qCArs4GFfYKY42e', 'student', 0),
(6, 'test5', '$argon2i$v=19$m=65536,t=4,p=1$US9wVmJySE5Gd05KbzFTaA$bA0twAKOYVXyTmLIcW92hway0Zkz3OAqbhO2Qv0MX3M', 'test5@students.42wolfsburg.de', '2f1f12b62f0e584c1ca54df68ea8ff3f', '$2y$10$pAWYE2I90zdBzru93PaJHO7lFwF/i.Sg74WXqpfzsbsaZ5WHXcmgC', 'student', 0),
(7, 'test6', '$argon2i$v=19$m=65536,t=4,p=1$UHV5MUxEQ1pxeWwuVmM3Lg$9Pp/i7RQdtN0KS5gY1iNCNhH9bhB1UK91dwzbZ7id0Y', 'test6@students.42wolfsburg.de', '7d1e4e534bc7300a171fd397a8487958', '$2y$10$QBRwFWh/y1ksx6eUJGP6iuTvEdW0ZHzdzvDf3YpQBlGwIXOBp.9n6', 'student', 0),
(8, 'test7', '$argon2i$v=19$m=65536,t=4,p=1$V1RVdHp6V3FZUVZ5T3R2dQ$ofXwk2ORV10vgQgAKB8eKyPE+2W9sDDEtGurarvI3Bw', 'test7@42wolfsburg.de', '30323e3632e67dde1487e30bf28a3bf0', '$2y$10$DyemBbwHv52ciRLfMc4dlOQxgYj46AzapiOPo8GLHia8HVBok21sa', 'student', 0),
(9, 'sajad', '$argon2i$v=19$m=65536,t=4,p=1$cU51MjM4WUpxVnJBNDhHaw$zsy582iA8w+2rN2Tq5o7X763InEOtUaRYy1NKCzrEAk', 'sajad@students.42wolfsburg.de', '318ec9103b05174139489e701a605ef9', '$2y$10$Jd1pV64aVV7H8Vyt/PdlnO3fJTba0xNJGAxM6FJhSWHzWEnSdmfsu', 'student', 0),
(10, 'sajad2', '$argon2i$v=19$m=65536,t=4,p=1$MFUvYVB4Ni8zOHF6VzVpcA$UiwqTAWjfYWtshY5LrJT5HKA9mpir59QKuuCC4SQXPE', 'sajad2@students.42wolfsburg.de', 'c76545b99e23666a5593633b4bb07680', '$2y$10$ZIMsaOV7q.kC.kbYjT.Ps.g8bF4i82Bg9T0Eiic4yEPSFPXI/vFMy', 'student', 0),
(11, 'mjafari25', '$argon2i$v=19$m=65536,t=4,p=1$TnNRMUxKaFhjSjdXekE1cw$FfMpuV7Kp9kXCLqg6PJijlVvdxQUgkAUSMs4oB5AX4U', 'mdf@gmail.com', '16e21740352a792c7d3858f4b5322e5e', '$2y$10$C8Kd9qfw1LAHkguBKaJ73.aAr4CnXEv0SZXrv7LsaWSu2.Mkj5khW', 'student', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activation_code`
--
ALTER TABLE `activation_code`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `intraname` (`intraname`);

--
-- Indexes for table `bike`
--
ALTER TABLE `bike`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `borrowed_bike`
--
ALTER TABLE `borrowed_bike`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `bike_id` (`bike_id`);

--
-- Indexes for table `new_user`
--
ALTER TABLE `new_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activation_code`
--
ALTER TABLE `activation_code`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `borrowed_bike`
--
ALTER TABLE `borrowed_bike`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `new_user`
--
ALTER TABLE `new_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `borrowed_bike`
--
ALTER TABLE `borrowed_bike`
  ADD CONSTRAINT `borrowed_bike_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `new_user` (`id`),
  ADD CONSTRAINT `borrowed_bike_ibfk_2` FOREIGN KEY (`bike_id`) REFERENCES `bike` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
