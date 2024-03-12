-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Mar 2024 pada 07.36
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
-- Database: `absen_canngopi`
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
  `kegiatanhariini` text NOT NULL,
  `kendala` text NOT NULL,
  `mengatasi` text NOT NULL,
  `kegiatanberikut` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `absen`
--

INSERT INTO `absen` (`id_absen`, `nim`, `waktu`, `keterangan`, `kegiatanhariini`, `kendala`, `mengatasi`, `kegiatanberikut`) VALUES
(51, '2119238212', '2024-03-08 15:40:54', 'masuk', 'asd', '', '', ''),
(52, '2119238212', '2024-03-08 15:41:08', 'pulang', 'asd', 'asd', 'asd', 'asd'),
(53, '2119238212', '2024-03-09 05:16:55', 'masuk', 'hari ini menjadi kitchen', '', '', ''),
(54, '2119238212', '2024-03-09 05:17:19', 'pulang', 'menjadi kitchen', 'beras abis', 'beli', 'jadi waiters'),
(55, '5213', '2024-03-09 10:22:55', 'masuk', 'hari ini mengerjakan  sistem absensi', '', '', ''),
(56, '5213', '2024-03-09 10:23:36', 'pulang', 'asd', 'aasd', 'asd', 'asd');

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
(3, '2119238212', 'izin', NULL, 'ada urusan keluarga', 'diajukan', '2024-03-10 06:35:59');

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
(1, 'Administrasi'),
(6, 'kitchen');

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
(34, 31, '2024-02-18'),
(35, 1, '2024-02-22'),
(36, 1, '2024-03-10'),
(37, 2, '2024-03-10'),
(38, 3, '2024-03-10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detailrevisi`
--

CREATE TABLE `detailrevisi` (
  `id_detail` int(11) NOT NULL,
  `id_revisi` int(11) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `detailrevisi`
--

INSERT INTO `detailrevisi` (`id_detail`, `id_revisi`, `tanggal`) VALUES
(0, 3, '1970-01-01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `nim` varchar(50) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `waktu_masuk` date NOT NULL,
  `id_departemen` int(11) NOT NULL,
  `level` enum('admin','pegawai','pegawaioutside','superadmin','hrd') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`nim`, `jenis_kelamin`, `waktu_masuk`, `id_departemen`, `level`) VALUES
('1221', 'L', '2024-02-22', 1, 'pegawai'),
('2110102018', 'L', '2024-02-22', 1, 'pegawai'),
('2111923812', 'L', '2024-03-04', 1, 'admin'),
('2119238212', 'L', '2024-02-22', 1, 'pegawaioutside'),
('21213123', 'L', '2024-02-22', 2, 'pegawaioutside'),
('5213', 'L', '2024-03-08', 1, 'pegawaioutside'),
('523423432', 'L', '2024-03-04', 6, 'hrd'),
('5324234', 'P', '2024-03-08', 1, 'pegawai'),
('83123021', 'L', '2024-02-28', 1, 'superadmin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `revisi_absen`
--

CREATE TABLE `revisi_absen` (
  `id_revisi` int(11) NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `keterangan` text DEFAULT NULL,
  `status` enum('diajukan','diterima','ditolak') NOT NULL,
  `nim` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `revisi_absen`
--

INSERT INTO `revisi_absen` (`id_revisi`, `waktu`, `keterangan`, `status`, `nim`) VALUES
(3, '2024-03-10 06:55:06', 'asd', 'diajukan', '2119238212');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `nama` varchar(254) NOT NULL,
  `email` varchar(254) NOT NULL,
  `password` varchar(254) NOT NULL,
  `level` enum('admin','pegawai','pegawaioutside','superadmin','hrd') NOT NULL,
  `nim` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`user_id`, `nama`, `email`, `password`, `level`, `nim`) VALUES
(1, 'Administrator2', 'admin@admin.com', '202cb962ac59075b964b07152d234b70', 'admin', NULL),
(55, 'useron2', 'useron@gmail.com', '6ad14ba9986e3615423dfca256d04e3f', 'pegawai', '2110102018'),
(57, 'haikal', 'haikal@gmail.com', '539760b3222370b2754cbac577b2fc31', 'superadmin', ''),
(58, 'userout', 'userout@gmail.com', '6ad14ba9986e3615423dfca256d04e3f', 'pegawaioutside', '2119238212'),
(60, 'ekal', 'ekal@gmail.com', '539760b3222370b2754cbac577b2fc31', 'superadmin', '83123021'),
(62, 'hekal', 'hekal@gmail.com', '539760b3222370b2754cbac577b2fc31', 'hrd', '523423432'),
(65, 'hekral', 'hekral@gmail.com', '539760b3222370b2754cbac577b2fc31', 'admin', '2111923812'),
(66, 'udin', 'udin@gmail.com', '202cb962ac59075b964b07152d234b70', 'pegawaioutside', '5213'),
(67, 'didin', 'didin@gmail.com', '202cb962ac59075b964b07152d234b70', 'pegawai', '5324234');

-- --------------------------------------------------------

--
-- Struktur dari tabel `web`
--

CREATE TABLE `web` (
  `id_web` int(11) NOT NULL,
  `logo` varchar(254) NOT NULL,
  `nama` varchar(254) NOT NULL,
  `author` varchar(254) NOT NULL,
  `nohp` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `web`
--

INSERT INTO `web` (`id_web`, `logo`, `nama`, `author`, `nohp`, `email`) VALUES
(1, 'canngopilogo.png', 'E - CanNgopi', 'Muhammad Haikal', '089503725636', 'Haikal@gmail.com');

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
-- Indeks untuk tabel `detailrevisi`
--
ALTER TABLE `detailrevisi`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indeks untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`nim`);

--
-- Indeks untuk tabel `revisi_absen`
--
ALTER TABLE `revisi_absen`
  ADD PRIMARY KEY (`id_revisi`);

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
  MODIFY `id_absen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT untuk tabel `cuti`
--
ALTER TABLE `cuti`
  MODIFY `id_cuti` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `departemen`
--
ALTER TABLE `departemen`
  MODIFY `departemen_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `detailcuti`
--
ALTER TABLE `detailcuti`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT untuk tabel `revisi_absen`
--
ALTER TABLE `revisi_absen`
  MODIFY `id_revisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT untuk tabel `web`
--
ALTER TABLE `web`
  MODIFY `id_web` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
