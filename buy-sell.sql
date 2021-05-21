-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2020 at 01:51 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `buy-sell`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `p_id` int(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  `img` text NOT NULL,
  `details` varchar(255) NOT NULL,
  `ownerroll` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`p_id`, `name`, `img`, `details`, `ownerroll`) VALUES
(25, 'book', 'IMG_20190904_181941.jpg', 'this is notes and i want to sell it with 10000000000000000000 money coz u are fool and a idot', '222222222'),
(26, 'Notes checkiing spaces', 'IMG_20190904_181941.jpg', 'this is a test.this is a test.this is a test.this is a test.this is a test.this is a test.this is a test.this is a test.this is a test.this is a test.this is a test.this is a test.this is a test.this is a test.this is a test.this is a test.this is a test.', '123456789'),
(27, 'gsdh', '', 'aegdhs', '987654321'),
(28, 'Hero Babu', 'Koala.jpg', 'i am hero u want to buy me .', '111111111');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(255) NOT NULL,
  `year` smallint(6) NOT NULL,
  `roll` bigint(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact` bigint(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `year`, `roll`, `email`, `contact`, `password`, `id`) VALUES
('SELLER', 2, 123456789, 'seller@example.com', 9876543210, 'seller', 14),
('BUYER', 2, 987654321, 'buyer@example.com', 9876543211, 'buyer', 15),
('mayank', 2, 111111111, 'djhgsjk@hsdkj.com', 9876655443, '1234', 16),
('MOHAK', 2, 222222222, 'HFDA@LGDSJ.COM', 9876543210, '1234', 17),
('Mayank Mohak', 2, 190106017, 'mayank8199@gmail.com', 9525177622, '1234', 18);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `p_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
