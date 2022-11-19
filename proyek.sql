-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2021 at 04:01 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `proyek`
--
CREATE DATABASE IF NOT EXISTS `proyek` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `proyek`;

-- --------------------------------------------------------

--
-- Table structure for table `bukus`
--

DROP TABLE IF EXISTS `bukus`;
CREATE TABLE `bukus` (
  `id_buku` int(11) NOT NULL,
  `nama_buku` varchar(50) NOT NULL,
  `deskripsi_buku` varchar(50) NOT NULL,
  `fk_user` int(11) NOT NULL,
  `saldo_awal` int(255) NOT NULL,
  `saldo_akhir` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bukus`
--

INSERT INTO `bukus` (`id_buku`, `nama_buku`, `deskripsi_buku`, `fk_user`, `saldo_awal`, `saldo_akhir`) VALUES
(2, 'www', 'uang di tabungan', 2, 500000, 1000),
(7, 'dompet', 'uang di tabungan saya', 7, 130000, 130000),
(13, 'DAILY LIFE', 'uangku', 15, 1000000, 985000);

-- --------------------------------------------------------

--
-- Table structure for table `kategoris`
--

DROP TABLE IF EXISTS `kategoris`;
CREATE TABLE `kategoris` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL,
  `fk_user` int(11) NOT NULL,
  `jenis_kategori` varchar(50) NOT NULL,
  `status_kategori` int(11) NOT NULL DEFAULT 0 COMMENT '0 = visible\r\n1 = disabled'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategoris`
--

INSERT INTO `kategoris` (`id_kategori`, `nama_kategori`, `fk_user`, `jenis_kategori`, `status_kategori`) VALUES
(1, 'utang', 0, 'pengeluaran', 1),
(2, 'piutang', 0, 'pemasukan', 1),
(7, 'gaji', 2, 'pemasukan', 1),
(8, 'bonus', 2, 'pemasukan', 0),
(18, 'rr', 2, 'pengeluaran', 0),
(20, '12333', 2, 'pemasukan', 1),
(27, 'belanja', 6, 'pengeluaran', 0),
(28, 'makanan', 6, 'pengeluaran', 0),
(29, 'gaji', 6, 'pemasukan', 0),
(30, 'bonus', 6, 'pemasukan', 0),
(31, 'belanja', 7, 'pengeluaran', 0),
(32, 'makanan', 7, 'pengeluaran', 0),
(33, 'gajiku', 7, 'pemasukan', 0),
(34, 'bonus', 7, 'pemasukan', 0),
(35, 'korupsi', 7, 'pemasukan', 0),
(36, 'gaji', 2, 'pemasukan', 0),
(49, 'test', 2, 'pemasukan', 0),
(50, 'test1', 2, 'pemasukan', 0),
(51, 'test123', 2, 'pemasukan', 0),
(52, 'belanja', 18, 'pengeluaran', 0),
(53, 'makanan', 18, 'pengeluaran', 0),
(54, 'gaji', 18, 'pemasukan', 0),
(55, 'bonus', 18, 'pemasukan', 0),
(56, 'belanja', 18, 'pengeluaran', 0),
(57, 'makanan', 18, 'pengeluaran', 0),
(58, 'gaji', 18, 'pemasukan', 0),
(59, 'bonus', 18, 'pemasukan', 0),
(60, 'gaji', 15, 'pemasukan', 0),
(61, 'bonus', 15, 'pemasukan', 0),
(62, 'makanan', 15, 'pengeluaran', 0),
(63, 'minuman', 15, 'pengeluaran', 0),
(64, 'premium', 15, 'pengeluaran', 1);

-- --------------------------------------------------------

--
-- Table structure for table `transaksis`
--

DROP TABLE IF EXISTS `transaksis`;
CREATE TABLE `transaksis` (
  `id_transaksi` int(11) NOT NULL,
  `jenis_transaksi` varchar(50) NOT NULL,
  `fk_buku` int(11) NOT NULL,
  `tanggal_transaksi` date NOT NULL DEFAULT current_timestamp(),
  `deskripsi_transaksi` varchar(200) NOT NULL,
  `nominal_transaksi` int(200) NOT NULL,
  `fk_kategori` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksis`
--

INSERT INTO `transaksis` (`id_transaksi`, `jenis_transaksi`, `fk_buku`, `tanggal_transaksi`, `deskripsi_transaksi`, `nominal_transaksi`, `fk_kategori`) VALUES
(9, 'pengeluaran', 2, '2021-05-02', '1233333', 200000, 18),
(11, 'pemasukan', 2, '2021-05-05', '123', 30000, 8),
(12, 'pemasukan', 2, '2021-05-04', '123', 50000, 7),
(13, 'pengeluaran', 2, '2021-06-05', '123', 50000, 18),
(14, 'pemasukan', 7, '2021-05-07', '123', 70000, 33),
(15, 'pengeluaran', 7, '2021-05-07', '123', 20000, 31),
(16, 'pemasukan', 2, '2021-05-11', '123', 50000, 8),
(17, 'pemasukan', 2, '2021-05-12', '123', 50000, 36),
(18, 'pengeluaran', 2, '2021-05-13', '123', 25000, 18),
(19, 'pengeluaran', 2, '2021-05-13', '123', 1000, 1),
(20, 'pemasukan', 2, '2021-05-13', '123333', 5000, 2),
(21, 'pemasukan', 2, '2020-12-13', 'desember 2020', 50000, 8),
(22, 'pengeluaran', 2, '2021-05-13', 'r', 100000, 18),
(23, 'pengeluaran', 2, '2021-05-13', '1233', 500000, 18),
(24, 'pemasukan', 2, '2021-05-14', '123', 50000, 36),
(25, 'pemasukan', 2, '2021-05-14', '1', 92000, 8),
(29, 'Pemasukan', 2, '2021-11-28', 'adfadfadf', 100000, 20),
(30, 'Pengeluaran', 2, '2021-11-15', 'adfafdafasdf', 100000, 18),
(31, 'Pemasukan', 13, '2021-11-28', 'adfadf', 100000, 61),
(32, 'Pengeluaran', 13, '2021-11-14', 'adfadf', 100000, 63);

-- --------------------------------------------------------

--
-- Table structure for table `upgrades`
--

DROP TABLE IF EXISTS `upgrades`;
CREATE TABLE `upgrades` (
  `id_upgrade` int(11) NOT NULL,
  `fk_user` int(11) NOT NULL,
  `tanggal_pembelian` date NOT NULL,
  `tanggal_diterima` date DEFAULT NULL,
  `metode_upgrade` varchar(50) NOT NULL,
  `atas_nama` varchar(255) NOT NULL,
  `status_upgrade` varchar(50) NOT NULL,
  `file_name` varchar(100) NOT NULL,
  `path` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `upgrades`
--

INSERT INTO `upgrades` (`id_upgrade`, `fk_user`, `tanggal_pembelian`, `tanggal_diterima`, `metode_upgrade`, `atas_nama`, `status_upgrade`, `file_name`, `path`) VALUES
(30, 2, '2021-05-17', '2021-05-17', 'BCA', 'jestine', 'hide', '1.jpg', ''),
(31, 2, '2021-01-01', '2021-01-01', 'BCA', 'jestine', 'menunggu konfirmasi', '', ''),
(32, 2, '2021-02-01', '2021-02-01', 'BCA', 'jestine', 'menunggu konfirmasi', '', ''),
(33, 2, '2021-03-01', '2021-03-01', 'BCA', 'jestine', 'menunggu konfirmasi', '', ''),
(34, 2, '2021-04-01', '2021-04-01', 'BCA', 'jestine', 'menunggu konfirmasi', '', ''),
(35, 2, '2021-05-01', '2021-05-17', 'BCA', 'jestine', 'diterima', '', ''),
(36, 2, '2021-06-01', '2021-06-01', 'BCA', 'jestine', 'menunggu konfirmasi', '', ''),
(37, 2, '2021-07-01', '2021-07-01', 'BCA', 'jestine', 'menunggu konfirmasi', '', ''),
(39, 2, '2021-09-01', '2021-09-01', 'BCA', 'jestine', 'menunggu konfirmasi', '', ''),
(40, 2, '2021-10-01', '2021-10-01', 'BCA', 'jestine', 'menunggu konfirmasi', '', ''),
(41, 2, '2021-11-01', '2021-11-01', 'BCA', 'jestine', 'menunggu konfirmasi', '', ''),
(42, 2, '2021-12-01', '2021-12-01', 'BCA', 'jestine', 'menunggu konfirmasi', '', ''),
(43, 2, '2021-04-01', '2021-04-01', 'BCA', 'jestine', 'menunggu konfirmasi', '', ''),
(45, 15, '2021-11-28', NULL, 'BCA', 'Jem Angkasa', 'menunggu konfirmasi', 'belimbing.png', 'public/files/15.png'),
(46, 15, '2021-11-28', NULL, 'BCA', 'Jem Angkasa', 'menunggu konfirmasi', 'belimbing.png', 'public/files/15.png'),
(47, 15, '2021-11-28', NULL, 'BCA', 'Jem', 'menunggu konfirmasi', 'belimbing.png', 'public/files/15.png'),
(48, 15, '2021-11-28', '2021-11-28', 'BCA', 'Jem', 'diterima', 'belimbing.png', 'public/files/15.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `status` int(11) NOT NULL COMMENT '-1 = not verified\r\n0 = standard\r\n1 = menunggu konfirmasi admin\r\n2 = premium',
  `hash` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `email`, `fullname`, `gender`, `password`, `status`, `hash`) VALUES
(2, 'jestine23siewij23@gmail.com', 'Jestine Siewi', 'Perempuan', '123', 2, ''),
(3, 'feliagabriella@gmail.com', 'Felia Gabriella', 'Laki-Laki', 'felia', 0, ''),
(15, 'michelleannabelle21@gmail.com', 'Michelle Annabelle', 'Perempuan', '1234', 2, 'b534ba68236ba543ae44b22bd110a1d6'),
(21, 'jestine.s20@mhs.istts.ac.id', 'Jestine Siewij', 'Perempuan', '123', -1, '577bcc914f9e55d5e4e4f82f9f00e7d4');

-- --------------------------------------------------------

--
-- Table structure for table `utangpiutangs`
--

DROP TABLE IF EXISTS `utangpiutangs`;
CREATE TABLE `utangpiutangs` (
  `id_up` int(11) NOT NULL,
  `tanggal_up` date NOT NULL,
  `klien` varchar(500) NOT NULL,
  `deskripsi_up` varchar(500) NOT NULL,
  `nominal_up` int(200) NOT NULL,
  `cicilan_up` int(200) NOT NULL,
  `status_up` int(11) NOT NULL COMMENT '0 = belum lunas\r\n1 = lunas',
  `fk_user` int(11) NOT NULL,
  `tanggal_jatuhtempo` date NOT NULL,
  `jenis_up` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `utangpiutangs`
--

INSERT INTO `utangpiutangs` (`id_up`, `tanggal_up`, `klien`, `deskripsi_up`, `nominal_up`, `cicilan_up`, `status_up`, `fk_user`, `tanggal_jatuhtempo`, `jenis_up`) VALUES
(3, '2021-05-02', 'jestine', '123', 0, 0, 1, 2, '2021-05-02', 'utang'),
(7, '2021-05-02', 'jestine', '123333', 55000, 5000, 0, 2, '2021-05-02', 'piutang'),
(8, '2021-05-07', 'jestine', '123', 50000, 0, 1, 7, '2021-05-07', 'utang'),
(9, '2021-05-07', 'jestine', '123', 30000, 0, 0, 7, '2021-05-07', 'piutang'),
(10, '2021-05-11', 'jestine', '123', 20000, 20000, 1, 2, '2021-05-11', 'utang'),
(11, '2021-05-13', 'jestine', '123', 50000, 2000, 0, 2, '2021-05-13', 'utang'),
(13, '2021-05-14', '123', '3', 20000, 0, 0, 2, '2021-05-14', 'utang');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bukus`
--
ALTER TABLE `bukus`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indexes for table `kategoris`
--
ALTER TABLE `kategoris`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `transaksis`
--
ALTER TABLE `transaksis`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `upgrades`
--
ALTER TABLE `upgrades`
  ADD PRIMARY KEY (`id_upgrade`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `utangpiutangs`
--
ALTER TABLE `utangpiutangs`
  ADD PRIMARY KEY (`id_up`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bukus`
--
ALTER TABLE `bukus`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `kategoris`
--
ALTER TABLE `kategoris`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `transaksis`
--
ALTER TABLE `transaksis`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `upgrades`
--
ALTER TABLE `upgrades`
  MODIFY `id_upgrade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `utangpiutangs`
--
ALTER TABLE `utangpiutangs`
  MODIFY `id_up` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
