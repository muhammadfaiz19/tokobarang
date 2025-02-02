-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 02, 2025 at 01:24 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tokobarang`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` int NOT NULL,
  `kode_barang` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_barang` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `kategori` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `harga` decimal(10,2) NOT NULL,
  `stok` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `kode_barang`, `nama_barang`, `kategori`, `harga`, `stok`) VALUES
(1, 'B001', 'Laptop ASUS', 'Elektronik', '8000000.00', 14),
(2, 'B002', 'Kulkas Samsung', 'Elektronik', '4500000.00', 3),
(3, 'B003', 'Sepatu Adidas', 'Fashion', '1200000.00', 17),
(4, 'B004', 'Smartphone Xiaomi', 'Elektronik', '3000000.00', 14),
(5, 'B005', 'Buku Novel', 'Buku', '150000.00', 49),
(6, 'B006', 'Headphone Sony', 'Elektronik', '1500000.00', 30),
(7, 'B007', 'Meja Kantor', 'Perabotan', '200000.00', 23),
(8, 'B008', 'Kamera Canon', 'Elektronik', '5000000.00', 8),
(9, 'B009', 'Smartwatch Garmin', 'Aksesoris', '2500000.00', 12),
(10, 'B010', 'Ponsel Oppo', 'Elektronik', '3500000.00', 38),
(11, 'B011', 'Tas Ransel Nike', 'Fashion', '600000.00', 35),
(12, 'B012', 'Lampu Meja IKEA', 'Perabotan', '150000.00', 21),
(13, 'B013', 'Tenda Camping', 'Outdoor', '850000.00', 17),
(14, 'B014', 'Cangkir Keramik', 'Perabotan', '50000.00', 60),
(15, 'B015', 'Kursi Kayu', 'Perabotan', '350000.00', 9);

-- --------------------------------------------------------

--
-- Table structure for table `detailtransaksi`
--

CREATE TABLE `detailtransaksi` (
  `id` int NOT NULL,
  `transaksi_id` int NOT NULL,
  `kode_barang` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `jumlah` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detailtransaksi`
--

INSERT INTO `detailtransaksi` (`id`, `transaksi_id`, `kode_barang`, `jumlah`) VALUES
(1, 1, 'B003', 0),
(2, 1, 'B002', 0),
(3, 2, 'B007', 0),
(4, 3, 'B010', 0),
(6, 4, 'B001', 0),
(7, 5, 'B003', 0),
(8, 6, 'B002', 0),
(10, 8, 'B010', 0),
(11, 9, 'B001', 0),
(12, 9, 'B001', 0),
(13, 9, 'B001', 0),
(14, 10, 'B001', 0),
(15, 10, 'B001', 0),
(16, 10, 'B013', 0),
(17, 11, 'B001', NULL),
(18, 11, 'B004', NULL),
(19, 15, 'B007', NULL),
(20, 15, 'B012', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int NOT NULL,
  `kode_pelanggan` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `jk` enum('L','P') COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `telepon` varchar(15) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `kode_pelanggan`, `nama`, `jk`, `email`, `telepon`) VALUES
(1, '220511088', 'Muhammad Hidayat', 'L', 'muhammadhidayat6704@gmail.com', '085967029702'),
(2, '220511139', 'Muhammad Faiz', 'L', 'mfaiz19@gmail.com', '081367892657'),
(3, '220511111', 'Nurkholifah', 'P', 'nur@gmail.com', '086725346783');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int NOT NULL,
  `kode_transaksi` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `kode_pelanggan` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `dibeli` int NOT NULL DEFAULT '0',
  `total_harga` decimal(10,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `kode_transaksi`, `kode_pelanggan`, `tanggal_transaksi`, `dibeli`, `total_harga`) VALUES
(5, 'f4d3c6c', '220511139', '2025-02-02', 2, '1200000.00'),
(6, '6206c78', '220511088', '2025-02-02', 2, '4500000.00'),
(8, '366a73d', '220511088', '2025-02-02', 2, '3500000.00'),
(9, '781cb2d', '220511111', '2025-02-02', 2, '24000000.00'),
(11, 'ccd1950', '220511111', '2025-02-02', 2, '11000000.00'),
(15, '7a6af15', '220511139', '2025-02-02', 0, '350000.00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sandi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` enum('admin','pelanggan') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `nama`, `sandi`, `level`) VALUES
(1, 'admin', 'admin', '$2y$10$C1tkn9/DSHFg7sXQH1EBweNv2JvSUzyKJMnO1CPx34HGR9/10AIYe', 'admin'),
(2, 'paiss@gmail.com', 'paiss', '$2y$10$wOL0B.57Pb7Ayk32EFjn0OdRC7Y/d0DnzWmMeG0BH/It5/wa3Crxa', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_barang` (`kode_barang`);

--
-- Indexes for table `detailtransaksi`
--
ALTER TABLE `detailtransaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_pelanggan` (`kode_pelanggan`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kode_pelanggan` (`kode_pelanggan`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `detailtransaksi`
--
ALTER TABLE `detailtransaksi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`kode_pelanggan`) REFERENCES `pelanggan` (`kode_pelanggan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
