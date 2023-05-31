-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2023 at 08:21 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `weight` float NOT NULL,
  `quantity` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `name`, `price`, `weight`, `quantity`, `image`) VALUES
(80, 7, 'Sin Eater', 100, 0, 1, 'WhatsApp Image 2022-05-18 at 12.15.02 PM.jpeg'),
(81, 7, 'Six of Crows', 150, 0, 1, 'WhatsApp Image 2022-05-18 at 12.16.57 PM.jpeg'),
(97, 17, 'Leaf gold ring', 10000, 2, 1, 'g1.png'),
(116, 0, 'Gold band ring', 14200, 3, 1, 'g2.png');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(10) NOT NULL,
  `name` varchar(225) NOT NULL,
  `image` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `image`) VALUES
(14, 'Necklaces', 'c_necklace.png'),
(15, 'Payals', 'c_payal.png'),
(16, 'Bangles', 'cat_bangle.png'),
(17, 'Rings', 'cat_ring.png'),
(18, 'Magalsutras', 'jewels2 (284 × 355px).png'),
(19, 'Silver Rings', 'p_silrin.png');

-- --------------------------------------------------------

--
-- Table structure for table `gold_price`
--

CREATE TABLE `gold_price` (
  `id` int(11) NOT NULL,
  `gold_price` decimal(10,2) NOT NULL,
  `silver_price` decimal(10,2) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gold_price`
--

INSERT INTO `gold_price` (`id`, `gold_price`, `silver_price`, `date`) VALUES
(4, 1500.00, 0.00, '2023-05-04');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `bprice` decimal(10,2) NOT NULL,
  `sprice` decimal(10,2) NOT NULL,
  `weight` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `name`, `bprice`, `sprice`, `weight`) VALUES
(39, 'Gold Leaf Ring', 1.00, 1.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `user_id`, `name`, `email`, `number`, `message`) VALUES
(15, 18, 'Renvil Furtado', 'test@gmail.com', '08139975328', 'hello need a customization for a ring\r\n'),
(16, 18, 'test', 'kenneth@123', '08139975328', 'abccccc test');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` varchar(50) NOT NULL,
  `payment_id` varchar(50) NOT NULL,
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `address`, `total_products`, `total_price`, `placed_on`, `payment_id`, `payment_status`) VALUES
(33, 12, 'uxbGbM3epR', '610500', 'ezumn@0wlj.com', 'flat no. 374134, amqMb2BCJn, fZnNEA4xRc, oLGv6luXqj - 115676', ', Leaf gold ring (1) ', 10000, '07-May-2023', 'order_LmlzAbp7zJ39Fo', 'Paid'),
(34, 12, 'th0KazEhZI', '339730', 'vf2mk@xroq.com', 'flat no. 066860, 7R1FIcIj1X, QNZTdE56Ht, QigaWzPxVg - 652182', ', Leaf gold ring (1) ', 10000, '07-May-2023', 'order_LmmGZXMqaOQZGB', 'Paid'),
(35, 12, 'brian', '8310826860', 'eltonjohndmello@gmail.com', 'flat no. 1349, mangalore, Mangalore, India - 575003', ', Mens gold ring (1) ', 12000, '07-May-2023', 'order_LmnPNe09UDkMat', 'Paid'),
(36, 12, 'A18hv4Eqtq', '336667', 'in76o@rcmp.com', 'flat no. 384246, JbPAd5iE4K, zqAAgk2zjJ, m0qWN0ZJiS - 557928', ', Leaf gold ring (1) ', 10000, '07-May-2023', '', 'completed'),
(37, 12, 'pritam', '6363829085', 'eltonjohndmello@gmail.com', 'flat no. 101, attavar, Mangalore, India - 575003', ', Gold band ring (1) ', 14200, '07-May-2023', 'order_LmoNSxKSpOwuCV', 'Paid'),
(38, 12, 'ELTON DMELLO', '8310826', 'eltonjohndmello@gmail.com', 'flat no. 101, attavar, Mangalore, India - 575003', ', Gold band ring (1) ', 14200, '07-May-2023', 'order_Lmp3iEyFsMkMh5', 'Paid'),
(39, 12, 'ELTON DMELLO', '3096899164', 'eltonjohndmello@gmail.com', 'flat no. 10, 111, Mangalore, India - 575003', ', Gold Dual knot ring (1) ', 20000, '07-May-2023', 'order_LmpGkLo06CwEQ1', 'Paid'),
(40, 18, 'Renvil Furtado', '8310826860', 'kenneth@gmail.com', 'flat no. 102, Valencia Rd, Valencia, Souterpet, Kankanady, Mangalore, Karnataka 575002, Manglore, India - 575002', ', Gold band ring (1) ', 14200, '08-May-2023', 'order_LmzLUsmDJZsETV', 'Paid'),
(41, 18, 'Renvil Furtado', '8310826860', 'test@gmail.com', 'flat no. 1001, Palame house shirva post, Udupi, India - 574116', ', Gold band ring (1) ', 14200, '08-May-2023', '', 'pending'),
(42, 18, 'vaish', '7865436754', 'vaishj@gmail.com', 'flat no. 101, attavar, puttur, India - 574201', ', Leaf gold ring (1) ', 10000, '08-May-2023', 'order_LnC7etbsYAjUJH', 'Paid'),
(43, 18, 'Arhaan', '8654876534', 'qwf9u@ervd.com', 'flat no. 29, Attavar, Mangalore, India - 977610', ', Leaf gold ring (1) ', 10000, '10-May-2023', 'order_Lnpwu4efGZhAm2', 'Paid');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `weight` float NOT NULL,
  `image` varchar(100) NOT NULL,
  `category_id` int(10) NOT NULL,
  `category` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `description`, `weight`, `image`, `category_id`, `category`) VALUES
(38, 'Leaf gold ring', 10000, '3', 3, 'g1.png', 17, 'Gold'),
(39, 'Gold band ring', 14200, 'test', 3, 'g2.png', 17, 'Gold'),
(40, 'Mens gold ring', 12000, 'test', 2, 'g3.png', 17, 'Gold'),
(41, 'Gold Dual knot ring', 20000, 'test', 4, 'g4.png', 17, 'Gold'),
(42, 'Bridal set necklace', 90540, 'test', 15, 'bn1.png', 14, 'Gold'),
(43, 'Gold Bridal long necklace', 70450, 'test', 14, 'ln2.png', 14, 'Gold'),
(44, 'silver payal', 250, 'test', 3, 'sp1.png', 15, ''),
(45, 'simple silver payal', 320, 'test', 4, 'sp2.png', 15, ''),
(46, 'Stone silver payal', 160, 'test', 2, 'sp3.png', 15, ''),
(47, 'Silver line ring', 180, 'test', 2, 'sr1.png', 19, ''),
(48, 'Single diamond silver  ring', 860, 'test', 4, 'sr2.png', 19, ''),
(49, 'Silver leaf design ring', 300, 'test', 2, 'sr3.png', 19, ''),
(50, 'Gold Bangle set', 23552, 'test', 4, 'b1.png', 16, 'Gold'),
(51, 'Designer gold bangle', 29678, 'test', 5, 'b2.png', 16, 'Gold'),
(52, 'Couple gold band ring', 35768, 'test', 6, 'g5.png', 17, 'Gold'),
(53, 'Shine stone couple ring', 31678, 'test', 5, 'g6.png', 17, ''),
(54, 'Silver gungru payal', 250, 'test', 2, 'sp4.png', 15, ''),
(55, 'Vintage style silver payal', 356, 'test', 3, 'sp5.png', 15, ''),
(56, 'Shinning silver ring', 560, 'test', 4, 'sr4.png', 19, ''),
(57, 'Silver wedding ring', 820, 'test', 7, 'sr5.png', 19, ''),
(58, 'Designer mangalasutra', 17560, 'test', 3, 'm1.png', 18, 'Gold'),
(59, 'Vati style mangalsutra', 21600, 'test', 4, 'm2.png', 18, 'Gold'),
(60, 'Long mangalsutra', 28900, 'test', 5, 'm3.png', 18, ''),
(61, 'Long gold necklace', 46967, 'test', 8, 'sn3.png', 14, 'Gold'),
(62, 'Gold Necklace', 0, 'abc', 1, 'frontpage.jpg', 14, 'Gold'),
(64, 'ELTON DMELLO', 0, 'test', 3, 'Car_Category_539.png', 17, 'Gold');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`) VALUES
(10, 'Admin', 'admin@admin.com', '202cb962ac59075b964b07152d234b70', 'admin'),
(12, 'Justin', 'user@user.com', '81dc9bdb52d04dc20036dbd8313ed055', 'user'),
(14, 'elton', 'eltonjohndmello@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'user'),
(15, 'siril', 'siril@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'user'),
(16, 'test', 'test@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'user'),
(17, 'Renvil', 'renvil@gmail.com', '6531401f9a6807306651b87e44c05751', 'user'),
(18, 'elton', 'eltonjohndmello@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gold_price`
--
ALTER TABLE `gold_price`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `gold_price`
--
ALTER TABLE `gold_price`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
