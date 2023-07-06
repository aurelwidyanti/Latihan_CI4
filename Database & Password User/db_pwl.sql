-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 06, 2023 at 07:03 AM
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
-- Database: `db_pwl`
--

-- --------------------------------------------------------

--
-- Table structure for table `brg`
--

CREATE TABLE `brg` (
  `id` int(11) UNSIGNED NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis` varchar(50) NOT NULL,
  `hrg` float NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `foto` varchar(225) NOT NULL,
  `stok` int(5) NOT NULL,
  `diskon` int(11) NOT NULL,
  `harga_diskon` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brg`
--

INSERT INTO `brg` (`id`, `nama`, `jenis`, `hrg`, `keterangan`, `foto`, `stok`, `diskon`, `harga_diskon`) VALUES
(1, 'Xiao Plushie', '', 500000, '-', '1687492913_ed4cb6a51a502073ade0.jpeg', 500, 0, 0),
(4, 'Xiao Pillowcase', '', 10000000, '-', '1687492972_46c19f29902d543568d2.jpg', 10, 0, 0),
(5, 'Xiao Bell Pendant', '', 700000, '-', '1687493023_68b780528dc45c38e9ef.jpg', 50, 0, 0),
(6, 'Xiao Yaksha Mask', '', 150000, '-', '1687493100_6c3f5e4ec51f2e3e9bb4.jpeg', 250, 0, 0),
(7, 'Xiao Amulet', '', 100000, '-', '1687493181_11ae30e4fd22e761ec83.jpg', 100, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `total_harga` double NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `ongkir` double NOT NULL,
  `status` int(1) NOT NULL,
  `created_by` varchar(100) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `username`, `total_harga`, `alamat`, `ongkir`, `status`, `created_by`, `created_date`) VALUES
(1, 'Xiao', 22556000, 'Liyue', 56000, 1, 'Xiao', '2023-06-21 12:29:17'),
(2, 'Xiao', 1014000, 'Liyue', 14000, 0, 'Xiao', '2023-06-22 03:41:33'),
(3, 'aurelwidyanti', 661000, 'Perumahan Kandri ', 11000, 0, 'aurelwidyanti', '2023-07-04 04:30:49'),
(4, 'kaveh', 510000, 'Perumahan Kandri ', 10000, 1, 'kaveh', '2023-07-06 04:27:01');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_detail`
--

CREATE TABLE `transaksi_detail` (
  `id` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `jumlah` double NOT NULL,
  `diskon` double NOT NULL,
  `subtotal_harga` double NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi_detail`
--

INSERT INTO `transaksi_detail` (`id`, `id_transaksi`, `id_barang`, `jumlah`, `diskon`, `subtotal_harga`, `created_by`, `created_date`) VALUES
(1, 1, 1, 5, 0, 22500000, 'Xiao', '2023-06-21 12:29:17'),
(2, 2, 4, 1, 0, 300000, 'Xiao', '2023-06-22 03:41:33'),
(3, 2, 5, 1, 0, 700000, 'Xiao', '2023-06-22 03:41:33'),
(4, 3, 6, 1, 0, 150000, 'aurelwidyanti', '2023-07-04 04:30:49'),
(5, 3, 1, 1, 0, 500000, 'aurelwidyanti', '2023-07-04 04:30:49'),
(6, 4, 1, 1, 0, 500000, 'kaveh', '2023-07-06 04:27:01');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `code` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `role`, `password`, `is_active`, `code`) VALUES
(5, 'ayato', '', 'user', 'cce0d4561a778e03bacd7c4f1065577c', 0, '5758'),
(6, 'kaveh', '', 'admin', '4d10650ff8849a269dbc4d94c1caddbe', 1, ''),
(7, 'kazuha', '', 'admin', '0d4283a997de84c33e56b300d7ad4b0a', 1, ''),
(8, 'xiaoracing', 'xiaoracing@gmail.com', 'user', '2cd2baff6cf57ad153f4d3eab5cfa038', 1, '6676'),
(10, 'aurelwidyanti', 'aurelwyt@gmail.com', 'user', '1e7b1d83e5244fa319497721c4691a5c', 1, '8687');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brg`
--
ALTER TABLE `brg`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brg`
--
ALTER TABLE `brg`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
