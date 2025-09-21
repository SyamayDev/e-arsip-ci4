-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 21, 2025 at 12:46 PM
-- Server version: 8.0.30
-- PHP Version: 7.4.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-arsip-ci4`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_arsip`
--

CREATE TABLE `tbl_arsip` (
  `id_arsip` int NOT NULL,
  `id_kategori` int DEFAULT NULL,
  `no_arsip` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `nama_arsip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `deskripsi` text,
  `tgl_upload` date DEFAULT NULL,
  `tgl_update` date DEFAULT NULL,
  `file_arsip` varchar(255) DEFAULT NULL,
  `ukuran_file` int DEFAULT NULL,
  `id_dep` int DEFAULT NULL,
  `id_user` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_arsip`
--

INSERT INTO `tbl_arsip` (`id_arsip`, `id_kategori`, `no_arsip`, `nama_arsip`, `deskripsi`, `tgl_upload`, `tgl_update`, `file_arsip`, `ukuran_file`, `id_dep`, `id_user`) VALUES
(1, 1, '25092135-XyA7', 'Surat Masuk Dinas Pendidikan', 'Surat resmi dari Dinas Pendidikan mengenai jadwal rapat koordinasi.', '2025-09-21', '2025-09-21', 'surat_masuk_dinas_pendidikan.pdf', 245632, 1, 1),
(2, 3, '25092142-BkP9', 'Laporan Bulanan Keuangan', 'Laporan keuangan bulan September 2025 dari Departemen Keuangan.', '2025-09-21', '2025-09-21', 'laporan_bulanan_keuangan.pdf', 365874, 2, 2),
(3, 4, '25092158-MnQ3', 'Surat Keputusan Direktur', 'Surat keputusan pengangkatan ketua tim baru di Departemen Pemasaran.', '2025-09-21', '2025-09-21', 'sk_pengangkatan_ketua_tim.pdf', 198753, 3, 1),
(4, 2, '21062101-AbC1', 'Surat Keluar Permintaan Barang', 'Surat permintaan pengadaan barang ke vendor resmi.', '2025-06-21', '2025-06-21', 'surat_keluar_permintaan_barang.pdf', 152340, 1, 1),
(5, 5, '21062102-XyZ7', 'Surat Permohonan Cuti', 'Permohonan cuti tahunan oleh staf Departemen IT.', '2025-06-25', '2025-06-25', 'surat_permohonan_cuti.pdf', 93421, 1, 1),
(6, 3, '15072101-PqR5', 'Laporan Bulanan Pemasaran', 'Laporan hasil penjualan dan promosi bulan Juli 2025.', '2025-07-15', '2025-07-15', 'laporan_bulanan_pemasaran.pdf', 285743, 3, 2),
(7, 1, '15072102-LmN9', 'Surat Masuk Bank Mandiri', 'Surat konfirmasi terkait kerjasama keuangan.', '2025-07-20', '2025-07-20', 'surat_masuk_bank_mandiri.pdf', 187453, 2, 2),
(8, 4, '10082101-JkL2', 'Surat Keputusan Direksi', 'Surat keputusan mengenai proyek baru di Departemen SDM.', '2025-08-10', '2025-08-10', 'surat_keputusan_proyek_baru.pdf', 225630, 4, 1),
(9, 2, '10082102-UvW8', 'Surat Keluar Undangan Rapat', 'Undangan rapat koordinasi antar departemen.', '2025-08-18', '2025-08-18', 'surat_keluar_undangan_rapat.pdf', 134876, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dep`
--

CREATE TABLE `tbl_dep` (
  `id_dep` int NOT NULL,
  `nama_dep` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_dep`
--

INSERT INTO `tbl_dep` (`id_dep`, `nama_dep`) VALUES
(1, 'Departemen IT'),
(2, 'Departemen Keuangan'),
(3, 'Departemen Pemasaran'),
(4, 'Departemen SDM');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kategori`
--

CREATE TABLE `tbl_kategori` (
  `id_kategori` int NOT NULL,
  `nama_kategori` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_kategori`
--

INSERT INTO `tbl_kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Surat Masuk'),
(2, 'Surat Keluar'),
(3, 'Surat Laporan'),
(4, 'Surat Keputusan'),
(5, 'Surat Permohonan');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int NOT NULL,
  `nama_user` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `level` int DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `id_dep` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `nama_user`, `email`, `password`, `level`, `foto`, `id_dep`) VALUES
(1, 'Syahril Maimubdy', 'syahrilmaymubdi2505@gmail.com', 'syahriltamfan25', 1, 'syahriltamfan.jpg', 1),
(2, 'Nasyifa Syakila Ikhsan', 'nasyifa123@gmail.com', '12345', 2, '1758455771_abeef0c9b287ba65f069.jpg', 2),
(6, 'Kindi Mualana Nugraha', 'kindi123@gmail.com', '12345', 2, '1758458592_fa127f018cff5ee4e328.jpg', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_arsip`
--
ALTER TABLE `tbl_arsip`
  ADD PRIMARY KEY (`id_arsip`);

--
-- Indexes for table `tbl_dep`
--
ALTER TABLE `tbl_dep`
  ADD PRIMARY KEY (`id_dep`);

--
-- Indexes for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_arsip`
--
ALTER TABLE `tbl_arsip`
  MODIFY `id_arsip` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_dep`
--
ALTER TABLE `tbl_dep`
  MODIFY `id_dep` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  MODIFY `id_kategori` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
