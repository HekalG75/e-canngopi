-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Feb 2024 pada 19.07
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absen_lokasi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absen`
--

CREATE TABLE `absen` (
  `id_absen` int(11) NOT NULL,
  `nim` varchar(50) NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `keterangan` varchar(100) NOT NULL,
  `catatan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cuti`
--

CREATE TABLE `cuti` (
  `id_cuti` int(11) NOT NULL,
  `nim` varchar(50) NOT NULL,
  `jenis_cuti` enum('cuti','izin','sakit') NOT NULL,
  `bukti` varchar(254) DEFAULT NULL,
  `alasan` text NOT NULL,
  `status` enum('diajukan','diterima','ditolak') NOT NULL,
  `waktu_pengajuan` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `cuti`
--

INSERT INTO `cuti` (`id_cuti`, `nim`, `jenis_cuti`, `bukti`, `alasan`, `status`, `waktu_pengajuan`) VALUES
(31, '2110102019', 'izin', NULL, 'fasfa', 'diterima', '2024-02-18 06:12:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `departemen`
--

CREATE TABLE `departemen` (
  `departemen_id` int(11) NOT NULL,
  `departemen` varchar(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `departemen`
--

INSERT INTO `departemen` (`departemen_id`, `departemen`) VALUES
(1, 'Keuangan'),
(2, 'Administrasi'),
(7, 'kicken');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detailcuti`
--

CREATE TABLE `detailcuti` (
  `id_detail` int(11) NOT NULL,
  `id_cuti` int(11) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `detailcuti`
--

INSERT INTO `detailcuti` (`id_detail`, `id_cuti`, `tanggal`) VALUES
(20, 17, '2024-02-03'),
(21, 18, '2024-02-03'),
(22, 19, '2024-02-03'),
(23, 20, '2024-02-03'),
(24, 21, '2024-02-05'),
(25, 22, '2024-02-05'),
(26, 23, '2024-02-06'),
(27, 24, '2024-02-09'),
(28, 25, '2024-02-10'),
(29, 26, '2024-02-10'),
(30, 27, '2024-02-10'),
(31, 28, '2024-02-14'),
(32, 29, '2024-02-18'),
(33, 30, '2024-02-18'),
(34, 31, '2024-02-18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `nim` varchar(50) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `waktu_masuk` date NOT NULL,
  `id_departemen` int(11) NOT NULL,
  `level` enum('admin','pegawai','pegawaioutside') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`nim`, `jenis_kelamin`, `waktu_masuk`, `id_departemen`, `level`) VALUES
('1', 'L', '2024-02-10', 2, 'pegawaioutside'),
('10', 'L', '2024-02-11', 6, 'pegawaioutside'),
('11', 'L', '2024-02-11', 7, 'pegawaioutside'),
('123123321', 'L', '2024-02-14', 2, 'pegawaioutside'),
('2', 'P', '2024-02-10', 2, 'pegawaioutside'),
('2110102018', 'L', '2024-02-03', 2, 'pegawai'),
('2110102019', 'P', '2024-02-03', 2, 'pegawaioutside'),
('2233', 'L', '2024-02-11', 7, 'pegawaioutside'),
('26', 'L', '2024-02-11', 2, 'pegawaioutside'),
('3', 'L', '2024-02-10', 1, 'pegawaioutside'),
('4', 'P', '2024-02-10', 2, 'pegawaioutside'),
('5', 'L', '2024-02-11', 2, 'pegawaioutside'),
('6', 'L', '2024-02-11', 2, 'pegawaioutside'),
('7', 'L', '2024-02-11', 2, 'pegawaioutside'),
('8', 'L', '2024-02-22', 6, 'pegawaioutside'),
('9', 'P', '2024-02-11', 2, 'pegawaioutside');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `nama` varchar(254) NOT NULL,
  `email` varchar(254) NOT NULL,
  `password` varchar(254) NOT NULL,
  `level` enum('admin','pegawai','pegawaioutside') NOT NULL,
  `nim` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`user_id`, `nama`, `email`, `password`, `level`, `nim`) VALUES
(1, 'Administrator', 'admin@admin.com', '202cb962ac59075b964b07152d234b70', 'admin', NULL),
(37, 'useronsite', 'useron@gmail.com', '6ad14ba9986e3615423dfca256d04e3f', 'pegawai', '2110102018'),
(39, 'useroutside', 'userout@gmail.com', '6ad14ba9986e3615423dfca256d04e3f', 'pegawaioutside', '2110102019'),
(52, 'haikal', 'haikal@gmail.com', '539760b3222370b2754cbac577b2fc31', 'admin', ''),
(53, 'anjay', 'anjay@gmail.com', 'de12f5798f86bdcc5c759a645e913e4c', 'pegawaioutside', '2233'),
(54, 'hekal', 'hekal@gmail.com', '539760b3222370b2754cbac577b2fc31', 'pegawaioutside', '123123321');

-- --------------------------------------------------------

--
-- Struktur dari tabel `web`
--

CREATE TABLE `web` (
  `id_web` int(11) NOT NULL,
  `logo` varchar(254) NOT NULL,
  `nama` varchar(254) NOT NULL,
  `author` varchar(254) NOT NULL,
  `alamat` text NOT NULL,
  `nohp` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `web`
--

INSERT INTO `web` (`id_web`, `logo`, `nama`, `author`, `alamat`, `nohp`, `email`) VALUES
(1, 'canngopilogo.png', 'E - CanNgopi', 'Muhammad Haikal', 'Kelapa dua no 2 tangerang banten', '089503725636', 'Haikal@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absen`
--
ALTER TABLE `absen`
  ADD PRIMARY KEY (`id_absen`);

--
-- Indeks untuk tabel `cuti`
--
ALTER TABLE `cuti`
  ADD PRIMARY KEY (`id_cuti`);

--
-- Indeks untuk tabel `departemen`
--
ALTER TABLE `departemen`
  ADD PRIMARY KEY (`departemen_id`);

--
-- Indeks untuk tabel `detailcuti`
--
ALTER TABLE `detailcuti`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indeks untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`nim`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indeks untuk tabel `web`
--
ALTER TABLE `web`
  ADD PRIMARY KEY (`id_web`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `absen`
--
ALTER TABLE `absen`
  MODIFY `id_absen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=184;

--
-- AUTO_INCREMENT untuk tabel `cuti`
--
ALTER TABLE `cuti`
  MODIFY `id_cuti` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `departemen`
--
ALTER TABLE `departemen`
  MODIFY `departemen_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `detailcuti`
--
ALTER TABLE `detailcuti`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT untuk tabel `web`
--
ALTER TABLE `web`
  MODIFY `id_web` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
