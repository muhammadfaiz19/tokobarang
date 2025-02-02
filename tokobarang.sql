-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 31, 2025 at 05:30 PM
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
-- Database: `tokobarang`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `kode_barang` varchar(20) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `kategori` varchar(50) DEFAULT NULL,
  `harga` decimal(10,2) NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `kode_barang`, `nama_barang`, `kategori`, `harga`, `stok`) VALUES
(1, 'B001', 'Laptop ASUS', 'Elektronik', 8000000.00, 10),
(2, 'B002', 'Kulkas Samsung', 'Elektronik', 4500000.00, 5),
(3, 'B003', 'Sepatu Adidas', 'Fashion', 1200000.00, 20),
(4, 'B004', 'Smartphone Xiaomi', 'Elektronik', 3000000.00, 15),
(5, 'B005', 'Buku Novel', 'Buku', 150000.00, 50),
(6, 'B006', 'Headphone Sony', 'Elektronik', 1500000.00, 30),
(7, 'B007', 'Meja Kantor', 'Perabotan', 200000.00, 25),
(8, 'B008', 'Kamera Canon', 'Elektronik', 5000000.00, 8),
(9, 'B009', 'Smartwatch Garmin', 'Aksesoris', 2500000.00, 12),
(10, 'B010', 'Ponsel Oppo', 'Elektronik', 3500000.00, 40),
(11, 'B011', 'Tas Ransel Nike', 'Fashion', 600000.00, 35),
(12, 'B012', 'Lampu Meja IKEA', 'Perabotan', 150000.00, 22),
(13, 'B013', 'Tenda Camping', 'Outdoor', 850000.00, 18),
(14, 'B014', 'Cangkir Keramik', 'Perabotan', 50000.00, 60),
(15, 'B015', 'Kursi Kayu', 'Perabotan', 350000.00, 10);

-- --------------------------------------------------------

--
-- Table structure for table `detailtransaksi`
--

CREATE TABLE `detailtransaksi` (
  `id` int(11) NOT NULL,
  `transaksi_id` int(11) NOT NULL,
  `kode_barang` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detailtransaksi`
--

INSERT INTO `detailtransaksi` (`id`, `transaksi_id`, `kode_barang`) VALUES
(53, 11, 'B008'),
(55, 13, 'B015'),
(56, 13, 'B005');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(11) NOT NULL,
  `kode_pelanggan` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jk` enum('L','P') NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telepon` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `kode_pelanggan`, `nama`, `jk`, `email`, `telepon`) VALUES
(1, '22087654', 'Muhammad Hidayat', 'L', 'muhammadhidayat6704@gmail.com', '085967029702'),
(2, '220511139', 'Muhammad Faiz', 'L', 'mfaiz19@gmail.com', '081367892657'),
(3, '220511111', 'Nurkholifah', 'P', 'nur@gmail.com', '086725346783');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `kode_transaksi` varchar(20) NOT NULL,
  `kode_pelanggan` varchar(20) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `dibeli` int(20) NOT NULL DEFAULT 0,
  `total_harga` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `kode_transaksi`, `kode_pelanggan`, `tanggal_transaksi`, `dibeli`, `total_harga`) VALUES
(13, 'e2eed63', '220511111', '2025-01-31', 1, 0.00),
(14, '50d24e1', '220511139', '2025-01-31', 0, 0.00);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `detailtransaksi`
--
ALTER TABLE `detailtransaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
