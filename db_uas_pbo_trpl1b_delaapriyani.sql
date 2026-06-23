-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 23, 2026 at 02:54 AM
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
-- Database: `db_uas_pbo_trpl1b_delaapriyani`
--

-- --------------------------------------------------------

--
-- Table structure for table `tabel_karyawan`
--

CREATE TABLE `tabel_karyawan` (
  `id_karyawan` int NOT NULL,
  `nama_karyawan` varchar(100) NOT NULL,
  `departemen` varchar(50) NOT NULL,
  `hari_kerja_masuk` date NOT NULL,
  `gaji_dasar_per_hari` decimal(12,2) NOT NULL,
  `jenis_karyawan` enum('Tetap','Kontrak','Magang') NOT NULL,
  `durasi_kontrak_bulan` int DEFAULT NULL,
  `agensi_penyalur` varchar(100) DEFAULT NULL,
  `tunjangan_kesehatan` decimal(12,2) DEFAULT NULL,
  `opsi_saham_id` varchar(50) DEFAULT NULL,
  `uang_saku_bulanan` decimal(12,2) DEFAULT NULL,
  `sertifikat_kampus_merdeka` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tabel_karyawan`
--

INSERT INTO `tabel_karyawan` (`id_karyawan`, `nama_karyawan`, `departemen`, `hari_kerja_masuk`, `gaji_dasar_per_hari`, `jenis_karyawan`, `durasi_kontrak_bulan`, `agensi_penyalur`, `tunjangan_kesehatan`, `opsi_saham_id`, `uang_saku_bulanan`, `sertifikat_kampus_merdeka`) VALUES
(1, 'Budi Santoso', 'IT', '2023-01-10', '150000.00', 'Tetap', NULL, NULL, '500000.00', 'SAHAM-001', NULL, NULL),
(2, 'Siti Rahayu', 'HRD', '2023-02-15', '120000.00', 'Tetap', NULL, NULL, '400000.00', 'SAHAM-002', NULL, NULL),
(3, 'Agus Wijaya', 'Finance', '2023-03-20', '130000.00', 'Tetap', NULL, NULL, '450000.00', 'SAHAM-003', NULL, NULL),
(4, 'Dewi Lestari', 'Marketing', '2023-04-25', '140000.00', 'Tetap', NULL, NULL, '480000.00', 'SAHAM-004', NULL, NULL),
(5, 'Rudi Hartono', 'IT', '2023-05-30', '160000.00', 'Tetap', NULL, NULL, '550000.00', 'SAHAM-005', NULL, NULL),
(6, 'Maya Sari', 'HRD', '2023-06-05', '125000.00', 'Tetap', NULL, NULL, '420000.00', 'SAHAM-006', NULL, NULL),
(7, 'Andi Pratama', 'IT', '2024-01-10', '140000.00', 'Kontrak', 12, 'PT Sinergi Jaya', NULL, NULL, NULL, NULL),
(8, 'Rina Marlina', 'Marketing', '2024-02-15', '130000.00', 'Kontrak', 6, 'PT Karya Mandiri', NULL, NULL, NULL, NULL),
(9, 'Doni Saputra', 'Finance', '2024-03-20', '125000.00', 'Kontrak', 12, 'PT Bina Usaha', NULL, NULL, NULL, NULL),
(10, 'Lisa Permata', 'HRD', '2024-04-25', '120000.00', 'Kontrak', 6, 'PT Sumber Daya', NULL, NULL, NULL, NULL),
(11, 'Fajar Nugroho', 'IT', '2024-05-30', '145000.00', 'Kontrak', 12, 'PT Solusi Teknologi', NULL, NULL, NULL, NULL),
(12, 'Nina Wulandari', 'Marketing', '2024-06-05', '135000.00', 'Kontrak', 6, 'PT Kreatif Media', NULL, NULL, NULL, NULL),
(13, 'Eko Prasetyo', 'Finance', '2024-07-10', '128000.00', 'Kontrak', 12, 'PT Maju Bersama', NULL, NULL, NULL, NULL),
(14, 'Rizky Ramadhan', 'IT', '2025-01-10', '80000.00', 'Magang', NULL, NULL, NULL, NULL, '1200000.00', 'MSIB-001'),
(15, 'Citra Kirana', 'Marketing', '2025-01-15', '75000.00', 'Magang', NULL, NULL, NULL, NULL, '1100000.00', 'MSIB-002'),
(16, 'Bayu Aji', 'Finance', '2025-02-01', '78000.00', 'Magang', NULL, NULL, NULL, NULL, '1150000.00', 'MSIB-003'),
(17, 'Dinda Amalia', 'HRD', '2025-02-10', '72000.00', 'Magang', NULL, NULL, NULL, NULL, '1050000.00', 'MSIB-004'),
(18, 'Gilang Saputra', 'IT', '2025-03-01', '85000.00', 'Magang', NULL, NULL, NULL, NULL, '1250000.00', 'MSIB-005'),
(19, 'Sari Mulyani', 'Marketing', '2025-03-10', '77000.00', 'Magang', NULL, NULL, NULL, NULL, '1120000.00', 'MSIB-006'),
(20, 'Hendra Setiawan', 'Finance', '2025-04-01', '80000.00', 'Magang', NULL, NULL, NULL, NULL, '1180000.00', 'MSIB-007');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tabel_karyawan`
--
ALTER TABLE `tabel_karyawan`
  ADD PRIMARY KEY (`id_karyawan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tabel_karyawan`
--
ALTER TABLE `tabel_karyawan`
  MODIFY `id_karyawan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
