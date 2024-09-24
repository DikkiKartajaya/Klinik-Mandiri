-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 24, 2024 at 01:54 PM
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
-- Database: `db_skripsi`
--

-- --------------------------------------------------------

--
-- Table structure for table `assesment`
--

CREATE TABLE `assesment` (
  `idAssesment` varchar(15) NOT NULL,
  `idPasien` varchar(25) NOT NULL,
  `tanggalKunjungan` date NOT NULL DEFAULT current_timestamp(),
  `tinggiBadan` int(5) NOT NULL,
  `beratBadan` int(5) NOT NULL,
  `Suhu` int(5) NOT NULL,
  `tekananDarah` varchar(64) NOT NULL,
  `diagnosa` varchar(128) NOT NULL,
  `keterangan` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assesment`
--

INSERT INTO `assesment` (`idAssesment`, `idPasien`, `tanggalKunjungan`, `tinggiBadan`, `beratBadan`, `Suhu`, `tekananDarah`, `diagnosa`, `keterangan`) VALUES
('ASM202409241', 'IDP0004', '2024-09-24', 145, 35, 35, '140/70', 'Sakit Mencret', '');

-- --------------------------------------------------------

--
-- Table structure for table `daftarrawat`
--

CREATE TABLE `daftarrawat` (
  `tanggalKunjungan` date NOT NULL,
  `idDaftarRawat` varchar(25) NOT NULL,
  `idPasien` varchar(25) NOT NULL,
  `idUser` varchar(25) NOT NULL,
  `statusRawat` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `daftarrawat`
--

INSERT INTO `daftarrawat` (`tanggalKunjungan`, `idDaftarRawat`, `idPasien`, `idUser`, `statusRawat`) VALUES
('2024-09-24', 'RWT0001', 'IDP0004', 'SDM0001', 'cared');

-- --------------------------------------------------------

--
-- Table structure for table `detail_obat`
--

CREATE TABLE `detail_obat` (
  `idDo` int(11) NOT NULL,
  `idAssesment` varchar(15) NOT NULL,
  `idObat` varchar(11) NOT NULL,
  `jumlahObat` int(11) NOT NULL,
  `dosisObat` varchar(128) NOT NULL,
  `totalHargaObat` int(25) NOT NULL,
  `keteranganObat` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_obat`
--

INSERT INTO `detail_obat` (`idDo`, `idAssesment`, `idObat`, `jumlahObat`, `dosisObat`, `totalHargaObat`, `keteranganObat`) VALUES
(66, 'ASM202409241', 'FO0003', 3, '3 x 1 hari', 15000, 'Sebelum Makan');

-- --------------------------------------------------------

--
-- Table structure for table `detail_tindakan`
--

CREATE TABLE `detail_tindakan` (
  `idDt` int(11) NOT NULL,
  `idAssesment` varchar(15) NOT NULL,
  `idTindakan` varchar(15) NOT NULL,
  `jumlahTindakan` int(11) NOT NULL,
  `totalHargaTindakan` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_tindakan`
--

INSERT INTO `detail_tindakan` (`idDt`, `idAssesment`, `idTindakan`, `jumlahTindakan`, `totalHargaTindakan`) VALUES
(29, 'ASM202409241', 'TDK0001', 1, 15000);

-- --------------------------------------------------------

--
-- Table structure for table `golongan`
--

CREATE TABLE `golongan` (
  `idGolongan` int(11) NOT NULL,
  `namaGolongan` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `golongan`
--

INSERT INTO `golongan` (`idGolongan`, `namaGolongan`) VALUES
(1, 'Obat Bebas'),
(2, 'Obat Bebas Terbatas'),
(3, 'Obat Keras dan Psikotropika'),
(4, 'Obat Golongan Narkotika');

-- --------------------------------------------------------

--
-- Table structure for table `historyobat`
--

CREATE TABLE `historyobat` (
  `idHistory` varchar(128) NOT NULL,
  `idObat` varchar(11) NOT NULL,
  `tanggalUpdate` date NOT NULL,
  `Stok` int(11) NOT NULL,
  `hargaBeli` int(25) NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `historyobat`
--

INSERT INTO `historyobat` (`idHistory`, `idObat`, `tanggalUpdate`, `Stok`, `hargaBeli`, `foto`) VALUES
('HST0001', 'LF0002', '2024-08-19', 15, 3000, '19082024183751wallpaperflare.com_wallpaper.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `obat`
--

CREATE TABLE `obat` (
  `idObat` varchar(11) NOT NULL,
  `idGolongan` int(11) NOT NULL,
  `namaObat` varchar(50) NOT NULL,
  `jenisObat` varchar(25) NOT NULL,
  `stokObat` int(11) NOT NULL,
  `hargaObat` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `obat`
--

INSERT INTO `obat` (`idObat`, `idGolongan`, `namaObat`, `jenisObat`, `stokObat`, `hargaObat`) VALUES
('FO0003', 1, 'Biolysin ', 'Sirup', 17, 5000),
('LF0001', 2, 'Alpara', '', 10, 16000),
('LF0002', 2, 'Molexflu', '', 13, 9500),
('LF0003', 2, 'Graxine', '', 6, 5000),
('LF0004', 2, 'apa aja', 'Tablet', 20, 5000),
('PO0001', 3, 'Lokev', '', 29, 10000),
('PO0002', 3, 'Molasic', '', 23, 6000),
('PO0003', 3, 'Scopma Plus', '', 37, 35000),
('PO0004', 3, 'Topcilin', '', 17, 5000),
('PO0005', 3, 'Infatrim Forte', '', 21, 7500),
('PO0006', 3, 'FG Troches', '', 33, 21000),
('PO0007', 3, 'Thiamfilex', '', 18, 17500),
('PO0008', 3, 'Histigo', '', 16, 20000),
('PO0009', 3, 'Rhinos', '', 15, 90000);

-- --------------------------------------------------------

--
-- Table structure for table `obatexpired`
--

CREATE TABLE `obatexpired` (
  `idObatExp` varchar(128) NOT NULL,
  `idObat` varchar(11) NOT NULL,
  `tanggalUpdate` date NOT NULL,
  `Stok` int(11) NOT NULL,
  `alasan` varchar(10000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `obatexpired`
--

INSERT INTO `obatexpired` (`idObatExp`, `idObat`, `tanggalUpdate`, `Stok`, `alasan`) VALUES
('EXP0001', 'FO0003', '2024-08-31', 7, 'Sudah Kadaluarsa');

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `idPasien` varchar(25) NOT NULL,
  `namaPasien` varchar(128) NOT NULL,
  `lahirPasien` date NOT NULL,
  `jkPasien` varchar(20) NOT NULL,
  `namaWali` varchar(20) NOT NULL,
  `alamat` varchar(128) NOT NULL,
  `tanggalDaftar` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`idPasien`, `namaPasien`, `lahirPasien`, `jkPasien`, `namaWali`, `alamat`, `tanggalDaftar`) VALUES
('IDP0001', 'Bujal JR', '2005-08-08', 'Laki-Laki', 'Bujal Purnawo', 'Jl. Dipatiukur', '2024-08-31'),
('IDP0003', 'Piglin', '2009-02-04', 'Perempuan', 'Piglin War', 'NetherWorld', '2024-09-24'),
('IDP0004', 'Bujal Purnawo', '2004-03-25', 'Laki-laki', 'Mrs.Bujal Purnawo', 'Dago Pojok 42', '2024-07-25');

-- --------------------------------------------------------

--
-- Table structure for table `resep`
--

CREATE TABLE `resep` (
  `idResep` varchar(15) NOT NULL,
  `idAssesment` varchar(15) NOT NULL,
  `statusResep` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resep`
--

INSERT INTO `resep` (`idResep`, `idAssesment`, `statusResep`) VALUES
('RSP202409241', 'ASM202409241', 'done');

-- --------------------------------------------------------

--
-- Table structure for table `tindakan`
--

CREATE TABLE `tindakan` (
  `idTindakan` varchar(11) NOT NULL,
  `namaTindakan` varchar(50) NOT NULL,
  `biayaTindakan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tindakan`
--

INSERT INTO `tindakan` (`idTindakan`, `namaTindakan`, `biayaTindakan`) VALUES
('TDK0001', 'Konsultasi', 15000),
('TDK0002', 'Suntik KB', 15000),
('TDK0003', 'Suntik Plasma', 90000),
('TDK0004', 'Jahit Luka', 5000),
('TDK0005', 'Infus', 90000);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `idUser` varchar(25) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `namaUser` varchar(128) NOT NULL,
  `level` varchar(11) NOT NULL,
  `jabatan` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`idUser`, `username`, `password`, `namaUser`, `level`, `jabatan`) VALUES
('ADM0001', 'ujang', 'ujang', 'Ujang', '1', 'Administrasi'),
('APT0001', 'apoteker', 'apoteker', 'apoteker', '3', 'Apoteker'),
('DOC0002', 'dokter', 'dokter', 'dokter ujang', '2', 'Dokter'),
('SDM0001', 'admin', 'admin', 'super admin', '6', 'Super Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assesment`
--
ALTER TABLE `assesment`
  ADD PRIMARY KEY (`idAssesment`),
  ADD KEY `idPasien` (`idPasien`);

--
-- Indexes for table `daftarrawat`
--
ALTER TABLE `daftarrawat`
  ADD PRIMARY KEY (`idDaftarRawat`),
  ADD KEY `idUser` (`idUser`),
  ADD KEY `idPasien` (`idPasien`);

--
-- Indexes for table `detail_obat`
--
ALTER TABLE `detail_obat`
  ADD PRIMARY KEY (`idDo`),
  ADD KEY `fk_idRekamMedis` (`idAssesment`),
  ADD KEY `fk_idObat` (`idObat`);

--
-- Indexes for table `detail_tindakan`
--
ALTER TABLE `detail_tindakan`
  ADD PRIMARY KEY (`idDt`),
  ADD KEY `idAssesment` (`idAssesment`),
  ADD KEY `idTindakan` (`idTindakan`);

--
-- Indexes for table `golongan`
--
ALTER TABLE `golongan`
  ADD PRIMARY KEY (`idGolongan`);

--
-- Indexes for table `historyobat`
--
ALTER TABLE `historyobat`
  ADD PRIMARY KEY (`idHistory`),
  ADD KEY `idObat` (`idObat`);

--
-- Indexes for table `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`idObat`),
  ADD KEY `idGolongan` (`idGolongan`);

--
-- Indexes for table `obatexpired`
--
ALTER TABLE `obatexpired`
  ADD PRIMARY KEY (`idObatExp`),
  ADD KEY `idObat` (`idObat`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`idPasien`);

--
-- Indexes for table `resep`
--
ALTER TABLE `resep`
  ADD PRIMARY KEY (`idResep`),
  ADD KEY `idAssesment` (`idAssesment`);

--
-- Indexes for table `tindakan`
--
ALTER TABLE `tindakan`
  ADD PRIMARY KEY (`idTindakan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_obat`
--
ALTER TABLE `detail_obat`
  MODIFY `idDo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `detail_tindakan`
--
ALTER TABLE `detail_tindakan`
  MODIFY `idDt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `golongan`
--
ALTER TABLE `golongan`
  MODIFY `idGolongan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assesment`
--
ALTER TABLE `assesment`
  ADD CONSTRAINT `assesment_ibfk_3` FOREIGN KEY (`idPasien`) REFERENCES `pasien` (`idPasien`);

--
-- Constraints for table `daftarrawat`
--
ALTER TABLE `daftarrawat`
  ADD CONSTRAINT `daftarrawat_ibfk_1` FOREIGN KEY (`idPasien`) REFERENCES `pasien` (`idPasien`),
  ADD CONSTRAINT `daftarrawat_ibfk_2` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`),
  ADD CONSTRAINT `daftarrawat_ibfk_3` FOREIGN KEY (`idPasien`) REFERENCES `pasien` (`idPasien`);

--
-- Constraints for table `detail_obat`
--
ALTER TABLE `detail_obat`
  ADD CONSTRAINT `detail_obat_ibfk_1` FOREIGN KEY (`idAssesment`) REFERENCES `assesment` (`idAssesment`),
  ADD CONSTRAINT `detail_obat_ibfk_2` FOREIGN KEY (`idObat`) REFERENCES `obat` (`idObat`);

--
-- Constraints for table `detail_tindakan`
--
ALTER TABLE `detail_tindakan`
  ADD CONSTRAINT `detail_tindakan_ibfk_1` FOREIGN KEY (`idAssesment`) REFERENCES `assesment` (`idAssesment`),
  ADD CONSTRAINT `detail_tindakan_ibfk_2` FOREIGN KEY (`idTindakan`) REFERENCES `tindakan` (`idTindakan`);

--
-- Constraints for table `historyobat`
--
ALTER TABLE `historyobat`
  ADD CONSTRAINT `historyobat_ibfk_1` FOREIGN KEY (`idObat`) REFERENCES `obat` (`idObat`);

--
-- Constraints for table `obat`
--
ALTER TABLE `obat`
  ADD CONSTRAINT `obat_ibfk_1` FOREIGN KEY (`idGolongan`) REFERENCES `golongan` (`idGolongan`);

--
-- Constraints for table `resep`
--
ALTER TABLE `resep`
  ADD CONSTRAINT `resep_ibfk_1` FOREIGN KEY (`idAssesment`) REFERENCES `assesment` (`idAssesment`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
