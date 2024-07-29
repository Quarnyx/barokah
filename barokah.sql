-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 29, 2024 at 03:36 AM
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
-- Database: `barokah`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `id_akun` int(11) NOT NULL,
  `nama_akun` varchar(100) NOT NULL,
  `jenis_akun` enum('1','0') DEFAULT NULL,
  `tipe_akun` enum('Aktiva Lancar','Aktiva Tetap','Modal','Utang Lancar','Pendapatan','Beban','Pengeluaran','Kewajiban','Harga Pokok Penjualan') NOT NULL,
  `kode_akun` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`id_akun`, `nama_akun`, `jenis_akun`, `tipe_akun`, `kode_akun`) VALUES
(1, 'Bangunan', '0', 'Aktiva Tetap', '00001'),
(2, 'Kas di tangan', '1', 'Aktiva Lancar', '0111'),
(4, 'Persediaan', '1', 'Aktiva Lancar', '92313'),
(5, 'Pendapatan', '1', 'Pendapatan', '00004'),
(6, 'Harga Pokok Penjualan', '1', 'Harga Pokok Penjualan', '012123'),
(7, 'Modal', '0', 'Modal', '2313'),
(8, 'Utang', '0', 'Utang Lancar', '00023'),
(9, 'Gaji Karyawan', '0', 'Beban', '23123'),
(10, 'Peralatan', '0', 'Aktiva Tetap', '453533');

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `kode_barang` varchar(20) NOT NULL,
  `harga_jual` decimal(10,2) NOT NULL,
  `harga_beli` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `kode_barang`, `harga_jual`, `harga_beli`) VALUES
(1, 'Indomie', 'SKU-123', 2400.00, 2000.00),
(2, 'Pepsodent', 'SKU-1212', 6000.00, 5000.00),
(4, 'Barang A', 'SKU 999', 10000.00, 5000.00);

-- --------------------------------------------------------

--
-- Table structure for table `detail_penjualan`
--

CREATE TABLE `detail_penjualan` (
  `id_detail_penjualan` int(11) NOT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `harga_beli` decimal(10,2) DEFAULT NULL,
  `harga_jual` decimal(10,2) DEFAULT NULL,
  `kode_penjualan` varchar(20) DEFAULT NULL,
  `tanggal_penjualan` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_penjualan`
--

INSERT INTO `detail_penjualan` (`id_detail_penjualan`, `id_barang`, `qty`, `harga_beli`, `harga_jual`, `kode_penjualan`, `tanggal_penjualan`) VALUES
(8, 2, 2, 5000.00, 6000.00, 'PJN003', '2024-07-29'),
(9, 4, 1, 5000.00, 10000.00, 'PJN001', '2024-07-29');

-- --------------------------------------------------------

--
-- Table structure for table `jurnal`
--

CREATE TABLE `jurnal` (
  `id_transaksi` int(11) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `total` decimal(15,2) NOT NULL,
  `catatan` varchar(255) DEFAULT NULL,
  `id_akun_debit` int(11) DEFAULT NULL,
  `id_akun_kredit` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jurnal`
--

INSERT INTO `jurnal` (`id_transaksi`, `tanggal_transaksi`, `total`, `catatan`, `id_akun_debit`, `id_akun_kredit`) VALUES
(39, '2024-03-01', 50000000.00, 'Modal Awal', 2, 7),
(40, '2024-05-16', 10000000.00, 'Utang Bank', 2, 8),
(41, '2024-06-01', 100000.00, 'PembelianPMB001', 4, 2),
(42, '2024-06-20', 500000.00, 'PembelianPMB002', 4, 2),
(43, '2024-06-01', 2000000.00, 'Beli Printer', 10, 2),
(54, '0000-00-00', 50000.00, 'PembelianPMB003', 4, 2),
(55, '2024-07-29', 5000.00, 'Penjualan HPP PJN001', 6, 4),
(56, '2024-07-29', 10000.00, 'Penjualan Masuk PJN001', 2, 5),
(57, '2024-07-29', 5000.00, 'bayar', 9, 2);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama_pelanggan` varchar(100) DEFAULT NULL,
  `alamat_pelanggan` text DEFAULT NULL,
  `no_hp` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama_pelanggan`, `alamat_pelanggan`, `no_hp`) VALUES
(2, 'Anugrah Sandya', 'Sri Agung Cepiringasda', '08324234232'),
(3, 'Umum', '-', '0');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `id_pembelian` int(11) NOT NULL,
  `kode_pembelian` varchar(20) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `id_transaksi` int(11) DEFAULT NULL,
  `tanggal_pembelian` date DEFAULT NULL,
  `id_supplier` int(11) DEFAULT NULL,
  `harga_beli` decimal(10,2) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `gambar` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`id_pembelian`, `kode_pembelian`, `id_barang`, `id_transaksi`, `tanggal_pembelian`, `id_supplier`, `harga_beli`, `qty`, `gambar`) VALUES
(7, 'PMB001', 1, 41, '2024-06-01', 4, 2000.00, 50, '277503.webp'),
(8, 'PMB002', 2, 42, '2024-06-20', 4, 5000.00, 100, '697019.jpg'),
(10, 'PMB003', 4, 54, '0000-00-00', 4, 5000.00, 10, '156939.png');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id_user`, `nama_user`, `username`, `password`, `level`) VALUES
(1, 'Admin', 'admin', '0192023a7bbd73250516f069df18b500', 'Pemilik'),
(4, 'Nama Karyawanaa', 'karyawan', '07142c5501c3ea09303d899012e2b47d', 'Karyawan');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id_penjualan` int(11) NOT NULL,
  `tanggal_penjualan` date DEFAULT NULL,
  `kode_penjualan` varchar(20) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_pelanggan` int(11) DEFAULT NULL,
  `id_transaksi` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id_penjualan`, `tanggal_penjualan`, `kode_penjualan`, `total`, `id_user`, `id_pelanggan`, `id_transaksi`) VALUES
(13, '2024-07-29', 'PJN001', 10000.00, 4, 3, 56);

-- --------------------------------------------------------

--
-- Table structure for table `return_pembelian`
--

CREATE TABLE `return_pembelian` (
  `id_return_pembelian` int(11) NOT NULL,
  `kode_return_pembelian` varchar(20) DEFAULT NULL,
  `catatan` varchar(255) DEFAULT NULL,
  `tanggal_return_pembelian` date DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `return_pembelian`
--

INSERT INTO `return_pembelian` (`id_return_pembelian`, `kode_return_pembelian`, `catatan`, `tanggal_return_pembelian`, `jumlah`, `id_barang`) VALUES
(1, 'RPB001', 'adsdad', '2024-07-28', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `return_penjualan`
--

CREATE TABLE `return_penjualan` (
  `id_return_penjualan` int(11) NOT NULL,
  `kode_return_penjualan` varchar(20) DEFAULT NULL,
  `catatan` varchar(255) DEFAULT NULL,
  `tanggal_return_penjualan` date DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `return_penjualan`
--

INSERT INTO `return_penjualan` (`id_return_penjualan`, `kode_return_penjualan`, `catatan`, `tanggal_return_penjualan`, `jumlah`, `id_barang`) VALUES
(1, 'RPJ001', 'asddad', '2024-07-28', 23, 2),
(2, 'RPJ002', 'adasdada', '2024-06-14', 33, 1);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` int(11) NOT NULL,
  `nama_supplier` varchar(200) DEFAULT NULL,
  `alamat_supplier` text DEFAULT NULL,
  `telp` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama_supplier`, `alamat_supplier`, `telp`) VALUES
(4, 'JNE A', 'Kendal', '2983982');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_inventory`
--

CREATE TABLE `transaksi_inventory` (
  `id_inventory` int(11) NOT NULL,
  `id_transaksi` int(11) DEFAULT NULL,
  `id_supplier` int(11) DEFAULT NULL,
  `jenis_transaksi` enum('Masuk','Keluar') DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `tanggal_transaksi` date DEFAULT NULL,
  `harga_beli` decimal(10,2) DEFAULT NULL,
  `harga_jual` decimal(10,2) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `id_detail_penjualan` int(11) DEFAULT NULL,
  `gambar` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_jurnal`
-- (See below for the actual view)
--
CREATE TABLE `v_jurnal` (
`tanggal_transaksi` date
,`catatan` varchar(255)
,`nama_akun` varchar(100)
,`tipe_akun` enum('Aktiva Lancar','Aktiva Tetap','Modal','Utang Lancar','Pendapatan','Beban','Pengeluaran','Kewajiban','Harga Pokok Penjualan')
,`id_transaksi` int(11)
,`debit` decimal(15,2)
,`kredit` decimal(15,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_pembelian`
-- (See below for the actual view)
--
CREATE TABLE `v_pembelian` (
`id_pembelian` int(11)
,`kode_pembelian` varchar(20)
,`harga_beli` decimal(10,2)
,`qty` int(11)
,`nama_barang` varchar(50)
,`nama_supplier` varchar(200)
,`id_akun_debit` int(11)
,`id_akun_kredit` int(11)
,`tanggal_pembelian` date
,`id_barang` int(11)
,`id_transaksi` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_penjualan`
-- (See below for the actual view)
--
CREATE TABLE `v_penjualan` (
`kode_penjualan` varchar(20)
,`nama_barang` varchar(50)
,`harga_beli` decimal(10,2)
,`harga_jual` decimal(10,2)
,`qty` int(11)
,`id_detail_penjualan` int(11)
,`tanggal_penjualan` date
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_returnpembelian`
-- (See below for the actual view)
--
CREATE TABLE `v_returnpembelian` (
`nama_barang` varchar(50)
,`id_return_pembelian` int(11)
,`kode_return_pembelian` varchar(20)
,`catatan` varchar(255)
,`tanggal_return_pembelian` date
,`id_barang` int(11)
,`jumlah` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_returnpenjualan`
-- (See below for the actual view)
--
CREATE TABLE `v_returnpenjualan` (
`nama_barang` varchar(50)
,`kode_return_penjualan` varchar(20)
,`catatan` varchar(255)
,`id_return_penjualan` int(11)
,`tanggal_return_penjualan` date
,`jumlah` int(11)
,`id_barang` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_stokin`
-- (See below for the actual view)
--
CREATE TABLE `v_stokin` (
`id_barang` int(11)
,`tanggal_pembelian` date
,`qty` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_stokout`
-- (See below for the actual view)
--
CREATE TABLE `v_stokout` (
`id_barang` int(11)
,`qty` int(11)
,`tanggal_penjualan` date
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_stokreal`
-- (See below for the actual view)
--
CREATE TABLE `v_stokreal` (
`stok` decimal(33,0)
,`nama_barang` varchar(50)
,`id_barang` int(11)
,`kode_barang` varchar(20)
);

-- --------------------------------------------------------

--
-- Structure for view `v_jurnal`
--
DROP TABLE IF EXISTS `v_jurnal`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_jurnal`  AS SELECT `t`.`tanggal_transaksi` AS `tanggal_transaksi`, `t`.`catatan` AS `catatan`, `a1`.`nama_akun` AS `nama_akun`, `a1`.`tipe_akun` AS `tipe_akun`, `t`.`id_transaksi` AS `id_transaksi`, CASE WHEN `t`.`id_akun_debit` = `a1`.`id_akun` THEN `t`.`total` ELSE 0 END AS `debit`, CASE WHEN `t`.`id_akun_kredit` = `a1`.`id_akun` THEN `t`.`total` ELSE 0 END AS `kredit` FROM (`jurnal` `t` join `akun` `a1` on(`t`.`id_akun_debit` = `a1`.`id_akun` or `t`.`id_akun_kredit` = `a1`.`id_akun`)) ORDER BY `t`.`tanggal_transaksi` ASC ;

-- --------------------------------------------------------

--
-- Structure for view `v_pembelian`
--
DROP TABLE IF EXISTS `v_pembelian`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_pembelian`  AS SELECT `pembelian`.`id_pembelian` AS `id_pembelian`, `pembelian`.`kode_pembelian` AS `kode_pembelian`, `pembelian`.`harga_beli` AS `harga_beli`, `pembelian`.`qty` AS `qty`, `barang`.`nama_barang` AS `nama_barang`, `supplier`.`nama_supplier` AS `nama_supplier`, `jurnal`.`id_akun_debit` AS `id_akun_debit`, `jurnal`.`id_akun_kredit` AS `id_akun_kredit`, `pembelian`.`tanggal_pembelian` AS `tanggal_pembelian`, `pembelian`.`id_barang` AS `id_barang`, `pembelian`.`id_transaksi` AS `id_transaksi` FROM (((`pembelian` join `barang` on(`pembelian`.`id_barang` = `barang`.`id_barang`)) join `supplier` on(`pembelian`.`id_supplier` = `supplier`.`id_supplier`)) join `jurnal` on(`pembelian`.`id_transaksi` = `jurnal`.`id_transaksi`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_penjualan`
--
DROP TABLE IF EXISTS `v_penjualan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_penjualan`  AS SELECT `detail_penjualan`.`kode_penjualan` AS `kode_penjualan`, `barang`.`nama_barang` AS `nama_barang`, `detail_penjualan`.`harga_beli` AS `harga_beli`, `detail_penjualan`.`harga_jual` AS `harga_jual`, `detail_penjualan`.`qty` AS `qty`, `detail_penjualan`.`id_detail_penjualan` AS `id_detail_penjualan`, `detail_penjualan`.`tanggal_penjualan` AS `tanggal_penjualan` FROM (`detail_penjualan` join `barang` on(`detail_penjualan`.`id_barang` = `barang`.`id_barang`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_returnpembelian`
--
DROP TABLE IF EXISTS `v_returnpembelian`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_returnpembelian`  AS SELECT `barang`.`nama_barang` AS `nama_barang`, `return_pembelian`.`id_return_pembelian` AS `id_return_pembelian`, `return_pembelian`.`kode_return_pembelian` AS `kode_return_pembelian`, `return_pembelian`.`catatan` AS `catatan`, `return_pembelian`.`tanggal_return_pembelian` AS `tanggal_return_pembelian`, `return_pembelian`.`id_barang` AS `id_barang`, `return_pembelian`.`jumlah` AS `jumlah` FROM (`return_pembelian` join `barang` on(`return_pembelian`.`id_barang` = `barang`.`id_barang`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_returnpenjualan`
--
DROP TABLE IF EXISTS `v_returnpenjualan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_returnpenjualan`  AS SELECT `barang`.`nama_barang` AS `nama_barang`, `return_penjualan`.`kode_return_penjualan` AS `kode_return_penjualan`, `return_penjualan`.`catatan` AS `catatan`, `return_penjualan`.`id_return_penjualan` AS `id_return_penjualan`, `return_penjualan`.`tanggal_return_penjualan` AS `tanggal_return_penjualan`, `return_penjualan`.`jumlah` AS `jumlah`, `return_penjualan`.`id_barang` AS `id_barang` FROM (`return_penjualan` join `barang` on(`return_penjualan`.`id_barang` = `barang`.`id_barang`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_stokin`
--
DROP TABLE IF EXISTS `v_stokin`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_stokin`  AS SELECT `barang`.`id_barang` AS `id_barang`, `pembelian`.`tanggal_pembelian` AS `tanggal_pembelian`, `pembelian`.`qty` AS `qty` FROM (`barang` join `pembelian` on(`barang`.`id_barang` = `pembelian`.`id_barang`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_stokout`
--
DROP TABLE IF EXISTS `v_stokout`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_stokout`  AS SELECT `barang`.`id_barang` AS `id_barang`, `detail_penjualan`.`qty` AS `qty`, `detail_penjualan`.`tanggal_penjualan` AS `tanggal_penjualan` FROM (`barang` join `detail_penjualan` on(`barang`.`id_barang` = `detail_penjualan`.`id_barang`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_stokreal`
--
DROP TABLE IF EXISTS `v_stokreal`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_stokreal`  AS SELECT sum(`pembelian`.`qty`) - sum(`detail_penjualan`.`qty`) AS `stok`, `barang`.`nama_barang` AS `nama_barang`, `barang`.`id_barang` AS `id_barang`, `barang`.`kode_barang` AS `kode_barang` FROM ((`pembelian` join `detail_penjualan` on(`pembelian`.`id_barang` = `detail_penjualan`.`id_barang`)) join `barang` on(`detail_penjualan`.`id_barang` = `barang`.`id_barang` and `pembelian`.`id_barang` = `barang`.`id_barang`)) WHERE `pembelian`.`id_barang` = `detail_penjualan`.`id_barang` GROUP BY `pembelian`.`id_barang` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id_akun`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD PRIMARY KEY (`id_detail_penjualan`),
  ADD KEY `kode_penjualan` (`kode_penjualan`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `jurnal`
--
ALTER TABLE `jurnal`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_akun_debit` (`id_akun_debit`),
  ADD KEY `id_akun_kredit` (`id_akun_kredit`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_pembelian`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `id_supplier` (`id_supplier`),
  ADD KEY `id_transaksi` (`id_transaksi`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id_penjualan`),
  ADD KEY `kode_penjualan` (`kode_penjualan`),
  ADD KEY `fk_penjualan_pelanggan_1` (`id_pelanggan`),
  ADD KEY `fk_penjualan_pengguna_1` (`id_user`),
  ADD KEY `id_transaksi` (`id_transaksi`);

--
-- Indexes for table `return_pembelian`
--
ALTER TABLE `return_pembelian`
  ADD PRIMARY KEY (`id_return_pembelian`),
  ADD KEY `fk_return_pembelian_barang_1` (`id_barang`);

--
-- Indexes for table `return_penjualan`
--
ALTER TABLE `return_penjualan`
  ADD PRIMARY KEY (`id_return_penjualan`),
  ADD KEY `fk_return_penjualan_barang_1` (`id_barang`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indexes for table `transaksi_inventory`
--
ALTER TABLE `transaksi_inventory`
  ADD PRIMARY KEY (`id_inventory`),
  ADD KEY `id_supplier` (`id_supplier`),
  ADD KEY `id_detail_penjualan` (`id_detail_penjualan`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `id_transaksi` (`id_transaksi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akun`
--
ALTER TABLE `akun`
  MODIFY `id_akun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  MODIFY `id_detail_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `jurnal`
--
ALTER TABLE `jurnal`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `return_pembelian`
--
ALTER TABLE `return_pembelian`
  MODIFY `id_return_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `return_penjualan`
--
ALTER TABLE `return_penjualan`
  MODIFY `id_return_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transaksi_inventory`
--
ALTER TABLE `transaksi_inventory`
  MODIFY `id_inventory` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD CONSTRAINT `detail_penjualan_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jurnal`
--
ALTER TABLE `jurnal`
  ADD CONSTRAINT `jurnal_ibfk_1` FOREIGN KEY (`id_akun_debit`) REFERENCES `akun` (`id_akun`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jurnal_ibfk_2` FOREIGN KEY (`id_akun_kredit`) REFERENCES `akun` (`id_akun`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD CONSTRAINT `pembelian_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pembelian_ibfk_2` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pembelian_ibfk_3` FOREIGN KEY (`id_transaksi`) REFERENCES `jurnal` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `fk_penjualan_pelanggan_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_penjualan_pengguna_1` FOREIGN KEY (`id_user`) REFERENCES `pengguna` (`id_user`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `penjualan_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `jurnal` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `return_pembelian`
--
ALTER TABLE `return_pembelian`
  ADD CONSTRAINT `fk_return_pembelian_barang_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `return_penjualan`
--
ALTER TABLE `return_penjualan`
  ADD CONSTRAINT `fk_return_penjualan_barang_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi_inventory`
--
ALTER TABLE `transaksi_inventory`
  ADD CONSTRAINT `transaksi_inventory_ibfk_1` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`),
  ADD CONSTRAINT `transaksi_inventory_ibfk_2` FOREIGN KEY (`id_detail_penjualan`) REFERENCES `detail_penjualan` (`id_detail_penjualan`),
  ADD CONSTRAINT `transaksi_inventory_ibfk_3` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`),
  ADD CONSTRAINT `transaksi_inventory_ibfk_4` FOREIGN KEY (`id_transaksi`) REFERENCES `jurnal` (`id_transaksi`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
