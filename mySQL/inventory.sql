-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 18, 2023 at 07:41 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(2) NOT NULL,
  `username` char(16) NOT NULL,
  `password` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `username`, `password`) VALUES
(1, 'gdwmw', '$2y$12$oqehz4GbsDwqCC18X18lGuy3iIY66cug3/.KMsOutoll9DeR7FqJK');

-- --------------------------------------------------------

--
-- Table structure for table `stockin`
--

CREATE TABLE `stockin` (
  `id` int(10) NOT NULL,
  `company` char(255) NOT NULL,
  `date` char(255) NOT NULL,
  `type` char(255) NOT NULL,
  `product` char(255) NOT NULL,
  `price` int(16) NOT NULL,
  `pcs` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stockin`
--

INSERT INTO `stockin` (`id`, `company`, `date`, `type`, `product`, `price`, `pcs`) VALUES
(1, 'PT. Airbne Nusantara', '2023-01-18', 'PSU', 'ST60F-ES230 600W 80+ (SilverStone)', 575000, 8),
(2, 'PT. Advanced Micro Devices', '2023-01-18', 'Processor', 'AMD Ryzen 5 2600X', 2500000, 4),
(4, 'PT. Sempurna Utama', '2023-01-18', 'VGA', 'AMD Radeon RX 6600 XT (ASUS)', 5700000, 2),
(5, 'PT. Persada Jaya Pelita', '2023-01-18', 'SSD', 'ADATA SU650 120GB - SATA3', 310000, 11),
(6, 'PT. Airbne Nusantara', '2023-01-18', 'RAM', 'Vengeance lPX DDR4 2666Mhz C16 16GB (2x8) (Corsair)', 850000, 7),
(7, 'PT. Persada Jaya Pelita', '2023-01-18', 'HDD', 'Seagate BarraCuda 1TB', 420000, 8),
(9, 'PT. Sempurna Utama', '2023-01-18', 'Motherboard', 'TUF Gaming X570 PLUS WiFi (ASUS)', 3600000, 4),
(10, 'PT. Advanced Micro Devices', '2023-01-18', 'Processor', 'AMD Ryzen 5 5600X', 3700000, 4),
(11, 'PT. Persada Jaya Pelita', '2023-01-18', 'HDD', 'Seagate BarraCuda 2TB', 820000, 3);

-- --------------------------------------------------------

--
-- Table structure for table `stockout`
--

CREATE TABLE `stockout` (
  `id` int(10) NOT NULL,
  `date` char(255) NOT NULL,
  `type` char(255) NOT NULL,
  `product` char(255) NOT NULL,
  `price` int(16) NOT NULL,
  `pcs` int(10) NOT NULL,
  `profit` int(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stockout`
--

INSERT INTO `stockout` (`id`, `date`, `type`, `product`, `price`, `pcs`, `profit`) VALUES
(1, '2023-01-18', 'PSU', 'ST60F-ES230 600W 80+ (SilverStone)', 1207500, 2, 57500),
(2, '2023-01-18', 'Motherboard', 'TUF Gaming X570 PLUS WiFi (ASUS)', 3780000, 1, 180000),
(3, '2023-01-18', 'SSD', 'ADATA SU650 120GB - SATA3', 651000, 2, 31000),
(4, '2023-01-18', 'Processor', 'AMD Ryzen 5 5600X', 3885000, 1, 185000),
(5, '2023-01-18', 'RAM', 'Vengeance lPX DDR4 2666Mhz C16 16GB (2x8) (Corsair)', 2677500, 3, 127500),
(6, '2023-01-18', 'HDD', 'Seagate BarraCuda 2TB', 1722000, 2, 82000);

-- --------------------------------------------------------

--
-- Table structure for table `supply`
--

CREATE TABLE `supply` (
  `id` int(10) NOT NULL,
  `company` char(255) NOT NULL,
  `type` char(255) NOT NULL,
  `product` char(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supply`
--

INSERT INTO `supply` (`id`, `company`, `type`, `product`) VALUES
(1, 'PT. Sempurna Utama', 'VGA', 'AMD Radeon RX 6600 XT (ASUS)'),
(2, 'PT. Sempurna Utama', 'Motherboard', 'TUF Gaming X570 PLUS WiFi (ASUS)'),
(3, 'PT. Airbne Nusantara', 'RAM', 'Vengeance lPX DDR4 2666Mhz C16 16GB (2x8) (Corsair)'),
(4, 'PT. Advanced Micro Devices', 'Processor', 'AMD Ryzen 5 2600X'),
(5, 'PT. Advanced Micro Devices', 'Processor', 'AMD Ryzen 5 5600X'),
(6, 'PT. Airbne Nusantara', 'PSU', 'ST60F-ES230 600W 80+ (SilverStone)'),
(7, 'PT. Persada Jaya Pelita', 'SSD', 'ADATA SU650 120GB - SATA3'),
(8, 'PT. Persada Jaya Pelita', 'HDD', 'Seagate BarraCuda 1TB'),
(9, 'PT. Persada Jaya Pelita', 'HDD', 'Seagate BarraCuda 2TB');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stockin`
--
ALTER TABLE `stockin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stockout`
--
ALTER TABLE `stockout`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supply`
--
ALTER TABLE `supply`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `stockin`
--
ALTER TABLE `stockin`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `stockout`
--
ALTER TABLE `stockout`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `supply`
--
ALTER TABLE `supply`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
