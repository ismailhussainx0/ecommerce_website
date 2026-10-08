-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 08, 2026 at 08:57 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) DEFAULT NULL,
  `product_price` int(11) DEFAULT NULL,
  `product_description` text DEFAULT NULL,
  `product_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_price`, `product_description`, `product_image`) VALUES
(3, 'xyz', 200, 'asdfasdfasdfasdfasdfadfdfdfasdfdf', 'contactscreenshot.png'),
(6, 'abcuosjddf', 300, 'ismail hiasdfi asdfia \r\n fasdf', 'Screen.png'),
(9, 'bag', 1234, 'iasdfmiasdf;klja;sdfja;skldfi;alsdfji;aisd;fklj;aisd;fjl;oaisdfkiasdfj;lias;dfj;asdfi;asdj;f', 'contactscreenshot.png'),
(10, 'aasdf', 70000, 'iaskdf;asdfias;ldfias;df', 'contactscreenshot.png'),
(11, 'bag', 234, 'asdfasdfsdf', 'Screen.png'),
(12, 'shoes', 200, 'iasmdfaisdfua;lskdfj;lasjifas;jklf', 'screenshot.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `role`) VALUES
(1, 'ismail', 'ismail@gmail.com', '$2y$10$Pdl3eY0ap89HSZTIqAn/POwVPNutgwmQmB3ibaUl0Q.M1HXOkOVuC', 'user'),
(6, 'ayan', 'ayan@gmail.com', '$2y$10$EzTYj5A2q1jOXkYLUpta/uA9OBB4FySkRagxd6LkDMSHR8Ml.BcMC', NULL),
(7, 'shayan', 'shayan@gmail.com', '$2y$10$D5VnASzL7pTE/bGmPZQ1oOJ8rusaKAouBOH9xrdL/Z0me.jG1sKK6', NULL),
(8, 'hammad', 'hammad@gmail.com', '$2y$10$KEMwDKLSaAMmSnDRXBa8U.5jc2yhYU4TDF1YDa2B2pKXX8s7lY10m', NULL),
(9, 'the', 'the@gmail.com', '$2y$10$OekEL2LqCD0JOUy5RdtMBe49KUd2kzjdavERknAgpeb5fJ/L3fMDO', 'user'),
(10, 'admin', 'admin321@gmail.com', '$2y$10$CenWe0iUxUcfB6kh76qANu0pXZC0QIBI2jx99VFKi.yZyW6WgPm0u', 'admin'),
(11, 'hello', 'hello@gmail.com', '$2y$10$MbWE//b8MBoczXzYS6npAOHus2sApWLYM.Ol24YH73BcLpOwtRILy', 'user'),
(12, 'myname', 'myname@gmail.com', '$2y$10$sEXtTjpDBk1uotN8TIqYNeW8IfwIX3i506YjOrRUP6U.puovOYbJG', 'user'),
(13, 'anas', 'anas@gmail.com', '$2y$10$eb7uiXlHDyNk.bdEGj0W6efaK4ifraSOUisH6G9eaix/i7VQQ3a3i', 'user'),
(14, 'Ismail Hussain', 'root@gmail.com', '$2y$10$0H8/qkoM90bxtrTrlNuyEe38699QHPzHLbF78O/TGC0XXpgUv3hy.', 'user'),
(15, 'umair', 'umair@gmail.com', '$2y$10$F7mnSfYJJIqv7QKRpaFlqeKW01BPrM/yyaWX8IaleOYmZcHiAvFfS', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
