-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 05, 2025 at 04:57 PM
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
  `stok` int NOT NULL,
  `foto` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `kode_barang`, `nama_barang`, `kategori`, `harga`, `stok`, `foto`) VALUES
(1, 'B001', 'Laptop ASUS', 'Elektronik', '8000000.00', 10, '679f9a97deeac.jpeg'),
(2, 'B002', 'Kulkas Samsung', 'Elektronik', '4500000.00', 3, '679f979213898.jpeg'),
(3, 'B003', 'Sepatu Adidas Samba', 'Fashion', '1200000.00', 15, '679f9b0373c83.jpeg'),
(4, 'B004', 'Iphone 15 Pro Max', 'Elektronik', '15000000.00', 15, '679f9d45eeb48.jpeg'),
(5, 'B005', 'Buku Novel Bumi Manusia', 'Buku', '150000.00', 49, '679f9f0574901.jpg'),
(6, 'B006', 'Samsung Galaxy S24 Ultra', 'Elektronik', '14000000.00', 30, '679f9fe809a62.jpg'),
(7, 'B007', 'Meja Kantor', 'Perabotan', '200000.00', 24, '679f9f6e265d5.png'),
(8, 'B008', 'Kamera Canon', 'Elektronik', '5000000.00', 7, '679f9f434af99.jpeg'),
(9, 'B009', 'Smartwatch Xiaomi', 'Aksesoris', '2500000.00', 12, '679fa098e7fac.jpeg'),
(10, 'B010', 'Phone Asus ROG 5', 'Elektronik', '7000000.00', 38, '679fa15facf1b.jpeg'),
(11, 'B011', 'Tas Ransel Nike', 'Fashion', '600000.00', 34, '679fa1d8502c0.jpeg'),
(12, 'B012', 'Lampu Meja IKEA', 'Perabotan', '150000.00', 21, '679fa235f33ca.jpeg'),
(13, 'B013', 'Tenda Camping', 'Outdoor', '850000.00', 17, '67a338c022bf1.jpg'),
(14, 'B014', 'Cangkir Keramik', 'Perabotan', '50000.00', 60, '679fa2c97c774.jpg'),
(15, 'B015', 'Kursi Gaming', 'Perabotan', '550000.00', 8, '679fa309e55ac.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `detailtransaksi`
--

CREATE TABLE `detailtransaksi` (
  `id` int NOT NULL,
  `transaksi_id` int NOT NULL,
  `kode_barang` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jumlah` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detailtransaksi`
--

INSERT INTO `detailtransaksi` (`id`, `transaksi_id`, `kode_barang`, `jumlah`) VALUES
(28, 19, 'B001', NULL),
(29, 19, 'B003', NULL),
(30, 20, 'B015', NULL);

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
(3, '220511111', 'Nurkholifah', 'P', 'nur@gmail.com', '086725346783'),
(5, '220511144', 'Muhammad Daffa Raditha Pratama', 'L', 'mdaffa@gmail.com', '08327346233234');

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
(19, '17dcf82', '220511088', '2025-02-05', 2, '9200000.00'),
(20, '6627d12', '220511139', '2025-02-09', 2, '550000.00'),
(21, '6b89fec', '220511088', '2025-02-05', 0, '0.00'),
(22, 'be33151', '220511111', '2025-02-05', 0, '0.00'),
(23, '9f6fb0a', '220511088', '2025-02-03', 0, '0.00'),
(24, '9f6fb0a', '220511088', '2025-02-01', 0, '0.00'),
(26, 'f2ace79', '220511144', '2025-02-15', 0, '0.00');

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
(2, 'paiss@gmail.com', 'paiss', '$2y$10$Q1kcehkPq5JuFiX.t5imueI63Cbnh8oMucrQ1NK/LwmG5KVpqaLvO', 'admin');

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_detailtransaksi_barang` (`kode_barang`),
  ADD KEY `transaksi_id` (`transaksi_id`) USING BTREE;

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `detailtransaksi`
--
ALTER TABLE `detailtransaksi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detailtransaksi`
--
ALTER TABLE `detailtransaksi`
  ADD CONSTRAINT `detailtransaksi_ibfk_1` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_detailtransaksi_barang` FOREIGN KEY (`kode_barang`) REFERENCES `barang` (`kode_barang`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `fk_transaksi_pelanggan` FOREIGN KEY (`kode_pelanggan`) REFERENCES `pelanggan` (`kode_pelanggan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
