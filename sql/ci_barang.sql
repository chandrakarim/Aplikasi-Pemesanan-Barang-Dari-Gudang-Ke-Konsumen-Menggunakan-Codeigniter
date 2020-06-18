-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 19, 2020 at 05:48 AM
-- Server version: 5.7.24
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci_barang`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` char(7) NOT NULL,
  `nama_barang` varchar(20) NOT NULL,
  `jenis_id` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `harga` int(12) NOT NULL,
  `satuan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `jenis_id`, `stok`, `harga`, `satuan_id`) VALUES
('B01', 'Buah Vita', 7, 450, 3000, 3),
('B02', 'rokok red', 10, 140, 1000, 8),
('B03', 'Nutri sari', 7, 300, 10000, 5),
('B04', 'Dancow', 7, 3, 2500, 2),
('B05', 'Mie Goreng', 6, 300, 3000, 2);

-- --------------------------------------------------------

--
-- Table structure for table `barang_keluar`
--

CREATE TABLE `barang_keluar` (
  `id_barang_keluar` char(16) NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `konsumen_id` char(7) NOT NULL,
  `barang_id` char(7) NOT NULL,
  `user_id` int(11) NOT NULL,
  `jumlah_keluar` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang_keluar`
--

INSERT INTO `barang_keluar` (`id_barang_keluar`, `tanggal_keluar`, `konsumen_id`, `barang_id`, `user_id`, `jumlah_keluar`) VALUES
('T-BK-20060600001', '2020-06-06', 'K02', 'B01', 1, 500),
('T-BK-20060600002', '2020-06-06', 'K02', 'B02', 1, 55),
('T-BK-20060600003', '2020-06-06', 'K02', 'B03', 1, 50),
('T-BK-20060600004', '2020-06-06', 'K01', 'B01', 1, 25),
('T-BK-20060600005', '2020-06-06', 'K01', 'B02', 1, 5),
('T-BK-20060700001', '2020-06-07', 'K01', 'B01', 1, 5),
('T-BK-20060700002', '2020-06-07', 'K02', 'B04', 1, 5),
('T-BK-20060700003', '2020-06-07', 'K02', 'B04', 1, 2),
('T-BK-20061800001', '2020-06-18', 'K01', 'B05', 1, 200),
('T-BK-20061900001', '2020-06-19', 'K01', 'B01', 1, 20);

--
-- Triggers `barang_keluar`
--
DELIMITER $$
CREATE TRIGGER `update_stok_keluar` BEFORE INSERT ON `barang_keluar` FOR EACH ROW UPDATE `barang` SET `barang`.`stok` = `barang`.`stok` - NEW.jumlah_keluar  WHERE `barang`.`id_barang` = NEW.barang_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `id_barang_masuk` char(16) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `barang_id` char(7) NOT NULL,
  `gudang_id` char(7) NOT NULL,
  `jumlah_masuk` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang_masuk`
--

INSERT INTO `barang_masuk` (`id_barang_masuk`, `tanggal_masuk`, `barang_id`, `gudang_id`, `jumlah_masuk`, `user_id`) VALUES
('T-BM-20060601', '2020-06-06', 'B01', 'G01', 1000, 1),
('T-BM-20060602', '2020-06-06', 'B02', 'G02', 200, 1),
('T-BM-20060603', '2020-06-06', 'B03', 'G02', 300, 1),
('T-BM-20060701', '2020-06-07', 'B04', 'G01', 10, 1),
('T-BM-20061801', '2020-06-18', 'B03', 'G02', 50, 1),
('T-BM-20061802', '2020-06-18', 'B05', 'G01', 500, 1);

--
-- Triggers `barang_masuk`
--
DELIMITER $$
CREATE TRIGGER `update_stok_masuk` BEFORE INSERT ON `barang_masuk` FOR EACH ROW UPDATE `barang` SET `barang`.`stok` = `barang`.`stok` + NEW.jumlah_masuk WHERE `barang`.`id_barang` = NEW.barang_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `gudang`
--

CREATE TABLE `gudang` (
  `id_gudang` char(7) NOT NULL,
  `nama_gudang` varchar(90) NOT NULL,
  `alamat_gudang` varchar(700) NOT NULL,
  `no_tlp` char(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gudang`
--

INSERT INTO `gudang` (`id_gudang`, `nama_gudang`, `alamat_gudang`, `no_tlp`) VALUES
('G01', 'malboro j', 'jl.Falmboyan no 33', '77888'),
('G02', 'Sampoerna', 'jl.Citra No 88', '990088'),
('G03', 'U-Mild', 'jl.Sudirman', '9933444'),
('G04', 'Unilever', 'jl.janti457', '088899966'),
('G05', 'Red', 'jl.mild', '009999');

-- --------------------------------------------------------

--
-- Table structure for table `jenis`
--

CREATE TABLE `jenis` (
  `id_jenis` int(11) NOT NULL,
  `nama_jenis` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenis`
--

INSERT INTO `jenis` (`id_jenis`, `nama_jenis`) VALUES
(6, 'Makanan'),
(7, 'Minuman'),
(8, 'Snack'),
(9, 'Alat tulis'),
(10, 'Tembakau');

-- --------------------------------------------------------

--
-- Table structure for table `konsumen`
--

CREATE TABLE `konsumen` (
  `id_konsumen` char(7) NOT NULL,
  `nama_konsumen` varchar(20) NOT NULL,
  `alamat_konsumen` varchar(100) NOT NULL,
  `no_tlp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `konsumen`
--

INSERT INTO `konsumen` (`id_konsumen`, `nama_konsumen`, `alamat_konsumen`, `no_tlp`) VALUES
('K01', 'Charisma', 'jl janti,Yogyakarta', '0853444555'),
('K02', 'Vanessa', 'jl Maguwo,Yogyakarta', '9990000'),
('K03', 'Anton c', 'jl.lestariyasa', '089977333'),
('K04', 'alfred f', 'jl Nangka', '5566677');

-- --------------------------------------------------------

--
-- Table structure for table `satuan`
--

CREATE TABLE `satuan` (
  `id_satuan` int(11) NOT NULL,
  `nama_satuan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `satuan`
--

INSERT INTO `satuan` (`id_satuan`, `nama_satuan`) VALUES
(1, 'Karung'),
(2, 'Pack'),
(3, 'Botol'),
(4, 'Unit'),
(5, 'Dus'),
(6, 'Butir'),
(7, 'Liter'),
(8, 'Slop');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `username`, `email`, `no_telp`, `password`, `created_at`, `foto`) VALUES
(1, 'Adminisitrator', 'admin', 'admin@admin.com', '0855666677777', '$2y$10$wMgi9s3FEDEPEU6dEmbp8eAAEBUXIXUy3np3ND2Oih.MOY.q/Kpoy', '2020-06-06 19:07:50', '100a99c52257f3f16c1a04bbe6623496.png'),
(14, 'admin', 'Admin2', 'admin@email.com', '08996666', '$2y$10$wMgi9s3FEDEPEU6dEmbp8eAAEBUXIXUy3np3ND2Oih.MOY.q/Kpoy', '0000-00-00 00:00:00', 'user.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `jenis_barang` (`jenis_id`),
  ADD KEY `satuan_id` (`satuan_id`),
  ADD KEY `harga` (`harga`);

--
-- Indexes for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD PRIMARY KEY (`id_barang_keluar`),
  ADD KEY `konsumen_id` (`konsumen_id`),
  ADD KEY `barang_id` (`barang_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD PRIMARY KEY (`id_barang_masuk`),
  ADD KEY `barang_id` (`barang_id`),
  ADD KEY `gudang_id` (`gudang_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `gudang`
--
ALTER TABLE `gudang`
  ADD PRIMARY KEY (`id_gudang`);

--
-- Indexes for table `jenis`
--
ALTER TABLE `jenis`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indexes for table `konsumen`
--
ALTER TABLE `konsumen`
  ADD PRIMARY KEY (`id_konsumen`);

--
-- Indexes for table `satuan`
--
ALTER TABLE `satuan`
  ADD PRIMARY KEY (`id_satuan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jenis`
--
ALTER TABLE `jenis`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `satuan`
--
ALTER TABLE `satuan`
  MODIFY `id_satuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`jenis_id`) REFERENCES `jenis` (`id_jenis`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `barang_ibfk_2` FOREIGN KEY (`satuan_id`) REFERENCES `satuan` (`id_satuan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD CONSTRAINT `barang_keluar_ibfk_1` FOREIGN KEY (`konsumen_id`) REFERENCES `konsumen` (`id_konsumen`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `barang_keluar_ibfk_3` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `barang_keluar_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD CONSTRAINT `barang_masuk_ibfk_1` FOREIGN KEY (`gudang_id`) REFERENCES `gudang` (`id_gudang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `barang_masuk_ibfk_2` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `barang_masuk_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
