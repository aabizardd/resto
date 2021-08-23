-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 23, 2021 at 03:10 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `resto2`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_karyawan`
--

CREATE TABLE `tb_karyawan` (
  `id_karyawan` int(15) NOT NULL,
  `nama_karyawan` varchar(50) NOT NULL,
  `jenis_kelamin_karyawan` enum('Pria','Wanita') NOT NULL,
  `tempat_lahir_karyawan` varchar(20) NOT NULL,
  `tgl_lahir_karyawan` date NOT NULL,
  `agama_karyawan` enum('Islam','Kristen','Katholik','Hindu','Budha') NOT NULL,
  `alamat_karyawan` text NOT NULL,
  `foto_karyawan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_karyawan`
--

INSERT INTO `tb_karyawan` (`id_karyawan`, `nama_karyawan`, `jenis_kelamin_karyawan`, `tempat_lahir_karyawan`, `tgl_lahir_karyawan`, `agama_karyawan`, `alamat_karyawan`, `foto_karyawan`) VALUES
(1, 'Ahad Barjo', 'Pria', 'Jepara', '1978-12-12', 'Islam', 'Ds. Maju Jaya RT 06 Rw 01', 'user1.jpg'),
(2, 'Toni Subiayanto', 'Pria', 'Toni Subiyanto', '1992-12-09', 'Islam', 'Ds. Maju Jaya RT 06 Rw 01', 'user.jpg'),
(8, 'Andi Darso', 'Pria', 'Rembang', '1991-12-02', 'Islam', 'Ds. Maju Jaya RT 03 Rw 01', 'user.jpg'),
(10, 'Mahmud', 'Pria', 'Jepara', '1978-12-12', 'Islam', 'Ds. Maju Jaya RT 06 Rw 01 ', 'user.jpg'),
(12, 'Raul Paulus', 'Pria', 'Bengkulu', '2000-03-28', 'Katholik', 'Bojongsoang Asri 1 Blok A21', 'user.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_login`
--

CREATE TABLE `tb_login` (
  `id_user` varchar(70) NOT NULL,
  `password` varchar(100) NOT NULL,
  `id_user_detail_karyawan` int(11) DEFAULT NULL,
  `status` enum('Aktif','Tidak Aktif') NOT NULL,
  `level` enum('Admin','Kasir','Pelayan','Koki') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_login`
--

INSERT INTO `tb_login` (`id_user`, `password`, `id_user_detail_karyawan`, `status`, `level`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 1, 'Aktif', 'Admin'),
('kasir', 'c7911af3adbd12a035b289556d96470a', 2, 'Aktif', 'Kasir'),
('pelayan', '511cc40443f2a1ab03ab373b77d28091', 8, 'Aktif', 'Pelayan'),
('raul', 'c7911af3adbd12a035b289556d96470a', 12, 'Aktif', 'Kasir');

-- --------------------------------------------------------

--
-- Table structure for table `tb_meja`
--

CREATE TABLE `tb_meja` (
  `id_meja` int(11) NOT NULL,
  `nama_meja` varchar(100) NOT NULL,
  `keterangan_meja` text NOT NULL,
  `status_meja` enum('Tersedia','Tidak Tersedia') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_meja`
--

INSERT INTO `tb_meja` (`id_meja`, `nama_meja`, `keterangan_meja`, `status_meja`) VALUES
(5, 'Meja No.3', '', 'Tersedia');

-- --------------------------------------------------------

--
-- Table structure for table `tb_penjualan_pembayaran`
--

CREATE TABLE `tb_penjualan_pembayaran` (
  `id` int(11) NOT NULL,
  `total_semua` int(11) NOT NULL DEFAULT 0,
  `diskon_total` int(11) NOT NULL DEFAULT 0,
  `total` int(11) NOT NULL DEFAULT 0,
  `service_fee_persen` int(11) NOT NULL DEFAULT 0,
  `service_fee_angka` int(11) NOT NULL DEFAULT 0,
  `pajak_persen` int(11) NOT NULL DEFAULT 0,
  `pajak_angka` int(11) NOT NULL DEFAULT 0,
  `tunai` int(11) NOT NULL DEFAULT 0,
  `dp` int(11) NOT NULL DEFAULT 0,
  `voucher` int(11) NOT NULL DEFAULT 0,
  `card` int(11) NOT NULL DEFAULT 0,
  `kredit` int(11) NOT NULL DEFAULT 0,
  `kembali` int(11) NOT NULL DEFAULT 0,
  `id_penjualan` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_penjualan_pembayaran`
--

INSERT INTO `tb_penjualan_pembayaran` (`id`, `total_semua`, `diskon_total`, `total`, `service_fee_persen`, `service_fee_angka`, `pajak_persen`, `pajak_angka`, `tunai`, `dp`, `voucher`, `card`, `kredit`, `kembali`, `id_penjualan`, `created_at`) VALUES
(3, 30000, 0, 39000, 10, 3000, 20, 6000, 39000, 0, 0, 0, 0, 0, '0000001', '2021-08-19 07:06:20'),
(4, 0, 0, 0, 10, 0, 20, 0, 0, 0, 0, 0, 0, 0, '0000002', '2021-08-21 04:44:19'),
(5, 65000, 5000, 78000, 10, 6000, 20, 12000, 78000, 0, 0, 0, 0, 0, '0000003', '2021-08-21 06:29:58');

-- --------------------------------------------------------

--
-- Table structure for table `tb_printer`
--

CREATE TABLE `tb_printer` (
  `id_printer` int(11) NOT NULL,
  `ip_printer` varchar(20) NOT NULL,
  `port_printer` varchar(10) NOT NULL,
  `cetak_ke` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_produk`
--

CREATE TABLE `tb_produk` (
  `id_produk` int(11) NOT NULL,
  `id_produk_kategori` int(11) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `harga_produk` varchar(100) NOT NULL,
  `keterangan_produk` text NOT NULL,
  `foto_produk` varchar(200) NOT NULL,
  `diskon` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_produk`
--

INSERT INTO `tb_produk` (`id_produk`, `id_produk_kategori`, `nama_produk`, `harga_produk`, `keterangan_produk`, `foto_produk`, `diskon`) VALUES
(26, 1, 'Martabak Telur', '15.000', '', 'martabak.jpg', 0),
(27, 3, 'Nasi Ayam Mentega', '25.000', '', 'ayam_pedasjpg.jpg', 10);

-- --------------------------------------------------------

--
-- Table structure for table `tb_produk_kategori`
--

CREATE TABLE `tb_produk_kategori` (
  `id_produk_kategori` int(11) NOT NULL,
  `produk_kategori` varchar(100) NOT NULL,
  `produk_kategori_keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_produk_kategori`
--

INSERT INTO `tb_produk_kategori` (`id_produk_kategori`, `produk_kategori`, `produk_kategori_keterangan`) VALUES
(1, 'appetizer', 'Appetizer'),
(3, 'Main Course', 'Main course'),
(4, 'Dessert', 'Dessert'),
(5, 'Drink', 'Drink');

-- --------------------------------------------------------

--
-- Table structure for table `tb_setting`
--

CREATE TABLE `tb_setting` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `nilai` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_setting`
--

INSERT INTO `tb_setting` (`id`, `nama`, `nilai`) VALUES
(1, 'pajak', 20),
(2, 'service_fee', 10);

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi_penjualan`
--

CREATE TABLE `tb_transaksi_penjualan` (
  `id_transaksi_penjualan` varchar(10) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `id_meja` int(11) NOT NULL,
  `total_transaksi` varchar(200) NOT NULL,
  `id_user` varchar(70) NOT NULL,
  `status_konfirmasi_koki` enum('Konfirmasi','Belum Konfirmasi') NOT NULL DEFAULT 'Belum Konfirmasi',
  `id_kasir` varchar(70) DEFAULT NULL,
  `bayar_transaksi` varchar(200) NOT NULL,
  `kembalian_transaksi` varchar(200) NOT NULL,
  `status_pembayaran_transaksi` enum('Sudah Bayar','Belum Bayar') NOT NULL DEFAULT 'Belum Bayar',
  `pelanggan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_transaksi_penjualan`
--

INSERT INTO `tb_transaksi_penjualan` (`id_transaksi_penjualan`, `tanggal_transaksi`, `id_meja`, `total_transaksi`, `id_user`, `status_konfirmasi_koki`, `id_kasir`, `bayar_transaksi`, `kembalian_transaksi`, `status_pembayaran_transaksi`, `pelanggan`) VALUES
('0000001', '2021-08-19', 5, '39000', 'admin', 'Konfirmasi', NULL, '', '', 'Sudah Bayar', 'Raul'),
('0000002', '2021-08-21', 5, '0', 'admin', 'Konfirmasi', NULL, '', '', 'Sudah Bayar', 'raul'),
('0000003', '2021-10-21', 5, '78000', 'admin', 'Konfirmasi', NULL, '', '', 'Sudah Bayar', 'raul');

--
-- Triggers `tb_transaksi_penjualan`
--
DELIMITER $$
CREATE TRIGGER `tr_hapus_transaksi_penjualan_detail` AFTER DELETE ON `tb_transaksi_penjualan` FOR EACH ROW DELETE FROM tb_transaksi_penjualan_detail WHERE id_transaksi_penjualan = OLD.id_transaksi_penjualan
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi_penjualan_detail`
--

CREATE TABLE `tb_transaksi_penjualan_detail` (
  `id_transaksi_penjualan_detail` int(11) NOT NULL,
  `id_transaksi_penjualan` varchar(100) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `harga_transaksi` varchar(100) NOT NULL,
  `jumlah_transaksi` varchar(50) NOT NULL,
  `total_transaksi` varchar(100) NOT NULL,
  `status_transaksi` enum('Terima','Tolak','') NOT NULL DEFAULT '',
  `catatan_status_detail` varchar(100) NOT NULL,
  `diskon_persen` int(11) NOT NULL DEFAULT 0,
  `diskon_angka` int(11) NOT NULL DEFAULT 0,
  `total_semua` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_transaksi_penjualan_detail`
--

INSERT INTO `tb_transaksi_penjualan_detail` (`id_transaksi_penjualan_detail`, `id_transaksi_penjualan`, `id_produk`, `harga_transaksi`, `jumlah_transaksi`, `total_transaksi`, `status_transaksi`, `catatan_status_detail`, `diskon_persen`, `diskon_angka`, `total_semua`) VALUES
(4, '0000001', 26, '15000', '2', '30000', 'Terima', '', 0, 0, 30000),
(5, '0000002', 27, '25000', '2', '45000', 'Terima', '', 10, 5000, 50000),
(6, '0000003', 26, '15000', '1', '15000', 'Terima', '', 0, 0, 15000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi_penjualan_detail_sementara`
--

CREATE TABLE `tb_transaksi_penjualan_detail_sementara` (
  `id_transaksi_penjualan_detail_sementara` int(11) NOT NULL,
  `id_transaksi_penjualan` varchar(100) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `harga_transaksi` varchar(100) NOT NULL,
  `jumlah_transaksi` varchar(50) NOT NULL,
  `total_transaksi` varchar(100) NOT NULL,
  `id_user` varchar(70) NOT NULL,
  `diskon_angka` int(11) NOT NULL DEFAULT 0,
  `diskon_persen` int(11) NOT NULL DEFAULT 0,
  `total_semua` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_web`
--

CREATE TABLE `tb_web` (
  `id_web` int(11) NOT NULL,
  `nama_web` varchar(35) NOT NULL,
  `slogan_web` text NOT NULL,
  `alamat_web` text NOT NULL,
  `kabupaten_web` varchar(25) NOT NULL,
  `telp_web` varchar(16) NOT NULL,
  `fax_web` varchar(16) NOT NULL,
  `email_web` varchar(50) NOT NULL,
  `author_web` varchar(50) NOT NULL,
  `deskripsi_web` text NOT NULL,
  `keyword_web` text NOT NULL,
  `tahun_web` varchar(7) NOT NULL,
  `logo_web` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_web`
--

INSERT INTO `tb_web` (`id_web`, `nama_web`, `slogan_web`, `alamat_web`, `kabupaten_web`, `telp_web`, `fax_web`, `email_web`, `author_web`, `deskripsi_web`, `keyword_web`, `tahun_web`, `logo_web`) VALUES
(1, 'Smart Resto', 'Aplikasi Smart Resto', 'Jl.Bojongsoang Asri Blok A.21', 'Bojongsoang', '081214111876', '08121411876', 'smartresto@gmail.com', 'Smart resto', 'Smart Cafe adalah sebuah aplikasi pengelola cafe', 'Smart Resto', '2020', 'smartcafe.png');

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_graph_menu_fav`
-- (See below for the actual view)
--
CREATE TABLE `v_graph_menu_fav` (
`ct` bigint(21)
,`nama_produk` varchar(100)
,`tanggal_transaksi` date
);

-- --------------------------------------------------------

--
-- Structure for view `v_graph_menu_fav`
--
DROP TABLE IF EXISTS `v_graph_menu_fav`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_graph_menu_fav`  AS SELECT count(`ttpd`.`id_transaksi_penjualan`) AS `ct`, `tp`.`nama_produk` AS `nama_produk`, `ttp`.`tanggal_transaksi` AS `tanggal_transaksi` FROM ((`tb_transaksi_penjualan` `ttp` join `tb_transaksi_penjualan_detail` `ttpd` on(`ttp`.`id_transaksi_penjualan` = `ttpd`.`id_transaksi_penjualan`)) join `tb_produk` `tp` on(`ttpd`.`id_produk` = `tp`.`id_produk`)) WHERE `ttp`.`status_pembayaran_transaksi` = 'Sudah Bayar' AND year(`ttp`.`tanggal_transaksi`) = year(current_timestamp()) GROUP BY month(`ttp`.`tanggal_transaksi`), `ttpd`.`id_produk` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_karyawan`
--
ALTER TABLE `tb_karyawan`
  ADD PRIMARY KEY (`id_karyawan`);

--
-- Indexes for table `tb_login`
--
ALTER TABLE `tb_login`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_user_detail_karyawan` (`id_user_detail_karyawan`);

--
-- Indexes for table `tb_meja`
--
ALTER TABLE `tb_meja`
  ADD PRIMARY KEY (`id_meja`);

--
-- Indexes for table `tb_penjualan_pembayaran`
--
ALTER TABLE `tb_penjualan_pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_printer`
--
ALTER TABLE `tb_printer`
  ADD PRIMARY KEY (`id_printer`);

--
-- Indexes for table `tb_produk`
--
ALTER TABLE `tb_produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `id_produk_kategori` (`id_produk_kategori`),
  ADD KEY `id_produk_kategori_2` (`id_produk_kategori`);

--
-- Indexes for table `tb_produk_kategori`
--
ALTER TABLE `tb_produk_kategori`
  ADD PRIMARY KEY (`id_produk_kategori`);

--
-- Indexes for table `tb_setting`
--
ALTER TABLE `tb_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_transaksi_penjualan`
--
ALTER TABLE `tb_transaksi_penjualan`
  ADD PRIMARY KEY (`id_transaksi_penjualan`),
  ADD KEY `id_meja` (`id_meja`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_kasir_2` (`id_kasir`),
  ADD KEY `id_kasir_3` (`id_kasir`),
  ADD KEY `id_meja_2` (`id_meja`),
  ADD KEY `id_kasir_4` (`id_kasir`),
  ADD KEY `id_kasir` (`id_kasir`),
  ADD KEY `id_kasir_5` (`id_kasir`);

--
-- Indexes for table `tb_transaksi_penjualan_detail`
--
ALTER TABLE `tb_transaksi_penjualan_detail`
  ADD PRIMARY KEY (`id_transaksi_penjualan_detail`),
  ADD KEY `id_produk` (`id_produk`),
  ADD KEY `id_produk_2` (`id_produk`),
  ADD KEY `id_produk_3` (`id_produk`),
  ADD KEY `id_transaksi_penjualan` (`id_transaksi_penjualan`);

--
-- Indexes for table `tb_transaksi_penjualan_detail_sementara`
--
ALTER TABLE `tb_transaksi_penjualan_detail_sementara`
  ADD PRIMARY KEY (`id_transaksi_penjualan_detail_sementara`),
  ADD KEY `id_produk` (`id_produk`,`id_user`),
  ADD KEY `id_produk_2` (`id_produk`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `tb_web`
--
ALTER TABLE `tb_web`
  ADD PRIMARY KEY (`id_web`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_karyawan`
--
ALTER TABLE `tb_karyawan`
  MODIFY `id_karyawan` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tb_meja`
--
ALTER TABLE `tb_meja`
  MODIFY `id_meja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_penjualan_pembayaran`
--
ALTER TABLE `tb_penjualan_pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_printer`
--
ALTER TABLE `tb_printer`
  MODIFY `id_printer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_produk`
--
ALTER TABLE `tb_produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tb_produk_kategori`
--
ALTER TABLE `tb_produk_kategori`
  MODIFY `id_produk_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_setting`
--
ALTER TABLE `tb_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_transaksi_penjualan_detail`
--
ALTER TABLE `tb_transaksi_penjualan_detail`
  MODIFY `id_transaksi_penjualan_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_transaksi_penjualan_detail_sementara`
--
ALTER TABLE `tb_transaksi_penjualan_detail_sementara`
  MODIFY `id_transaksi_penjualan_detail_sementara` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_web`
--
ALTER TABLE `tb_web`
  MODIFY `id_web` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_login`
--
ALTER TABLE `tb_login`
  ADD CONSTRAINT `tb_login_ibfk_1` FOREIGN KEY (`id_user_detail_karyawan`) REFERENCES `tb_karyawan` (`id_karyawan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_produk`
--
ALTER TABLE `tb_produk`
  ADD CONSTRAINT `tb_produk_ibfk_1` FOREIGN KEY (`id_produk_kategori`) REFERENCES `tb_produk_kategori` (`id_produk_kategori`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_transaksi_penjualan`
--
ALTER TABLE `tb_transaksi_penjualan`
  ADD CONSTRAINT `tb_transaksi_penjualan_ibfk_2` FOREIGN KEY (`id_meja`) REFERENCES `tb_meja` (`id_meja`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_transaksi_penjualan_ibfk_3` FOREIGN KEY (`id_kasir`) REFERENCES `tb_login` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_transaksi_penjualan_ibfk_4` FOREIGN KEY (`id_user`) REFERENCES `tb_login` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_transaksi_penjualan_detail`
--
ALTER TABLE `tb_transaksi_penjualan_detail`
  ADD CONSTRAINT `tb_transaksi_penjualan_detail_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `tb_produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_transaksi_penjualan_detail_ibfk_2` FOREIGN KEY (`id_transaksi_penjualan`) REFERENCES `tb_transaksi_penjualan` (`id_transaksi_penjualan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_transaksi_penjualan_detail_sementara`
--
ALTER TABLE `tb_transaksi_penjualan_detail_sementara`
  ADD CONSTRAINT `tb_transaksi_penjualan_detail_sementara_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `tb_produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_transaksi_penjualan_detail_sementara_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `tb_login` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
