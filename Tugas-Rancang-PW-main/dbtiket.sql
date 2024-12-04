-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2024 at 08:36 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbtiket`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user','manager') NOT NULL DEFAULT 'user',
  `avatar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`id`, `username`, `email`, `password`, `role`, `avatar`, `created_at`) VALUES
(1, 'yerky memeg', 'yerkymmg@gmail.com', '$2y$10$9Y/5NLyoe/fK1AT49TjbVeLyx8XC/CtuJrF/3k5ZH93PgU9BC5P72', 'user', NULL, '2024-11-21 12:53:29'),
(2, 'YuFi', 'example@example.com', '$2y$10$ihSztVUt.al3jQhNaxpKguNRVs6wFz7yAHCvlJXlwXwbacNlgRVsC', 'admin', NULL, '2024-11-21 12:54:23'),
(3, 'yerky', 'yerkysabana1994@gmail.com', '$2y$10$cl4vat0vA2AiVcajH5yJxuvDgSuflGfLyI12VTOXQPJcSKIMIBY9i', 'admin', NULL, '2024-11-21 13:54:48'),
(4, 'yerkysabana', 'yerky_syahbana@yahoo.com', '$2y$10$zTz.TwQPPrqfepatNmg/neUIZ/qXjnrk7rXpvuJRdtJ6MmumiCOmq', 'user', NULL, '2024-11-21 14:05:52'),
(7, 'zidanmemeg', 'zidanmemeg@gmail.com', '$2y$10$WIvDq.MR6LYt4hqCLmvbHOtcDFUs7V/ND25/5wofEZ678IIt8XEJ6', 'user', NULL, '2024-11-27 14:36:53');

-- --------------------------------------------------------

--
-- Table structure for table `concerts`
--

CREATE TABLE `concerts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `image_data` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `konser`
--

CREATE TABLE `konser` (
  `id` int(11) NOT NULL,
  `nama_artis` varchar(100) NOT NULL,
  `tempat` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `concert_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `konser`
--

INSERT INTO `konser` (`id`, `nama_artis`, `tempat`, `tanggal`, `harga`, `gambar`, `stock`, `concert_name`) VALUES
(12, 'abcde', 'FTI', '2025-08-23', 15000.00, '1733334087_Fakultas_Teknologi_Informasi_UKSW_-_Kritis_Kreatif_Inovatif.png', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int(11) NOT NULL,
  `concert_id` int(11) NOT NULL,
  `ticket_type` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `payment_status` varchar(20) NOT NULL,
  `ticket_code` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `concert_id`, `ticket_type`, `name`, `email`, `phone`, `payment_status`, `ticket_code`, `created_at`) VALUES
(1, 0, '', '', '', '', '', 'S457N3D3', '2024-12-04 19:10:33'),
(2, 0, '', '', '', '', '', '6VAFQC0L', '2024-12-04 19:10:36'),
(3, 0, '', '', '', '', '', '75CQ9RIK', '2024-12-04 19:10:37'),
(4, 0, '', '', '', '', '', '84DI2P1J', '2024-12-04 19:10:37'),
(5, 0, '', '', '', '', '', 'J1WRYLZN', '2024-12-04 19:10:38'),
(6, 0, '', '', '', '', '', 'V2RUC17Y', '2024-12-04 19:10:38'),
(7, 0, '', '', '', '', '', 'AOYJ6KX6', '2024-12-04 19:10:38'),
(8, 0, '', '', '', '', '', 'ZVRLATYQ', '2024-12-04 19:10:38'),
(9, 0, '', '', '', '', '', 'VFD7BRD6', '2024-12-04 19:10:39'),
(10, 0, '', '', '', '', '', 'YMMJ72U6', '2024-12-04 19:10:39'),
(11, 0, '', '', '', '', '', 'EGFW5ZZE', '2024-12-04 19:10:39'),
(12, 0, '', '', '', '', '', '7ZCJSS0S', '2024-12-04 19:10:39'),
(13, 0, '', '', '', '', '', 'KD8NRG2X', '2024-12-04 19:10:39'),
(14, 0, '', '', '', '', '', 'TJKCD4EK', '2024-12-04 19:11:03'),
(15, 12, 'VIP', 'Siluman taplak meja', 'yerkymmg@gmail.com', '085874523512', 'Validated', '', '2024-12-04 19:11:03'),
(16, 0, '', '', '', '', '', 'WAHK1BWU', '2024-12-04 19:11:03'),
(17, 0, '', '', '', '', '', 'A32CVGJH', '2024-12-04 19:11:05'),
(18, 0, '', '', '', '', '', 'B4FIZBEX', '2024-12-04 19:11:05'),
(19, 0, '', '', '', '', '', 'OJGNIJ66', '2024-12-04 19:11:05'),
(20, 0, '', '', '', '', '', '3ZTPDVOQ', '2024-12-04 19:11:06'),
(21, 0, '', '', '', '', '', '7HVZ11C5', '2024-12-04 19:11:52'),
(23, 0, '', '', '', '', '', 'J2PAD4MU', '2024-12-04 19:11:57'),
(25, 0, '', '', '', '', '', 'VPSRFGWG', '2024-12-04 19:15:21'),
(27, 0, '', '', '', '', '', '4R8GXG53', '2024-12-04 19:15:43'),
(29, 0, '', '', '', '', '', 'L3PHICNY', '2024-12-04 19:16:00'),
(31, 0, '', '', '', '', '', 'NGGOTN2E', '2024-12-04 19:17:22'),
(32, 0, '', '', '', '', '', 'JI4LGZ35', '2024-12-04 19:17:22'),
(33, 0, '', '', '', '', '', '2TA3NY8X', '2024-12-04 19:17:46'),
(34, 0, '', '', '', '', '', 'FK301ARP', '2024-12-04 19:17:46'),
(35, 0, '', '', '', '', '', 'VIND4D4K', '2024-12-04 19:17:48'),
(36, 0, '', '', '', '', '', '1UUAYRFJ', '2024-12-04 19:17:48'),
(37, 0, '', '', '', '', '', 'ZQ1MXQI1', '2024-12-04 19:17:48'),
(38, 0, '', '', '', '', '', 'IDN1HUSB', '2024-12-04 19:17:48'),
(39, 0, '', '', '', '', '', 'V62G0I16', '2024-12-04 19:19:42'),
(40, 0, '', '', '', '', '', 'XHSZAT3H', '2024-12-04 19:19:44'),
(41, 0, '', '', '', '', '', 'VP6KFWQV', '2024-12-04 19:19:44'),
(42, 0, '', '', '', '', '', 'B8VQMZFC', '2024-12-04 19:19:44'),
(43, 0, '', '', '', '', '', '7FF6HPTY', '2024-12-04 19:19:44'),
(44, 0, '', '', '', '', '', '23A5T9I0', '2024-12-04 19:19:45'),
(45, 0, '', '', '', '', '', 'JDV01IQ2', '2024-12-04 19:19:45'),
(46, 0, '', '', '', '', '', '61870ENZ', '2024-12-04 19:19:45'),
(47, 0, '', '', '', '', '', 'NY65Y02X', '2024-12-04 19:25:42'),
(48, 0, '', '', '', '', '', 'SE7IOI5H', '2024-12-04 19:25:53'),
(49, 0, '', '', '', '', '', 'SPUX9X3Y', '2024-12-04 19:25:53'),
(50, 0, '', '', '', '', '', 'TWC9ZBGG', '2024-12-04 19:26:32'),
(51, 0, '', '', '', '', '', '0ZGLQTC0', '2024-12-04 19:26:32'),
(52, 0, '', '', '', '', '', 'NEC7CSUV', '2024-12-04 19:26:46'),
(53, 0, '', '', '', '', '', 'YCDBL147', '2024-12-04 19:26:48'),
(54, 0, '', '', '', '', '', 'GETEA2TJ', '2024-12-04 19:26:48'),
(55, 0, '', '', '', '', '', 'VEPFSRZP', '2024-12-04 19:26:49'),
(56, 0, '', '', '', '', '', 'DZ46RC7V', '2024-12-04 19:26:49'),
(57, 0, '', '', '', '', '', 'L4LP05EZ', '2024-12-04 19:26:49'),
(58, 0, '', '', '', '', '', 'H16JW3VQ', '2024-12-04 19:26:49'),
(59, 0, '', '', '', '', '', 'ZKWFN93W', '2024-12-04 19:26:50'),
(60, 0, '', '', '', '', '', 'EK9YKL1R', '2024-12-04 19:26:50'),
(61, 0, '', '', '', '', '', '1H3R9B78', '2024-12-04 19:26:50'),
(62, 0, '', '', '', '', '', '95ZBLIXJ', '2024-12-04 19:26:50'),
(63, 0, '', '', '', '', '', 'J9LND964', '2024-12-04 19:26:50'),
(64, 0, '', '', '', '', '', '9SGN5OF7', '2024-12-04 19:26:51'),
(65, 0, '', '', '', '', '', '3GB54IQM', '2024-12-04 19:26:51'),
(66, 0, '', '', '', '', '', 'LSSTZ1VF', '2024-12-04 19:26:51'),
(67, 0, '', '', '', '', '', 'LM9AYF1D', '2024-12-04 19:26:51'),
(68, 0, '', '', '', '', '', '8F0FXWQC', '2024-12-04 19:26:52'),
(69, 0, '', '', '', '', '', '6K4VRQ5B', '2024-12-04 19:26:52'),
(70, 0, '', '', '', '', '', 'OKUHQA5S', '2024-12-04 19:26:52'),
(71, 0, '', '', '', '', '', 'Z7S39CPI', '2024-12-04 19:26:52'),
(72, 0, '', '', '', '', '', 'FFS9XBE3', '2024-12-04 19:29:02'),
(73, 0, '', '', '', '', '', 'DFJMM3RQ', '2024-12-04 19:29:33'),
(74, 0, '', '', '', '', '', '29R03MQ5', '2024-12-04 19:29:33'),
(75, 0, '', '', '', '', '', 'USCLMRFD', '2024-12-04 19:29:54'),
(76, 0, '', '', '', '', '', 'RA7PFHD8', '2024-12-04 19:29:55'),
(77, 0, '', '', '', '', '', 'PSUQKOQE', '2024-12-04 19:29:55'),
(78, 0, '', '', '', '', '', 'WW12ZD8S', '2024-12-04 19:29:55'),
(79, 0, '', '', '', '', '', 'CITS336Y', '2024-12-04 19:29:55'),
(80, 0, '', '', '', '', '', 'PGVL8MJ5', '2024-12-04 19:29:56'),
(81, 0, '', '', '', '', '', 'Z7DK8WTM', '2024-12-04 19:29:56'),
(82, 0, '', '', '', '', '', 'E2C2LK3B', '2024-12-04 19:29:56'),
(83, 0, '', '', '', '', '', 'TK2LGBX0', '2024-12-04 19:32:51'),
(84, 0, '', '', '', '', '', '3ETS2UY5', '2024-12-04 19:32:51'),
(85, 0, '', '', '', '', '', 'XSQ0AQ0S', '2024-12-04 19:33:04'),
(86, 0, '', '', '', '', '', 'OSQ44NIS', '2024-12-04 19:33:04'),
(87, 0, '', '', '', '', '', 'NIA4Z7QZ', '2024-12-04 19:33:04'),
(88, 0, '', '', '', '', '', 'I8MF2MSN', '2024-12-04 19:33:05'),
(89, 0, '', '', '', '', '', 'VVNPGQKN', '2024-12-04 19:33:05'),
(90, 0, '', '', '', '', '', 'CJGMU95C', '2024-12-04 19:33:05'),
(91, 0, '', '', '', '', '', 'OPTX2RUO', '2024-12-04 19:33:05'),
(92, 0, '', '', '', '', '', 'Z2S59VVK', '2024-12-04 19:33:05'),
(93, 0, '', '', '', '', '', 'B6OWFA6N', '2024-12-04 19:33:06'),
(94, 0, '', '', '', '', '', 'ZDWJKAAD', '2024-12-04 19:33:06'),
(95, 0, '', '', '', '', '', '9VXK2J1O', '2024-12-04 19:33:27'),
(96, 0, '', '', '', '', '', 'REVRD0RM', '2024-12-04 19:33:27'),
(97, 0, '', '', '', '', '', '3GXOJH6W', '2024-12-04 19:33:38'),
(98, 0, '', '', '', '', '', 'L740N24H', '2024-12-04 19:33:38'),
(99, 0, '', '', '', '', '', 'BOWYROU3', '2024-12-04 19:33:38'),
(100, 0, '', '', '', '', '', '42GC93PX', '2024-12-04 19:34:10');

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id` int(11) NOT NULL,
  `concert_id` int(11) NOT NULL,
  `ticket_type` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `concerts`
--
ALTER TABLE `concerts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `konser`
--
ALTER TABLE `konser`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ticket_code` (`ticket_code`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `concert_id` (`concert_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akun`
--
ALTER TABLE `akun`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `concerts`
--
ALTER TABLE `concerts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `konser`
--
ALTER TABLE `konser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD CONSTRAINT `pemesanan_ibfk_1` FOREIGN KEY (`concert_id`) REFERENCES `konser` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
