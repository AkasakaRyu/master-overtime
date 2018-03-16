-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Feb 2018 pada 19.22
-- Versi server: 10.1.25-MariaDB
-- Versi PHP: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `industri_overtime`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `ak_barang`
--

CREATE TABLE `ak_barang` (
  `Id_barang` int(9) NOT NULL,
  `Tanggal_barang` date DEFAULT NULL,
  `Kode_barang` char(50) DEFAULT NULL,
  `Penjual` char(45) DEFAULT NULL,
  `Nama_barang` char(50) NOT NULL,
  `Jenis_barang` enum('Bahan Jadi','Bahan Baku') NOT NULL,
  `Jumlah_barang` int(15) NOT NULL DEFAULT '0',
  `Output` int(15) NOT NULL DEFAULT '0',
  `Permintaan_Max` int(15) NOT NULL DEFAULT '0',
  `Permintaan_Min` int(15) NOT NULL DEFAULT '0',
  `Persediaan_Max` int(15) NOT NULL DEFAULT '0',
  `Persediaan_Min` int(15) NOT NULL DEFAULT '0',
  `Output_Max` int(15) NOT NULL DEFAULT '0',
  `Output_Min` int(15) NOT NULL DEFAULT '0',
  `Overtime_Max` int(15) NOT NULL DEFAULT '0',
  `Overtime_Min` int(15) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ak_barang`
--

INSERT INTO `ak_barang` (`Id_barang`, `Tanggal_barang`, `Kode_barang`, `Penjual`, `Nama_barang`, `Jenis_barang`, `Jumlah_barang`, `Output`, `Permintaan_Max`, `Permintaan_Min`, `Persediaan_Max`, `Persediaan_Min`, `Output_Max`, `Output_Min`, `Overtime_Max`, `Overtime_Min`) VALUES
(1, NULL, 'K1', NULL, 'Kapas Katun', 'Bahan Jadi', 0, 2600, 7000, 2000, 5800, 500, 3800, 1200, 4, 2),
(2, NULL, 'K2', NULL, 'Kapas Katun B', 'Bahan Jadi', 0, 2000, 7000, 1000, 8400, 500, 2200, 1800, 4, 2),
(3, '2018-02-05', NULL, 'H. Hadi', 'Weast Spinning', 'Bahan Baku', 3269, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ak_data_customer`
--

CREATE TABLE `ak_data_customer` (
  `Id_d_cust` int(9) NOT NULL,
  `Nama_cust` char(45) NOT NULL,
  `Alamat` text NOT NULL,
  `Tlp` char(20) NOT NULL,
  `Status` enum('Member','Non Member') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ak_data_customer`
--

INSERT INTO `ak_data_customer` (`Id_d_cust`, `Nama_cust`, `Alamat`, `Tlp`, `Status`) VALUES
(1, 'Pak Pujo', 'Surabaya', '-', 'Member'),
(2, 'Bob', 'Bekasi', '-', 'Member'),
(3, 'Ina', 'Solo', '-', 'Non Member');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ak_data_output`
--

CREATE TABLE `ak_data_output` (
  `Id_d_output` int(9) NOT NULL,
  `Id_d_permintaan` int(9) NOT NULL,
  `Output` int(15) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ak_data_output`
--

INSERT INTO `ak_data_output` (`Id_d_output`, `Id_d_permintaan`, `Output`) VALUES
(1, 1, 2000),
(2, 2, 2000),
(3, 3, 2000),
(4, 4, 2000),
(5, 5, 2000),
(6, 6, 2000),
(7, 7, 2000),
(8, 8, 2000),
(9, 9, 2000),
(10, 10, 1800),
(11, 11, 2000),
(12, 12, 2000),
(13, 13, 2000),
(14, 14, 2000),
(15, 15, 2000),
(16, 16, 2000),
(17, 17, 2000),
(18, 18, 2700),
(19, 19, 2000),
(20, 20, 2000),
(21, 21, 2000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ak_data_overtime`
--

CREATE TABLE `ak_data_overtime` (
  `Id_d_lembur` int(9) NOT NULL,
  `id_d_permintaan` int(9) NOT NULL,
  `Jumlah_jam` decimal(8,2) NOT NULL DEFAULT '0.00',
  `O_Hasil` int(15) NOT NULL DEFAULT '0',
  `Status` enum('Tidak Overtime','Overtime','Pending') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ak_data_overtime`
--

INSERT INTO `ak_data_overtime` (`Id_d_lembur`, `id_d_permintaan`, `Jumlah_jam`, `O_Hasil`, `Status`) VALUES
(13, 21, '2.50', 0, 'Overtime'),
(14, 20, '2.40', 0, 'Overtime'),
(15, 19, '0.00', 0, 'Tidak Overtime'),
(16, 18, '0.00', 0, 'Tidak Overtime'),
(17, 17, '0.00', 0, 'Tidak Overtime'),
(18, 16, '2.90', 0, 'Overtime'),
(19, 15, '2.60', 0, 'Overtime'),
(20, 14, '2.20', 0, 'Overtime'),
(21, 13, '2.40', 0, 'Overtime'),
(22, 12, '2.70', 0, 'Overtime'),
(23, 11, '2.40', 0, 'Overtime'),
(24, 10, '2.50', 0, 'Overtime'),
(25, 9, '2.40', 0, 'Overtime'),
(26, 8, '2.40', 0, 'Overtime'),
(27, 7, '0.00', 0, 'Tidak Overtime'),
(28, 6, '0.00', 0, 'Tidak Overtime'),
(29, 5, '2.90', 0, 'Overtime'),
(30, 4, '0.00', 0, 'Tidak Overtime'),
(31, 3, '2.80', 0, 'Overtime'),
(32, 2, '2.20', 0, 'Overtime'),
(33, 1, '0.00', 0, 'Tidak Overtime');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ak_data_permintaan`
--

CREATE TABLE `ak_data_permintaan` (
  `Id_d_permintaan` int(9) NOT NULL,
  `Tanggal` varchar(50) NOT NULL,
  `Nama` char(50) NOT NULL,
  `Id_barang` int(9) NOT NULL,
  `Jumlah` int(15) NOT NULL,
  `Petugas` int(9) NOT NULL,
  `Status` tinyint(1) NOT NULL DEFAULT '0',
  `procesed` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ak_data_permintaan`
--

INSERT INTO `ak_data_permintaan` (`Id_d_permintaan`, `Tanggal`, `Nama`, `Id_barang`, `Jumlah`, `Petugas`, `Status`, `procesed`) VALUES
(1, '01/12/2017', 'Pak Pujo', 2, 0, 9, 0, 1),
(2, '04/12/2017', 'Pak Pujo', 2, 1800, 9, 0, 1),
(3, '05/12/2017', 'Pak Pujo', 2, 3200, 9, 0, 1),
(4, '06/12/2017', 'Pak Pujo', 2, 1000, 9, 0, 1),
(5, '07/12/2017', 'Pak Pujo', 2, 7000, 9, 0, 1),
(6, '08/12/2017', 'Pak Pujo', 2, 0, 9, 0, 1),
(7, '11/12/2017', 'Pak Pujo', 2, 0, 9, 0, 1),
(8, '12/12/2017', 'Pak Pujo', 2, 2000, 9, 0, 1),
(9, '13/12/2017', 'Pak Pujo', 2, 2200, 9, 0, 1),
(10, '14/12/2017', 'Pak Pujo', 2, 3000, 9, 0, 1),
(11, '15/12/2017', 'Pak Pujo', 2, 2000, 9, 0, 1),
(12, '18/12/2017', 'Pak Pujo', 2, 3100, 9, 0, 1),
(13, '19/12/2017', 'Pak Pujo', 2, 2000, 9, 0, 1),
(14, '20/12/2017', 'Pak Pujo', 2, 1500, 9, 0, 1),
(15, '21/12/2017', 'Pak Pujo', 2, 3000, 9, 0, 1),
(16, '22/12/2017', 'Pak Pujo', 2, 6000, 9, 0, 1),
(17, '25/12/2017', 'Pak Pujo', 2, 0, 9, 0, 1),
(18, '26/12/2017', 'Pak Pujo', 2, 6000, 9, 0, 1),
(19, '27/12/2017', 'Pak Pujo', 2, 0, 9, 0, 1),
(20, '28/12/2017', 'Pak Pujo', 2, 2000, 9, 0, 1),
(21, '29/12/2017', 'Pak Pujo', 2, 2600, 9, 0, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ak_data_persediaan`
--

CREATE TABLE `ak_data_persediaan` (
  `Id_d_persediaan` int(9) NOT NULL,
  `id_d_permintaan` int(15) NOT NULL DEFAULT '0',
  `Persediaan` int(15) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ak_data_persediaan`
--

INSERT INTO `ak_data_persediaan` (`Id_d_persediaan`, `id_d_permintaan`, `Persediaan`) VALUES
(1, 1, 2800),
(2, 2, 4800),
(3, 3, 3000),
(4, 4, 2200),
(5, 5, 3200),
(6, 6, 6400),
(7, 7, 8400),
(8, 8, 1400),
(9, 9, 1400),
(10, 10, 2000),
(11, 11, 1600),
(12, 12, 1600),
(13, 13, 500),
(14, 14, 1300),
(15, 15, 2600),
(16, 16, 1600),
(17, 17, 4800),
(18, 18, 6800),
(19, 19, 4000),
(20, 20, 1200),
(21, 21, 1200);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ak_data_produksi`
--

CREATE TABLE `ak_data_produksi` (
  `Id_d_produksi` int(9) NOT NULL,
  `id_barang` int(9) NOT NULL,
  `Tanggal_produksi` date NOT NULL,
  `Jumlah_produksi` int(15) NOT NULL DEFAULT '0',
  `Jumlah_overtime` int(15) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ak_data_produksi`
--

INSERT INTO `ak_data_produksi` (`Id_d_produksi`, `id_barang`, `Tanggal_produksi`, `Jumlah_produksi`, `Jumlah_overtime`) VALUES
(3, 1, '2018-02-05', 1000, 2000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ak_data_supplier`
--

CREATE TABLE `ak_data_supplier` (
  `Id_d_supplier` int(9) NOT NULL,
  `Nama_supplier` char(45) NOT NULL,
  `Alamat` text NOT NULL,
  `Tlp` char(20) NOT NULL,
  `Status` enum('Member','Non Member') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ak_data_supplier`
--

INSERT INTO `ak_data_supplier` (`Id_d_supplier`, `Nama_supplier`, `Alamat`, `Tlp`, `Status`) VALUES
(1, 'H. Dedi', 'Majalaya', '-', 'Member'),
(2, 'H. Hadi', 'Bandung', '-', 'Non Member'),
(3, 'H. Hendi', 'Jatinangor', '-', 'Member'),
(4, 'H. Ina', 'Bekasi', '-', 'Non Member'),
(5, 'H. Enting', 'Bogor', '-', 'Member'),
(6, 'Agus', 'Karawang', '-', 'Member');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ak_log`
--

CREATE TABLE `ak_log` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ak_log`
--

INSERT INTO `ak_log` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('4go8o5blrljrp1t3g03nj6cohcdu6l8j', '::1', 1517850557, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531373835303535333b6b6f64657c733a323a223131223b6e616d617c733a31343a2241646d696e2050726f64756b7369223b757365727c733a363a2261646d70726f223b6c6576656c7c733a31343a2241646d696e2050726f64756b7369223b637265617465647c733a31393a22323031382d30312d32362030343a35383a3135223b69734c6f67696e7c623a313b),
('7iic16gbj2uvpl7lc52j7i5g7c8lpg81', '::1', 1519150929, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531393135303932393b),
('f2cc08ionefrk79p3q5v28k0ktd9qn69', '::1', 1517856527, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531373835363530353b6b6f64657c733a313a2239223b6e616d617c733a31323a2241646d696e20477564616e67223b757365727c733a363a2261646d677564223b6c6576656c7c733a31323a2241646d696e20477564616e67223b637265617465647c733a31393a22323031382d30312d32362030343a34353a3234223b69734c6f67696e7c623a313b),
('h2biptnbm657nkhl7q32vghi14gt40t3', '::1', 1519103304, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531393130333330343b6b6f64657c733a313a2239223b6e616d617c733a31323a2241646d696e20477564616e67223b757365727c733a363a2261646d677564223b6c6576656c7c733a31323a2241646d696e20477564616e67223b637265617465647c733a31393a22323031382d30312d32362030343a34353a3234223b69734c6f67696e7c623a313b),
('ife4jdh4ulfnfsuak6ij24bgun9934n0', '::1', 1517783320, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531373738333138393b6b6f64657c733a313a2239223b6e616d617c733a31323a2241646d696e20477564616e67223b757365727c733a363a2261646d677564223b6c6576656c7c733a31323a2241646d696e20477564616e67223b637265617465647c733a31393a22323031382d30312d32362030343a34353a3234223b69734c6f67696e7c623a313b),
('vlcu0fat0ivva38n6ni2qidoes0tm4de', '::1', 1519111396, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531393131313131323b6b6f64657c733a323a223131223b6e616d617c733a31343a2241646d696e2050726f64756b7369223b757365727c733a363a2261646d70726f223b6c6576656c7c733a31343a2241646d696e2050726f64756b7369223b637265617465647c733a31393a22323031382d30312d32362030343a35383a3135223b69734c6f67696e7c623a313b);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ak_user`
--

CREATE TABLE `ak_user` (
  `Id_user` int(9) NOT NULL,
  `Nama_karyawan` char(50) NOT NULL,
  `Username` char(50) NOT NULL,
  `Password` varchar(60) NOT NULL,
  `Bagian` enum('System Administrator','Admin Produksi','Kepala Produksi','Admin Gudang','Quality Control','Operator') NOT NULL,
  `Created_Date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ak_user`
--

INSERT INTO `ak_user` (`Id_user`, `Nama_karyawan`, `Username`, `Password`, `Bagian`, `Created_Date`) VALUES
(1, 'System Administrator', 'admin', '$2y$10$tOHAdufarFQw4YOdJNr5N.8AwQ3rx1habqFBMK8C6T82LIG.GfpY6', 'System Administrator', '2018-01-26 02:37:14'),
(9, 'Admin Gudang', 'admgud', '$2y$10$d01EZb052voofDDdG/havuO4i.j0jvtcwZeqVkHBHteUvv8c1BCFu', 'Admin Gudang', '2018-01-26 04:45:24'),
(11, 'Admin Produksi', 'admpro', '$2y$10$.765c4L/XYc6vDi4A2qFfuebnBWBTrT0HzMddM/ta30fIn2wmscb2', 'Admin Produksi', '2018-01-26 04:58:15');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `ak_barang`
--
ALTER TABLE `ak_barang`
  ADD PRIMARY KEY (`Id_barang`);

--
-- Indeks untuk tabel `ak_data_customer`
--
ALTER TABLE `ak_data_customer`
  ADD PRIMARY KEY (`Id_d_cust`);

--
-- Indeks untuk tabel `ak_data_output`
--
ALTER TABLE `ak_data_output`
  ADD PRIMARY KEY (`Id_d_output`),
  ADD KEY `fk_output_Permintaan` (`Id_d_permintaan`);

--
-- Indeks untuk tabel `ak_data_overtime`
--
ALTER TABLE `ak_data_overtime`
  ADD PRIMARY KEY (`Id_d_lembur`),
  ADD KEY `fk_overtime_id_d_permintaan` (`id_d_permintaan`);

--
-- Indeks untuk tabel `ak_data_permintaan`
--
ALTER TABLE `ak_data_permintaan`
  ADD PRIMARY KEY (`Id_d_permintaan`),
  ADD KEY `fk_permintaan_id_barang` (`Id_barang`),
  ADD KEY `fk_permintaan_petugas` (`Petugas`);

--
-- Indeks untuk tabel `ak_data_persediaan`
--
ALTER TABLE `ak_data_persediaan`
  ADD PRIMARY KEY (`Id_d_persediaan`),
  ADD KEY `fk_persediaan_permintaan` (`id_d_permintaan`);

--
-- Indeks untuk tabel `ak_data_produksi`
--
ALTER TABLE `ak_data_produksi`
  ADD PRIMARY KEY (`Id_d_produksi`),
  ADD KEY `fk_produksi_barang` (`id_barang`);

--
-- Indeks untuk tabel `ak_data_supplier`
--
ALTER TABLE `ak_data_supplier`
  ADD PRIMARY KEY (`Id_d_supplier`);

--
-- Indeks untuk tabel `ak_log`
--
ALTER TABLE `ak_log`
  ADD PRIMARY KEY (`id`,`ip_address`),
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indeks untuk tabel `ak_user`
--
ALTER TABLE `ak_user`
  ADD PRIMARY KEY (`Id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `ak_barang`
--
ALTER TABLE `ak_barang`
  MODIFY `Id_barang` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `ak_data_customer`
--
ALTER TABLE `ak_data_customer`
  MODIFY `Id_d_cust` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `ak_data_output`
--
ALTER TABLE `ak_data_output`
  MODIFY `Id_d_output` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT untuk tabel `ak_data_overtime`
--
ALTER TABLE `ak_data_overtime`
  MODIFY `Id_d_lembur` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT untuk tabel `ak_data_permintaan`
--
ALTER TABLE `ak_data_permintaan`
  MODIFY `Id_d_permintaan` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT untuk tabel `ak_data_persediaan`
--
ALTER TABLE `ak_data_persediaan`
  MODIFY `Id_d_persediaan` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT untuk tabel `ak_data_produksi`
--
ALTER TABLE `ak_data_produksi`
  MODIFY `Id_d_produksi` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `ak_data_supplier`
--
ALTER TABLE `ak_data_supplier`
  MODIFY `Id_d_supplier` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `ak_user`
--
ALTER TABLE `ak_user`
  MODIFY `Id_user` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `ak_data_output`
--
ALTER TABLE `ak_data_output`
  ADD CONSTRAINT `fk_output_Permintaan` FOREIGN KEY (`Id_d_permintaan`) REFERENCES `ak_data_permintaan` (`Id_d_permintaan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `ak_data_overtime`
--
ALTER TABLE `ak_data_overtime`
  ADD CONSTRAINT `fk_overtime_id_d_permintaan` FOREIGN KEY (`id_d_permintaan`) REFERENCES `ak_data_permintaan` (`Id_d_permintaan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `ak_data_permintaan`
--
ALTER TABLE `ak_data_permintaan`
  ADD CONSTRAINT `fk_permintaan_id_barang` FOREIGN KEY (`Id_barang`) REFERENCES `ak_barang` (`Id_barang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_permintaan_petugas` FOREIGN KEY (`Petugas`) REFERENCES `ak_user` (`Id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `ak_data_persediaan`
--
ALTER TABLE `ak_data_persediaan`
  ADD CONSTRAINT `fk_persediaan_permintaan` FOREIGN KEY (`id_d_permintaan`) REFERENCES `ak_data_permintaan` (`Id_d_permintaan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `ak_data_produksi`
--
ALTER TABLE `ak_data_produksi`
  ADD CONSTRAINT `fk_produksi_barang` FOREIGN KEY (`id_barang`) REFERENCES `ak_barang` (`Id_barang`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
