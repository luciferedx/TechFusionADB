-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: May 23, 2023 at 10:23 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `techfusion`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `DeleteUser` (IN `p_userId` INT)   BEGIN
    DELETE FROM users WHERE id = p_userId;
    DELETE FROM cart WHERE user_id = p_userId;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `RegUser` (IN `p_name` VARCHAR(255), IN `p_email` VARCHAR(255), IN `p_number` VARCHAR(255), IN `p_pass` VARCHAR(255), IN `p_cpass` VARCHAR(255))   BEGIN
    -- Sanitize the input parameters
    SET p_name = TRIM(p_name);
    SET p_email = TRIM(p_email);
    SET p_number = TRIM(p_number);
    SET p_pass = SHA1(p_pass);
    SET p_cpass = SHA1(p_cpass);

    -- Check if email or number already exists
    IF EXISTS(SELECT * FROM users WHERE email = p_email OR number = p_number) THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Email or number already exists';
    END IF;

    -- Check if the password and confirm password match
    IF p_pass <> p_cpass THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Confirm password not matched';
    END IF;

    -- Insert the user into the database
    INSERT INTO users (name, email, number, password)
    VALUES (p_name, p_email, p_number, p_cpass);

    -- Get the inserted user's details
    SELECT * FROM users WHERE email = p_email AND password = p_pass;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `search_products` (IN `search_term` VARCHAR(255))   BEGIN
  SELECT * FROM products
  WHERE name LIKE CONCAT('%', search_term, '%')
  OR category IN (
    SELECT category FROM products WHERE category LIKE CONCAT('%', search_term, '%')
  );
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateQuantity` (IN `p_cartId` INT, IN `p_qty` INT)   BEGIN
    UPDATE cart SET quantity = p_qty WHERE id = p_cartId;
    SELECT 'Cart quantity updated' AS message;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `addressupdateuser_log`
--

CREATE TABLE `addressupdateuser_log` (
  `email` varchar(255) NOT NULL,
  `phoneNumber` varchar(20) NOT NULL,
  `newAddress` text NOT NULL,
  `dateUpdated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `addressupdateuser_log`
--

INSERT INTO `addressupdateuser_log` (`email`, `phoneNumber`, `newAddress`, `dateUpdated`) VALUES
('paul@gmail.com', '0992132322', 'Lot 1 Block 3, Ising, Panabo City, 23, 8109', '2023-05-20 23:17:42'),
('paul@gmail.com', '0992132322', 'Lot 1 Block 3, paopao, Carmen City, 11, 213', '2023-05-21 22:47:44'),
('paul@gmail.com', '0992132322', 'Lot 1 Block 3, Ising, Carmen City, 11, 8101', '2023-05-22 23:14:18'),
('carlo@gmail.com', '09234343233', 'Lot 8 Block 10, Phase 9, Tibungco, Davao City, 11, 8001', '2023-05-23 10:56:53'),
('kyme@gmail.com', '09323412323', 'Lot 1 Block 23, Salvacion, Panabo City, 09, 8005', '2023-05-23 11:03:50'),
('wolvic@gmail.com', '0995823423', 'Lot 10 Block 1, Phase 1, Ilang, Davao City, 10, 8102', '2023-05-23 11:09:52');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `password`) VALUES
(1, 'TFAdmin', '39dfa55283318d31afe5a3ff4a0e3253e2045e43');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Stand-in structure for view `cpu_products`
-- (See below for the actual view)
--
CREATE TABLE `cpu_products` (
`id` int(100)
,`name` varchar(100)
,`category` varchar(100)
,`price` int(10)
,`image` varchar(100)
);

-- --------------------------------------------------------

--
-- Table structure for table `deluser_log`
--

CREATE TABLE `deluser_log` (
  `email` varchar(255) NOT NULL,
  `phoneNumber` varchar(20) NOT NULL,
  `dateDeleted` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `deluser_log`
--

INSERT INTO `deluser_log` (`email`, `phoneNumber`, `dateDeleted`) VALUES
('tryK@gmas.com', '123', '2023-05-20 23:12:51');

-- --------------------------------------------------------

--
-- Stand-in structure for view `motherboard_products`
-- (See below for the actual view)
--
CREATE TABLE `motherboard_products` (
`id` int(100)
,`name` varchar(100)
,`category` varchar(100)
,`price` int(10)
,`image` varchar(100)
);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `number` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` date NOT NULL DEFAULT current_timestamp(),
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`) VALUES
(4322, 15, 'Paul Castilla', '0992132322', 'paul@gmail.com', 'cash on delivery', 'Lot 1 Block 3, Ising, Carmen City, 11, 8101', 'Intel Core i7 13700f (23990 x 1) - ', 23990, '2023-05-14', 'cancelled'),
(10562, 15, 'Paul Castilla', '0992132322', 'paul@gmail.com', 'cash on delivery', 'Lot 1 Block 3, Ising, Carmen City, 11, 8101', 'Palit RTX 4090 (101900 x 2) - ASUS ROG Z790-F (18790 x 1) - Corsair Dominator DDR5 2x16 (13490 x 1) - ', 236080, '2023-05-03', 'completed'),
(12331, 15, 'Paul Castilla', '0992132322', 'paul@gmail.com', 'cash on delivery', 'Lot 1 Block 3, Ising, Panabo City, 23, 8109', 'Intel Core i7 13700f (23990 x 1) - ', 23990, '2023-02-05', 'completed'),
(12343, 15, 'Paul Castilla', '0992132322', 'paul@gmail.com', 'cash on delivery', 'Lot 1 Block 3, Ising, Carmen City, 11, 8101', 'Intel Core i3 13100f (11990 x 1) - ASUS Prime X670-P (14990 x 1) - ', 26980, '2023-05-07', 'cancelled'),
(13211, 15, 'Paul Castilla', '0992132322', 'paul@gmail.com', 'cash on delivery', 'Lot 1 Block 3, Ising, Carmen City, 11, 8101', 'AMD Ryzen 5 7500x (16990 x 1) - ', 16990, '2023-05-18', 'completed'),
(45024, 15, 'Paul Castilla', '0992132322', 'paul@gmail.com', 'cash on delivery', 'Lot 1 Block 3, Ising, Carmen City, 11, 8101', 'ASUS ROG Z790-F (18790 x 1) - ', 18790, '2023-05-19', 'completed'),
(53243, 15, 'Paul Castilla', '0992132322', 'paul@gmail.com', 'cash on delivery', 'Lot 1 Block 3, Ising, Carmen City, 11, 8101', 'GALAX RTX 4090 (99970 x 1) - Palit RTX 4090 (101900 x 1) - ', 201870, '2023-05-22', 'completed'),
(302313, 15, 'Paul Castilla', '0992132322', 'paul@gmail.com', 'cash on delivery', 'Lot 1 Block 3, Ising, Carmen City, 11, 8101', 'ASUS Prime Z790-P (14790 x 1) - AMD Ryzen 7 7700x (22990 x 1) - XPG DDR5 2x16 KIT (11690 x 1) - ', 49470, '2023-05-09', 'completed'),
(302315, 32, 'Carlo', '0923434323', 'carlo@gmail.com', 'cash on delivery', 'Lot 8 Block 10, Phase 9, Tibungco, Davao City, 11, 8001', 'GALAX RTX 4090 (99970 x 1) - ASUS TUF Z790-Plus (14790 x 1) - ', 114760, '2023-05-23', 'completed'),
(302398, 32, 'Carlo', '0923434323', 'carlo@gmail.com', 'cash on delivery', 'Lot 8 Block 10, Phase 9, Tibungco, Davao City, 11, 8001', 'Palit RTX 4090 (101900 x 1) - ASUS ROG 4090 (109990 x 1) - ', 211890, '2023-03-08', 'cancelled'),
(326544, 32, 'Carlo', '0923434323', 'carlo@gmail.com', 'cash on delivery', 'Lot 8 Block 10, Phase 9, Tibungco, Davao City, 11, 8001', 'AMD Ryzen 7 7700x (22990 x 1) - ', 22990, '2023-04-04', 'completed'),
(326546, 29, 'Kyme', '0932341232', 'kyme@gmail.com', 'cash on delivery', 'Lot 1 Block 23, Salvacion, Panabo City, 09, 8005', 'GALAX RTX 4090 (99970 x 1) - Intel Core i7 13700f (23990 x 1) - ', 123960, '2023-05-23', 'completed'),
(326678, 29, 'Kyme', '0932341232', 'kyme@gmail.com', 'cash on delivery', 'Lot 1 Block 23, Salvacion, Panabo City, 09, 8005', 'AMD Ryzen 9 9700x (30990 x 1) - ASUS Prime X670-P (14990 x 1) - Corsair Dominator DDR5 2x16 (13490 x 1) - ', 59470, '2023-05-02', 'cancelled'),
(326789, 29, 'Kyme', '0932341232', 'kyme@gmail.com', 'cash on delivery', 'Lot 1 Block 23, Salvacion, Panabo City, 09, 8005', 'ASUS ROG Z790-F (18790 x 1) - XPG DDR5 2x16 KIT (11690 x 1) - ', 30480, '2023-04-12', 'completed'),
(326790, 31, 'Wolvic', '0995823423', 'wolvic@gmail.com', 'cash on delivery', 'Lot 10 Block 1, Phase 1, Ilang, Davao City, 10, 8102', 'Intel Core i9 13900k (31990 x 1) - AMD Ryzen 5 7500x (16990 x 1) - ASUS ROG 4090 (109990 x 1) - ', 158970, '2023-03-31', 'pending'),
(326791, 31, 'Wolvic', '0995823423', 'wolvic@gmail.com', 'cash on delivery', 'Lot 10 Block 1, Phase 1, Ilang, Davao City, 10, 8102', 'Crucial Ballistix DDR5 2x16 Kit (8490 x 1) - ', 8490, '2023-05-19', 'pending'),
(326792, 31, 'Wolvic', '0995823423', 'wolvic@gmail.com', 'cash on delivery', 'Lot 10 Block 1, Phase 1, Ilang, Davao City, 10, 8102', 'Intel Core i7 13700f (23990 x 1) - ', 23990, '2023-04-14', 'pending'),
(326793, 31, 'Wolvic', '0995823423', 'wolvic@gmail.com', 'cash on delivery', 'Lot 10 Block 1, Phase 1, Ilang, Davao City, 10, 8102', 'GALAX RTX 4090 (99970 x 1) - ', 99970, '2023-04-28', 'pending'),
(326856, 15, 'Paul Castilla', '0992132322', 'paul@gmail.com', 'cash on delivery', 'Lot 1 Block 3, Ising, Carmen City, 11, 8101', 'Kingston FURY Beast 2x16 (10490 x 1) - ', 10490, '2023-03-09', 'pending');

-- --------------------------------------------------------

--
-- Stand-in structure for view `others_products`
-- (See below for the actual view)
--
CREATE TABLE `others_products` (
`id` int(100)
,`name` varchar(100)
,`category` varchar(100)
,`price` int(10)
,`image` varchar(100)
);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category`, `price`, `image`) VALUES
(43, 'Intel Core i3 13100f', 'CPU', 11990, 'i3-removebg-preview.png'),
(44, 'Intel Core i5 13400f', 'CPU', 17990, 'i5-removebg-preview.png'),
(45, 'Intel Core i7 13700f', 'CPU', 23990, 'i7-removebg-preview.png'),
(46, 'Intel Core i9 13900k', 'CPU', 31990, 'i9-removebg-preview.png'),
(47, 'AMD Ryzen 3 7300x', 'CPU', 10990, 'r3-removebg-preview.png'),
(48, 'AMD Ryzen 5 7500x', 'CPU', 16990, 'r5-removebg-preview.png'),
(49, 'AMD Ryzen 7 7700x', 'CPU', 22990, 'r7-removebg-preview.png'),
(50, 'AMD Ryzen 9 9700x', 'CPU', 30990, 'r9-removebg-preview.png'),
(51, 'ASUS TUF Z790-Plus', 'Motherboard', 14790, 'asus tuf z790 pro.png'),
(52, 'ASUS ROG Z790-F', 'Motherboard', 18790, 'asus z790-f.png'),
(53, 'ASUS Prime Z790-P', 'Motherboard', 14790, 'z790 prime asus.png'),
(54, 'ASUS STRIX X670', 'Motherboard', 19990, 'strix x670.png'),
(55, 'ASUS TUF X670', 'Motherboard', 16990, 'tuf x670.png'),
(56, 'ASUS Prime X670-P', 'Motherboard', 14990, 'asus x670-p.png'),
(57, 'Crucial Ballistix DDR5 2x16 Kit', 'RAM', 8490, 'crucial ballistix ddr5.png'),
(59, 'Kingston FURY Beast 2x16', 'RAM', 10490, 'ddr5 kingston fury.png'),
(60, 'XPG DDR5 2x16 KIT', 'RAM', 11690, 'ddr5 xpg .png'),
(61, 'Corsair Dominator DDR5 2x16', 'RAM', 13490, 'ddr5 dominator platinum.png'),
(62, 'ASUS ROG 4090', 'Others', 109990, 'ROG 4090.png'),
(63, 'GALAX RTX 4090', 'Others', 99970, 'galax 4090.png'),
(64, 'Palit RTX 4090', 'Others', 101900, 'palit 4090.png'),
(65, 'Nvidia FE 4090', 'Others', 110990, 'rtx 4090 fe.png');

-- --------------------------------------------------------

--
-- Stand-in structure for view `ram_products`
-- (See below for the actual view)
--
CREATE TABLE `ram_products` (
`id` int(100)
,`name` varchar(100)
,`category` varchar(100)
,`price` int(10)
,`image` varchar(100)
);

-- --------------------------------------------------------

--
-- Table structure for table `reguser_log`
--

CREATE TABLE `reguser_log` (
  `email` varchar(255) NOT NULL,
  `phoneNumber` varchar(20) NOT NULL,
  `dateRegistered` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reguser_log`
--

INSERT INTO `reguser_log` (`email`, `phoneNumber`, `dateRegistered`) VALUES
('tryK@gmas.com', '123', '2023-05-20 23:07:39'),
('krannu@gmail.com', '09912312223', '2023-05-23 10:53:20'),
('kyme@gmail.com', '09323412323', '2023-05-23 10:54:10'),
('justine@gmail.com', '0993828232', '2023-05-23 10:54:35'),
('wolvic@gmail.com', '0995823423', '2023-05-23 10:55:04'),
('carlo@gmail.com', '09234343233', '2023-05-23 10:55:37');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `number` varchar(11) NOT NULL,
  `password` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `number`, `password`, `address`) VALUES
(15, 'Paul Castilla', 'paul@gmail.com', '0992132322', '39dfa55283318d31afe5a3ff4a0e3253e2045e43', 'Lot 1 Block 3, Ising, Carmen City, 11, 8101'),
(22, 'Paul Lawrence Castil', 'paullawrenceporlarescastilla@gmail.com', '678', '39dfa55283318d31afe5a3ff4a0e3253e2045e43', ''),
(26, 'try', 'PASD@DMASD.COM', '123123', '39dfa55283318d31afe5a3ff4a0e3253e2045e43', 'Lot 1 Block 3, Ising, Carmen City, x1, 8101'),
(28, 'Keannu', 'krannu@gmail.com', '09912312223', '39dfa55283318d31afe5a3ff4a0e3253e2045e43', ''),
(29, 'Kyme', 'kyme@gmail.com', '09323412323', '39dfa55283318d31afe5a3ff4a0e3253e2045e43', 'Lot 1 Block 23, Salvacion, Panabo City, 09, 8005'),
(30, 'Justine', 'justine@gmail.com', '0993828232', '39dfa55283318d31afe5a3ff4a0e3253e2045e43', ''),
(31, 'Wolvic', 'wolvic@gmail.com', '0995823423', '39dfa55283318d31afe5a3ff4a0e3253e2045e43', 'Lot 10 Block 1, Phase 1, Ilang, Davao City, 10, 8102'),
(32, 'Carlo', 'carlo@gmail.com', '09234343233', '39dfa55283318d31afe5a3ff4a0e3253e2045e43', 'Lot 8 Block 10, Phase 9, Tibungco, Davao City, 11, 8001');

--
-- Triggers `users`
--
DELIMITER $$
CREATE TRIGGER `after_address_update` AFTER UPDATE ON `users` FOR EACH ROW BEGIN
  IF OLD.address <> NEW.address THEN
    INSERT INTO addressUpdateUser_Log (email, phoneNumber, newAddress, dateUpdated)
    VALUES (NEW.email, NEW.number, NEW.address, NOW());
  END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_user_delete` AFTER DELETE ON `users` FOR EACH ROW BEGIN
  INSERT INTO delUser_Log (email, phoneNumber, dateDeleted)
  VALUES (OLD.email, OLD.number, NOW());
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_user_signup` AFTER INSERT ON `users` FOR EACH ROW BEGIN
  INSERT INTO regUser_Log (email, phoneNumber, dateRegistered)
  VALUES (NEW.email, NEW.number, NOW());
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure for view `cpu_products`
--
DROP TABLE IF EXISTS `cpu_products`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `cpu_products`  AS SELECT `products`.`id` AS `id`, `products`.`name` AS `name`, `products`.`category` AS `category`, `products`.`price` AS `price`, `products`.`image` AS `image` FROM `products` WHERE `products`.`category` = 'cpu\'cpu''cpu\'cpu'  ;

-- --------------------------------------------------------

--
-- Structure for view `motherboard_products`
--
DROP TABLE IF EXISTS `motherboard_products`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `motherboard_products`  AS SELECT `products`.`id` AS `id`, `products`.`name` AS `name`, `products`.`category` AS `category`, `products`.`price` AS `price`, `products`.`image` AS `image` FROM `products` WHERE `products`.`category` = 'motherboard\'motherboard''motherboard\'motherboard'  ;

-- --------------------------------------------------------

--
-- Structure for view `others_products`
--
DROP TABLE IF EXISTS `others_products`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `others_products`  AS SELECT `products`.`id` AS `id`, `products`.`name` AS `name`, `products`.`category` AS `category`, `products`.`price` AS `price`, `products`.`image` AS `image` FROM `products` WHERE `products`.`category` = 'others\'others''others\'others'  ;

-- --------------------------------------------------------

--
-- Structure for view `ram_products`
--
DROP TABLE IF EXISTS `ram_products`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ram_products`  AS SELECT `products`.`id` AS `id`, `products`.`name` AS `name`, `products`.`category` AS `category`, `products`.`price` AS `price`, `products`.`image` AS `image` FROM `products` WHERE `products`.`category` = 'ram\'ram''ram\'ram'  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_admin_id` (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_cart_id` (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userOrder` (`user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_products_category` (`category`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_users_id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=326857;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `userOrder` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
