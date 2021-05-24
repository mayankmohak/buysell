-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2021 at 01:34 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
  `ownerroll` varchar(9) DEFAULT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'available',
  `price` varchar(255) DEFAULT NULL,
  `buyingkey` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`p_id`, `name`, `img`, `details`, `ownerroll`, `status`, `price`, `buyingkey`) VALUES
(26, 'Notes checking spaces', 'IMG_20190904_1819411.jpg', 'This is a test. This is a test. This is a test.this is a test.this is a test.this is a test.this is a test.this is a test.this is a test.this is a test.this is a test.this is a test.this is a test.this is a test.this is a test.this is a test.this is a tes', '987654321', 'cancelled', '50', 'asd'),
(27, 'Thor', 'B_thor4_s1SbvbIc.jpg', 'Can to buy it.', '190106017', 'available', '56', 'asdf'),
(28, 'Hero Babu', 'Koala.jpg', 'i am hero u want to buy me .', '123456789', 'available', '68', 'asdfg'),
(29, 'Book', 'IMG_20190904_181934.jpg', 'This is note of PDCS.', '123456789', 'available', '89', '5asd'),
(30, 'notes pdcs', 'IMG_20190904_181953.jpg', 'this is another notes.', '190106017', 'available', '42', 'sdef'),
(31, 'Questions', 'WhatsApp Image 2020-05-02 at 09.10.02.14.jpeg', 'This is maths2 Questions.', '190106017', 'available', '85', '456258'),
(32, 'Jeans', 'pants.jpg', 'price is negotiable.', '123456789', 'available', '1000', 'pant'),
(33, 'phone case paint', 'tuf01vj4m5n41.jpg', 'more design colored.', '123456789', 'available', '100', 'phone'),
(34, 'shirt', 'mens-designer-casual-shirt-500x500.jpg', 'sample shirt', '123456789', 'available', '600', 'qazxsw'),
(35, 'Old Phone', 'download.png', 'This is my old phone can you buy it.', '123456789', 'available', '777', '456852');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `roll` varchar(9) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact` varchar(10) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `gender`, `roll`, `email`, `contact`, `password`) VALUES
('Seller', 'female', '123456789', 'seller@buysell.com', '9525177622', '123456'),
('Mayank Mohak', 'male', '190106017', 'admin@buysell.com', '9525177622', '123456.'),
('Buyer', 'male', '987654321', 'buyer@buysell.com', '9525177622', '123456');

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
  ADD PRIMARY KEY (`roll`,`email`),
  ADD UNIQUE KEY `roll` (`roll`,`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `p_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
