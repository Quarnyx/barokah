/*
 Navicat Premium Data Transfer

 Source Server         : local
 Source Server Type    : MySQL
 Source Server Version : 80030 (8.0.30)
 Source Host           : 127.0.0.1:3306
 Source Schema         : barokah

 Target Server Type    : MySQL
 Target Server Version : 80030 (8.0.30)
 File Encoding         : 65001

 Date: 04/10/2024 20:51:58
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for akun
-- ----------------------------
DROP TABLE IF EXISTS `akun`;
CREATE TABLE `akun`  (
  `id_akun` int NOT NULL AUTO_INCREMENT,
  `nama_akun` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `jenis_akun` enum('1','0') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tipe_akun` enum('Aktiva Lancar','Aktiva Tetap','Modal','Utang Lancar','Pendapatan','Beban','Pengeluaran','Kewajiban','Harga Pokok Penjualan') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `kode_akun` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_akun`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of akun
-- ----------------------------
INSERT INTO `akun` VALUES (1, 'Bangunan', '0', 'Aktiva Tetap', '00001');
INSERT INTO `akun` VALUES (2, 'Kas di tangan', '1', 'Aktiva Lancar', '0111');
INSERT INTO `akun` VALUES (4, 'Persediaan', '1', 'Aktiva Lancar', '92313');
INSERT INTO `akun` VALUES (5, 'Pendapatan', '1', 'Pendapatan', '00004');
INSERT INTO `akun` VALUES (6, 'Harga Pokok Penjualan', '1', 'Harga Pokok Penjualan', '012123');
INSERT INTO `akun` VALUES (7, 'Modal', '0', 'Modal', '2313');
INSERT INTO `akun` VALUES (8, 'Utang', '0', 'Utang Lancar', '00023');
INSERT INTO `akun` VALUES (9, 'Gaji Karyawan', '0', 'Beban', '23123');
INSERT INTO `akun` VALUES (10, 'Peralatan', '0', 'Aktiva Tetap', '453533');
INSERT INTO `akun` VALUES (11, 'Utang Dagang', '1', 'Utang Lancar', '800001');

-- ----------------------------
-- Table structure for barang
-- ----------------------------
DROP TABLE IF EXISTS `barang`;
CREATE TABLE `barang`  (
  `id_barang` int NOT NULL AUTO_INCREMENT,
  `nama_barang` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `kode_barang` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `harga_jual` decimal(10, 2) NOT NULL,
  `harga_beli` decimal(10, 2) NULL DEFAULT NULL,
  `satuan` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_barang`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of barang
-- ----------------------------

-- ----------------------------
-- Table structure for detail_pembelian
-- ----------------------------
DROP TABLE IF EXISTS `detail_pembelian`;
CREATE TABLE `detail_pembelian`  (
  `id_detail_pembelian` int NOT NULL AUTO_INCREMENT,
  `id_barang` int NULL DEFAULT NULL,
  `qty` int NULL DEFAULT NULL,
  `harga_beli` decimal(10, 2) NULL DEFAULT NULL,
  `kode_pembelian` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tanggal_pembelian` date NULL DEFAULT NULL,
  `id_pemasok` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_detail_pembelian`) USING BTREE,
  INDEX `kode_pembelian`(`kode_pembelian` ASC) USING BTREE,
  INDEX `id_barang`(`id_barang` ASC) USING BTREE,
  INDEX `id_pemasok`(`id_pemasok` ASC) USING BTREE,
  CONSTRAINT `detail_pembelian_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `detail_pembelian_ibfk_2` FOREIGN KEY (`id_pemasok`) REFERENCES `pemasok` (`id_pemasok`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of detail_pembelian
-- ----------------------------

-- ----------------------------
-- Table structure for detail_penjualan
-- ----------------------------
DROP TABLE IF EXISTS `detail_penjualan`;
CREATE TABLE `detail_penjualan`  (
  `id_detail_penjualan` int NOT NULL AUTO_INCREMENT,
  `id_barang` int NULL DEFAULT NULL,
  `qty` int NULL DEFAULT NULL,
  `harga_beli` decimal(10, 2) NULL DEFAULT NULL,
  `harga_jual` decimal(10, 2) NULL DEFAULT NULL,
  `kode_penjualan` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tanggal_penjualan` date NULL DEFAULT NULL,
  PRIMARY KEY (`id_detail_penjualan`) USING BTREE,
  INDEX `kode_penjualan`(`kode_penjualan` ASC) USING BTREE,
  INDEX `id_barang`(`id_barang` ASC) USING BTREE,
  CONSTRAINT `detail_penjualan_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of detail_penjualan
-- ----------------------------

-- ----------------------------
-- Table structure for jurnal
-- ----------------------------
DROP TABLE IF EXISTS `jurnal`;
CREATE TABLE `jurnal`  (
  `id_transaksi` int NOT NULL AUTO_INCREMENT,
  `tanggal_transaksi` date NOT NULL,
  `total` decimal(15, 2) NOT NULL,
  `catatan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_akun_debit` int NULL DEFAULT NULL,
  `id_akun_kredit` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_transaksi`) USING BTREE,
  INDEX `id_akun_debit`(`id_akun_debit` ASC) USING BTREE,
  INDEX `id_akun_kredit`(`id_akun_kredit` ASC) USING BTREE,
  CONSTRAINT `jurnal_ibfk_1` FOREIGN KEY (`id_akun_debit`) REFERENCES `akun` (`id_akun`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `jurnal_ibfk_2` FOREIGN KEY (`id_akun_kredit`) REFERENCES `akun` (`id_akun`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 67 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of jurnal
-- ----------------------------
INSERT INTO `jurnal` VALUES (39, '2024-03-01', 50000000.00, 'Modal Awal', 2, 7);
INSERT INTO `jurnal` VALUES (40, '2024-05-16', 10000000.00, 'Utang Bank', 2, 8);

-- ----------------------------
-- Table structure for pelanggan
-- ----------------------------
DROP TABLE IF EXISTS `pelanggan`;
CREATE TABLE `pelanggan`  (
  `id_pelanggan` int NOT NULL AUTO_INCREMENT,
  `nama_pelanggan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `alamat_pelanggan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `no_hp` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_pelanggan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pelanggan
-- ----------------------------
INSERT INTO `pelanggan` VALUES (2, 'Yanto', 'Sri Agung Cepiringasda', '08324234232');
INSERT INTO `pelanggan` VALUES (3, 'Umum', '-', '0');

-- ----------------------------
-- Table structure for pemasok
-- ----------------------------
DROP TABLE IF EXISTS `pemasok`;
CREATE TABLE `pemasok`  (
  `id_pemasok` int NOT NULL AUTO_INCREMENT,
  `nama_pemasok` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `alamat_pemasok` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `telp` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_pemasok`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pemasok
-- ----------------------------
INSERT INTO `pemasok` VALUES (4, 'JNE AA', 'Kendal', '2983982');

-- ----------------------------
-- Table structure for pembelian
-- ----------------------------
DROP TABLE IF EXISTS `pembelian`;
CREATE TABLE `pembelian`  (
  `id_pembelian` int NOT NULL AUTO_INCREMENT,
  `kode_pembelian` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_transaksi` int NULL DEFAULT NULL,
  `tanggal_pembelian` date NULL DEFAULT NULL,
  `gambar` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `total` decimal(10, 2) NULL DEFAULT NULL,
  PRIMARY KEY (`id_pembelian`) USING BTREE,
  INDEX `id_transaksi`(`id_transaksi` ASC) USING BTREE,
  CONSTRAINT `pembelian_ibfk_3` FOREIGN KEY (`id_transaksi`) REFERENCES `jurnal` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pembelian
-- ----------------------------

-- ----------------------------
-- Table structure for pengguna
-- ----------------------------
DROP TABLE IF EXISTS `pengguna`;
CREATE TABLE `pengguna`  (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `nama_user` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `level` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_user`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pengguna
-- ----------------------------
INSERT INTO `pengguna` VALUES (1, 'Admin', 'admin', 'admin123', 'Pemilik');
INSERT INTO `pengguna` VALUES (4, 'Nama Karyawanaa', 'karyawan', 'karyawan123', 'Karyawan');

-- ----------------------------
-- Table structure for penjualan
-- ----------------------------
DROP TABLE IF EXISTS `penjualan`;
CREATE TABLE `penjualan`  (
  `id_penjualan` int NOT NULL AUTO_INCREMENT,
  `tanggal_penjualan` date NULL DEFAULT NULL,
  `kode_penjualan` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `total` decimal(10, 2) NULL DEFAULT NULL,
  `id_user` int NULL DEFAULT NULL,
  `id_pelanggan` int NULL DEFAULT NULL,
  `id_transaksi` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_penjualan`) USING BTREE,
  INDEX `kode_penjualan`(`kode_penjualan` ASC) USING BTREE,
  INDEX `fk_penjualan_pelanggan_1`(`id_pelanggan` ASC) USING BTREE,
  INDEX `fk_penjualan_pengguna_1`(`id_user` ASC) USING BTREE,
  INDEX `id_transaksi`(`id_transaksi` ASC) USING BTREE,
  CONSTRAINT `fk_penjualan_pelanggan_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `fk_penjualan_pengguna_1` FOREIGN KEY (`id_user`) REFERENCES `pengguna` (`id_user`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `penjualan_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `jurnal` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of penjualan
-- ----------------------------

-- ----------------------------
-- Table structure for return_pembelian
-- ----------------------------
DROP TABLE IF EXISTS `return_pembelian`;
CREATE TABLE `return_pembelian`  (
  `id_return_pembelian` int NOT NULL AUTO_INCREMENT,
  `kode_return_pembelian` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `catatan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tanggal_return_pembelian` date NULL DEFAULT NULL,
  `jumlah` int NULL DEFAULT NULL,
  `id_barang` int NULL DEFAULT NULL,
  `id_transaksi` int NULL DEFAULT NULL,
  `id_pemasok` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_return_pembelian`) USING BTREE,
  INDEX `fk_return_pembelian_barang_1`(`id_barang` ASC) USING BTREE,
  CONSTRAINT `fk_return_pembelian_barang_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of return_pembelian
-- ----------------------------

-- ----------------------------
-- Table structure for transaksi_inventory
-- ----------------------------
DROP TABLE IF EXISTS `transaksi_inventory`;
CREATE TABLE `transaksi_inventory`  (
  `id_inventory` int NOT NULL AUTO_INCREMENT,
  `id_transaksi` int NULL DEFAULT NULL,
  `id_supplier` int NULL DEFAULT NULL,
  `jenis_transaksi` enum('Masuk','Keluar') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `jumlah` int NULL DEFAULT NULL,
  `tanggal_transaksi` date NULL DEFAULT NULL,
  `harga_beli` decimal(10, 2) NULL DEFAULT NULL,
  `harga_jual` decimal(10, 2) NULL DEFAULT NULL,
  `id_barang` int NULL DEFAULT NULL,
  `id_detail_penjualan` int NULL DEFAULT NULL,
  `gambar` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_inventory`) USING BTREE,
  INDEX `id_supplier`(`id_supplier` ASC) USING BTREE,
  INDEX `id_detail_penjualan`(`id_detail_penjualan` ASC) USING BTREE,
  INDEX `id_barang`(`id_barang` ASC) USING BTREE,
  INDEX `id_transaksi`(`id_transaksi` ASC) USING BTREE,
  CONSTRAINT `transaksi_inventory_ibfk_1` FOREIGN KEY (`id_supplier`) REFERENCES `pemasok` (`id_pemasok`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `transaksi_inventory_ibfk_2` FOREIGN KEY (`id_detail_penjualan`) REFERENCES `detail_penjualan` (`id_detail_penjualan`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `transaksi_inventory_ibfk_3` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `transaksi_inventory_ibfk_4` FOREIGN KEY (`id_transaksi`) REFERENCES `jurnal` (`id_transaksi`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of transaksi_inventory
-- ----------------------------

-- ----------------------------
-- View structure for v_jurnal
-- ----------------------------
DROP VIEW IF EXISTS `v_jurnal`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `v_jurnal` AS select `t`.`tanggal_transaksi` AS `tanggal_transaksi`,`t`.`catatan` AS `catatan`,`a1`.`nama_akun` AS `nama_akun`,`a1`.`tipe_akun` AS `tipe_akun`,`t`.`id_transaksi` AS `id_transaksi`,(case when (`t`.`id_akun_debit` = `a1`.`id_akun`) then `t`.`total` else 0 end) AS `debit`,(case when (`t`.`id_akun_kredit` = `a1`.`id_akun`) then `t`.`total` else 0 end) AS `kredit` from (`jurnal` `t` join `akun` `a1` on(((`t`.`id_akun_debit` = `a1`.`id_akun`) or (`t`.`id_akun_kredit` = `a1`.`id_akun`)))) order by `t`.`tanggal_transaksi`;

-- ----------------------------
-- View structure for v_pembelian
-- ----------------------------
DROP VIEW IF EXISTS `v_pembelian`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `v_pembelian` AS select `barang`.`nama_barang` AS `nama_barang`,`barang`.`satuan` AS `satuan`,`detail_pembelian`.`id_detail_pembelian` AS `id_detail_pembelian`,`detail_pembelian`.`id_barang` AS `id_barang`,`detail_pembelian`.`qty` AS `qty`,`detail_pembelian`.`harga_beli` AS `harga_beli`,`detail_pembelian`.`kode_pembelian` AS `kode_pembelian`,`detail_pembelian`.`tanggal_pembelian` AS `tanggal_pembelian`,`detail_pembelian`.`id_pemasok` AS `id_pemasok` from (`detail_pembelian` join `barang` on((`detail_pembelian`.`id_barang` = `barang`.`id_barang`)));

-- ----------------------------
-- View structure for v_penjualan
-- ----------------------------
DROP VIEW IF EXISTS `v_penjualan`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `v_penjualan` AS select `detail_penjualan`.`kode_penjualan` AS `kode_penjualan`,`barang`.`nama_barang` AS `nama_barang`,`detail_penjualan`.`harga_beli` AS `harga_beli`,`detail_penjualan`.`harga_jual` AS `harga_jual`,`detail_penjualan`.`qty` AS `qty`,`detail_penjualan`.`id_detail_penjualan` AS `id_detail_penjualan`,`detail_penjualan`.`tanggal_penjualan` AS `tanggal_penjualan`,`barang`.`satuan` AS `satuan` from (`detail_penjualan` join `barang` on((`detail_penjualan`.`id_barang` = `barang`.`id_barang`)));

-- ----------------------------
-- View structure for v_returnpembelian
-- ----------------------------
DROP VIEW IF EXISTS `v_returnpembelian`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `v_returnpembelian` AS select `barang`.`nama_barang` AS `nama_barang`,`return_pembelian`.`id_return_pembelian` AS `id_return_pembelian`,`return_pembelian`.`kode_return_pembelian` AS `kode_return_pembelian`,`return_pembelian`.`catatan` AS `catatan`,`return_pembelian`.`tanggal_return_pembelian` AS `tanggal_return_pembelian`,`return_pembelian`.`id_barang` AS `id_barang`,`return_pembelian`.`jumlah` AS `jumlah`,`return_pembelian`.`id_transaksi` AS `id_transaksi`,`return_pembelian`.`id_pemasok` AS `id_pemasok` from (`return_pembelian` join `barang` on((`return_pembelian`.`id_barang` = `barang`.`id_barang`)));

-- ----------------------------
-- View structure for v_returnpenjualan
-- ----------------------------
DROP VIEW IF EXISTS `v_returnpenjualan`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `v_returnpenjualan` AS select `barang`.`nama_barang` AS `nama_barang`,`return_penjualan`.`kode_return_penjualan` AS `kode_return_penjualan`,`return_penjualan`.`catatan` AS `catatan`,`return_penjualan`.`id_return_penjualan` AS `id_return_penjualan`,`return_penjualan`.`tanggal_return_penjualan` AS `tanggal_return_penjualan`,`return_penjualan`.`jumlah` AS `jumlah`,`return_penjualan`.`id_barang` AS `id_barang` from (`return_penjualan` join `barang` on((`return_penjualan`.`id_barang` = `barang`.`id_barang`)));

-- ----------------------------
-- View structure for v_stokin
-- ----------------------------
DROP VIEW IF EXISTS `v_stokin`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `v_stokin` AS select `barang`.`id_barang` AS `id_barang`,`detail_pembelian`.`tanggal_pembelian` AS `tanggal_pembelian`,`detail_pembelian`.`qty` AS `qty` from (`barang` join `detail_pembelian` on((`barang`.`id_barang` = `detail_pembelian`.`id_barang`)));

-- ----------------------------
-- View structure for v_stokout
-- ----------------------------
DROP VIEW IF EXISTS `v_stokout`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `v_stokout` AS select `barang`.`id_barang` AS `id_barang`,`detail_penjualan`.`qty` AS `qty`,`detail_penjualan`.`tanggal_penjualan` AS `tanggal_penjualan` from (`barang` join `detail_penjualan` on((`barang`.`id_barang` = `detail_penjualan`.`id_barang`)));

-- ----------------------------
-- View structure for v_stokreal
-- ----------------------------
DROP VIEW IF EXISTS `v_stokreal`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `v_stokreal` AS select (sum(`detail_pembelian`.`qty`) - sum(`detail_penjualan`.`qty`)) AS `stok`,`barang`.`nama_barang` AS `nama_barang`,`barang`.`id_barang` AS `id_barang`,`barang`.`kode_barang` AS `kode_barang` from ((`detail_pembelian` join `detail_penjualan` on((`detail_pembelian`.`id_barang` = `detail_penjualan`.`id_barang`))) join `barang` on(((`detail_penjualan`.`id_barang` = `barang`.`id_barang`) and (`detail_pembelian`.`id_barang` = `barang`.`id_barang`)))) where (`detail_pembelian`.`id_barang` = `detail_penjualan`.`id_barang`) group by `detail_pembelian`.`id_barang`;

SET FOREIGN_KEY_CHECKS = 1;
