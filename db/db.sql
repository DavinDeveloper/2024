-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Waktu pembuatan: 12 Bulan Mei 2024 pada 06.18
-- Versi server: 10.11.7-MariaDB-cll-lve
-- Versi PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u156341823_kmw`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `angsuran`
--

CREATE TABLE `angsuran` (
  `id` int(11) NOT NULL,
  `id_pinjaman` varchar(256) NOT NULL,
  `username` varchar(256) NOT NULL,
  `bulan` varchar(256) NOT NULL,
  `nominal` varchar(256) NOT NULL,
  `total_pinjaman` varchar(256) NOT NULL,
  `pembayaran_ke` varchar(256) NOT NULL,
  `tenggat` varchar(256) NOT NULL,
  `notifikasi_tanggal` varchar(256) NOT NULL,
  `notifikasi_status` enum('Belum','Sudah','Terlambat') NOT NULL,
  `tipe` enum('Belum Dibayar','Cash','Transfer') NOT NULL,
  `status` enum('Belum Dibayar','Dibayar','Terlambat') NOT NULL,
  `dibayarkan` varchar(256) NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `angsuran`
--

INSERT INTO `angsuran` (`id`, `id_pinjaman`, `username`, `bulan`, `nominal`, `total_pinjaman`, `pembayaran_ke`, `tenggat`, `notifikasi_tanggal`, `notifikasi_status`, `tipe`, `status`, `dibayarkan`, `datetime`) VALUES
(1, '1', 'tes2', '2024-05', '500000', '5000000', '1', '2024-05-25', '2024-05-20', 'Sudah', 'Cash', 'Dibayar', '2024-05-03 17:43:35', '2024-05-02 16:44:14'),
(2, '1', 'tes2', '2024-06', '500000', '5000000', '2', '2024-06-25', '2024-06-20', 'Sudah', 'Transfer', 'Dibayar', '2024-05-03 17:44:39', '2024-05-02 16:44:14'),
(3, '1', 'tes2', '2024-07', '500000', '5000000', '3', '2024-07-25', '2024-07-20', 'Sudah', 'Transfer', 'Dibayar', '2024-05-03 17:45:04', '2024-05-02 16:44:14'),
(4, '1', 'tes2', '2024-08', '500000', '5000000', '4', '2024-08-25', '2024-08-20', 'Sudah', 'Transfer', 'Dibayar', '2024-05-03 17:46:06', '2024-05-02 16:44:14'),
(5, '1', 'tes2', '2024-09', '500000', '5000000', '5', '2024-09-25', '2024-09-20', 'Sudah', 'Cash', 'Dibayar', '2024-05-03 17:46:20', '2024-05-02 16:44:14'),
(6, '1', 'tes2', '2024-10', '500000', '5000000', '6', '2024-10-25', '2024-10-20', 'Sudah', 'Cash', 'Dibayar', '2024-05-03 17:46:20', '2024-05-02 16:44:14'),
(7, '1', 'tes2', '2024-11', '500000', '5000000', '7', '2024-11-25', '2024-11-20', 'Sudah', 'Cash', 'Dibayar', '2024-05-03 17:46:20', '2024-05-02 16:44:14'),
(8, '1', 'tes2', '2024-12', '500000', '5000000', '8', '2024-12-25', '2024-12-20', 'Sudah', 'Cash', 'Dibayar', '2024-05-03 17:46:20', '2024-05-02 16:44:14'),
(9, '1', 'tes2', '2025-01', '500000', '5000000', '9', '2025-01-25', '2025-01-20', 'Sudah', 'Cash', 'Dibayar', '2024-05-03 17:46:20', '2024-05-02 16:44:14'),
(10, '1', 'tes2', '2025-02', '500000', '5000000', '10', '2025-02-25', '2025-02-20', 'Sudah', 'Cash', 'Dibayar', '2024-05-03 17:46:20', '2024-05-02 16:44:14'),
(11, '2', 'tes1', '2024-05', '500000', '5000000', '1', '2024-05-25', '2024-05-20', 'Belum', 'Belum Dibayar', 'Belum Dibayar', '', '2024-05-03 18:13:06'),
(12, '2', 'tes1', '2024-06', '500000', '5000000', '2', '2024-06-25', '2024-06-20', 'Belum', 'Belum Dibayar', 'Belum Dibayar', '', '2024-05-03 18:13:06'),
(13, '2', 'tes1', '2024-07', '500000', '5000000', '3', '2024-07-25', '2024-07-20', 'Belum', 'Belum Dibayar', 'Belum Dibayar', '', '2024-05-03 18:13:06'),
(14, '2', 'tes1', '2024-08', '500000', '5000000', '4', '2024-08-25', '2024-08-20', 'Belum', 'Belum Dibayar', 'Belum Dibayar', '', '2024-05-03 18:13:06'),
(15, '2', 'tes1', '2024-09', '500000', '5000000', '5', '2024-09-25', '2024-09-20', 'Belum', 'Belum Dibayar', 'Belum Dibayar', '', '2024-05-03 18:13:06'),
(16, '2', 'tes1', '2024-10', '500000', '5000000', '6', '2024-10-25', '2024-10-20', 'Belum', 'Belum Dibayar', 'Belum Dibayar', '', '2024-05-03 18:13:06'),
(17, '2', 'tes1', '2024-11', '500000', '5000000', '7', '2024-11-25', '2024-11-20', 'Belum', 'Belum Dibayar', 'Belum Dibayar', '', '2024-05-03 18:13:06'),
(18, '2', 'tes1', '2024-12', '500000', '5000000', '8', '2024-12-25', '2024-12-20', 'Belum', 'Belum Dibayar', 'Belum Dibayar', '', '2024-05-03 18:13:06'),
(19, '2', 'tes1', '2025-01', '500000', '5000000', '9', '2025-01-25', '2025-01-20', 'Belum', 'Belum Dibayar', 'Belum Dibayar', '', '2024-05-03 18:13:06'),
(20, '2', 'tes1', '2025-02', '500000', '5000000', '10', '2025-02-25', '2025-02-20', 'Belum', 'Belum Dibayar', 'Belum Dibayar', '', '2024-05-03 18:13:06'),
(21, '3', 'tes2', '2024-05', '500000', '5000000', '1', '2024-05-25', '2024-05-20', 'Belum', 'Belum Dibayar', 'Belum Dibayar', '', '2024-05-03 18:23:32'),
(22, '3', 'tes2', '2024-06', '500000', '5000000', '2', '2024-06-25', '2024-06-20', 'Belum', 'Belum Dibayar', 'Belum Dibayar', '', '2024-05-03 18:23:32'),
(23, '3', 'tes2', '2024-07', '500000', '5000000', '3', '2024-07-25', '2024-07-20', 'Belum', 'Belum Dibayar', 'Belum Dibayar', '', '2024-05-03 18:23:32'),
(24, '3', 'tes2', '2024-08', '500000', '5000000', '4', '2024-08-25', '2024-08-20', 'Belum', 'Belum Dibayar', 'Belum Dibayar', '', '2024-05-03 18:23:32'),
(25, '3', 'tes2', '2024-09', '500000', '5000000', '5', '2024-09-25', '2024-09-20', 'Belum', 'Belum Dibayar', 'Belum Dibayar', '', '2024-05-03 18:23:32'),
(26, '3', 'tes2', '2024-10', '500000', '5000000', '6', '2024-10-25', '2024-10-20', 'Belum', 'Belum Dibayar', 'Belum Dibayar', '', '2024-05-03 18:23:32'),
(27, '3', 'tes2', '2024-11', '500000', '5000000', '7', '2024-11-25', '2024-11-20', 'Belum', 'Belum Dibayar', 'Belum Dibayar', '', '2024-05-03 18:23:32'),
(28, '3', 'tes2', '2024-12', '500000', '5000000', '8', '2024-12-25', '2024-12-20', 'Belum', 'Belum Dibayar', 'Belum Dibayar', '', '2024-05-03 18:23:32'),
(29, '3', 'tes2', '2025-01', '500000', '5000000', '9', '2025-01-25', '2025-01-20', 'Belum', 'Belum Dibayar', 'Belum Dibayar', '', '2024-05-03 18:23:32'),
(30, '3', 'tes2', '2025-02', '500000', '5000000', '10', '2025-02-25', '2025-02-20', 'Belum', 'Belum Dibayar', 'Belum Dibayar', '', '2024-05-03 18:23:32'),
(31, '5', 'anggota', '2024-05', '500000', '5000000', '1', '2024-05-25', '2024-05-20', 'Sudah', 'Cash', 'Dibayar', '2024-05-12 12:52:59', '2024-05-06 12:05:35'),
(32, '5', 'anggota', '2024-06', '500000', '5000000', '2', '2024-06-25', '2024-06-20', 'Belum', 'Belum Dibayar', 'Belum Dibayar', '', '2024-05-06 12:05:35'),
(33, '5', 'anggota', '2024-07', '500000', '5000000', '3', '2024-07-25', '2024-07-20', 'Belum', 'Belum Dibayar', 'Belum Dibayar', '', '2024-05-06 12:05:35'),
(34, '5', 'anggota', '2024-08', '500000', '5000000', '4', '2024-08-25', '2024-08-20', 'Belum', 'Belum Dibayar', 'Belum Dibayar', '', '2024-05-06 12:05:35'),
(35, '5', 'anggota', '2024-09', '500000', '5000000', '5', '2024-09-25', '2024-09-20', 'Belum', 'Belum Dibayar', 'Belum Dibayar', '', '2024-05-06 12:05:35'),
(36, '5', 'anggota', '2024-10', '500000', '5000000', '6', '2024-10-25', '2024-10-20', 'Belum', 'Belum Dibayar', 'Belum Dibayar', '', '2024-05-06 12:05:35'),
(37, '5', 'anggota', '2024-11', '500000', '5000000', '7', '2024-11-25', '2024-11-20', 'Belum', 'Belum Dibayar', 'Belum Dibayar', '', '2024-05-06 12:05:35'),
(38, '5', 'anggota', '2024-12', '500000', '5000000', '8', '2024-12-25', '2024-12-20', 'Belum', 'Belum Dibayar', 'Belum Dibayar', '', '2024-05-06 12:05:35'),
(39, '5', 'anggota', '2025-01', '500000', '5000000', '9', '2025-01-25', '2025-01-20', 'Belum', 'Belum Dibayar', 'Belum Dibayar', '', '2024-05-06 12:05:35'),
(40, '5', 'anggota', '2025-02', '500000', '5000000', '10', '2025-02-25', '2025-02-20', 'Belum', 'Belum Dibayar', 'Belum Dibayar', '', '2024-05-06 12:05:35'),
(41, '7', 'siti', '2024-05', '500000', '5000000', '1', '2024-05-25', '2024-05-20', 'Sudah', 'Cash', 'Dibayar', '2024-05-07 13:25:16', '2024-05-07 13:23:44'),
(42, '7', 'siti', '2024-06', '500000', '5000000', '2', '2024-06-25', '2024-06-20', 'Sudah', 'Transfer', 'Dibayar', '2024-05-07 13:25:36', '2024-05-07 13:23:44'),
(43, '7', 'siti', '2024-07', '500000', '5000000', '3', '2024-07-25', '2024-07-20', 'Sudah', 'Transfer', 'Dibayar', '2024-05-07 13:25:36', '2024-05-07 13:23:44'),
(44, '7', 'siti', '2024-08', '500000', '5000000', '4', '2024-08-25', '2024-08-20', 'Sudah', 'Transfer', 'Dibayar', '2024-05-07 13:25:36', '2024-05-07 13:23:44'),
(45, '7', 'siti', '2024-09', '500000', '5000000', '5', '2024-09-25', '2024-09-20', 'Sudah', 'Transfer', 'Dibayar', '2024-05-07 13:25:36', '2024-05-07 13:23:44'),
(46, '7', 'siti', '2024-10', '500000', '5000000', '6', '2024-10-25', '2024-10-20', 'Sudah', 'Transfer', 'Dibayar', '2024-05-07 13:25:36', '2024-05-07 13:23:44'),
(47, '7', 'siti', '2024-11', '500000', '5000000', '7', '2024-11-25', '2024-11-20', 'Sudah', 'Transfer', 'Dibayar', '2024-05-07 13:25:36', '2024-05-07 13:23:44'),
(48, '7', 'siti', '2024-12', '500000', '5000000', '8', '2024-12-25', '2024-12-20', 'Sudah', 'Transfer', 'Dibayar', '2024-05-07 13:25:36', '2024-05-07 13:23:44'),
(49, '7', 'siti', '2025-01', '500000', '5000000', '9', '2025-01-25', '2025-01-20', 'Sudah', 'Transfer', 'Dibayar', '2024-05-07 13:25:36', '2024-05-07 13:23:44'),
(50, '7', 'siti', '2025-02', '500000', '5000000', '10', '2025-02-25', '2025-02-20', 'Sudah', 'Transfer', 'Dibayar', '2024-05-07 13:25:36', '2024-05-07 13:23:44'),
(51, '8', 'ekapuspasari', '2024-05', '200000', '2000000', '1', '2024-05-25', '2024-05-20', 'Belum', 'Belum Dibayar', 'Belum Dibayar', '', '2024-05-12 13:03:21'),
(52, '8', 'ekapuspasari', '2024-06', '200000', '2000000', '2', '2024-06-25', '2024-06-20', 'Belum', 'Belum Dibayar', 'Belum Dibayar', '', '2024-05-12 13:03:21'),
(53, '8', 'ekapuspasari', '2024-07', '200000', '2000000', '3', '2024-07-25', '2024-07-20', 'Belum', 'Belum Dibayar', 'Belum Dibayar', '', '2024-05-12 13:03:21'),
(54, '8', 'ekapuspasari', '2024-08', '200000', '2000000', '4', '2024-08-25', '2024-08-20', 'Belum', 'Belum Dibayar', 'Belum Dibayar', '', '2024-05-12 13:03:21'),
(55, '8', 'ekapuspasari', '2024-09', '200000', '2000000', '5', '2024-09-25', '2024-09-20', 'Belum', 'Belum Dibayar', 'Belum Dibayar', '', '2024-05-12 13:03:21'),
(56, '8', 'ekapuspasari', '2024-10', '200000', '2000000', '6', '2024-10-25', '2024-10-20', 'Belum', 'Belum Dibayar', 'Belum Dibayar', '', '2024-05-12 13:03:21'),
(57, '8', 'ekapuspasari', '2024-11', '200000', '2000000', '7', '2024-11-25', '2024-11-20', 'Belum', 'Belum Dibayar', 'Belum Dibayar', '', '2024-05-12 13:03:21'),
(58, '8', 'ekapuspasari', '2024-12', '200000', '2000000', '8', '2024-12-25', '2024-12-20', 'Belum', 'Belum Dibayar', 'Belum Dibayar', '', '2024-05-12 13:03:21'),
(59, '8', 'ekapuspasari', '2025-01', '200000', '2000000', '9', '2025-01-25', '2025-01-20', 'Belum', 'Belum Dibayar', 'Belum Dibayar', '', '2024-05-12 13:03:21'),
(60, '8', 'ekapuspasari', '2025-02', '200000', '2000000', '10', '2025-02-25', '2025-02-20', 'Belum', 'Belum Dibayar', 'Belum Dibayar', '', '2024-05-12 13:03:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ketentuan`
--

CREATE TABLE `ketentuan` (
  `id` int(11) NOT NULL,
  `jenis` enum('Keanggotaan','Pinjaman') NOT NULL,
  `konten` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `ketentuan`
--

INSERT INTO `ketentuan` (`id`, `jenis`, `konten`) VALUES
(1, 'Keanggotaan', 'Tes\r\n\r\n1\r\n\r\n2\r\n\r\n3\r\n\r\nHehe'),
(2, 'Pinjaman', 'Kepada Yth.\r\nKetua Koperasi Mekarwangi\r\nDi Tempat\r\n\r\nDengan Hormat,\r\nYang bertandatangan di bawah ini, saya:\r\nNama	:\r\nID Anggota	:\r\n\r\n\r\nTempat/Tanggal Lahir	:	\r\nPekerjaan	:	\r\nAlamat	:\r\nNo. Telpon	:\r\n\r\nDengan ini mengajukan permohonan pinjaman uang kepada Koperasi Mekarwangi, sebagai berikut:\r\nJumlah Pinjaman	:	\r\nJumlah Angsuran	:	\r\nUntuk Keperluan	:\r\n\r\nSaya bersedia (gaji/tunjangan kinerja/pendapatan lainnya*) bulanan saya dipotong otomatis mulai bulan depan oleh Bendahara Pengeluaran BUTTMKHIT untuk membayar angsuran pinjaman tersebut jika permohonan saya disetujui.\r\n\r\nDemikian surat permohonan ini saya buat, atas perhatian dan persetujuannya saya ucapkan terima kasih.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `nominal`
--

CREATE TABLE `nominal` (
  `id` int(11) NOT NULL,
  `jenis` enum('Pokok','Wajib','Limit','Pinjam') NOT NULL,
  `nominal` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `nominal`
--

INSERT INTO `nominal` (`id`, `jenis`, `nominal`) VALUES
(1, 'Pokok', '200000'),
(2, 'Wajib', '100000'),
(3, 'Limit', '50000000'),
(4, 'Pinjam', '5000000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pinjaman`
--

CREATE TABLE `pinjaman` (
  `id` int(11) NOT NULL,
  `username` varchar(256) NOT NULL,
  `nominal` varchar(256) NOT NULL,
  `angsuran` varchar(256) NOT NULL,
  `status` enum('Menunggu','Ditolak','Belum Lunas','Lunas','Terlambat') NOT NULL,
  `pengajuan` enum('Menunggu','Ditolak','Dikonfirmasi') NOT NULL,
  `keperluan` enum('Pribadi','Kegiatan') NOT NULL,
  `alasan` text NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `pinjaman`
--

INSERT INTO `pinjaman` (`id`, `username`, `nominal`, `angsuran`, `status`, `pengajuan`, `keperluan`, `alasan`, `datetime`) VALUES
(1, 'tes2', '5000000', '10', 'Lunas', 'Dikonfirmasi', 'Pribadi', '', '2024-05-01 14:41:56'),
(2, 'tes1', '5000000', '10', 'Belum Lunas', 'Dikonfirmasi', 'Pribadi', '', '2024-05-03 17:56:24'),
(3, 'tes2', '5000000', '10', 'Belum Lunas', 'Dikonfirmasi', 'Pribadi', '', '2024-05-03 18:23:23'),
(4, 'tes2', '5000000', '10', 'Ditolak', 'Ditolak', 'Pribadi', 'Keseringan Pinjam', '2024-05-03 19:01:28'),
(5, 'anggota', '5000000', '10', 'Belum Lunas', 'Dikonfirmasi', 'Pribadi', '', '2024-05-06 12:05:02'),
(6, 'siti', '5000000', '10', 'Ditolak', 'Ditolak', 'Pribadi', 'Keseringan pinjam', '2024-05-07 13:21:58'),
(7, 'siti', '5000000', '10', 'Lunas', 'Dikonfirmasi', 'Pribadi', '', '2024-05-07 13:23:35'),
(8, 'ekapuspasari', '2000000', '10', 'Belum Lunas', 'Dikonfirmasi', 'Pribadi', '', '2024-05-12 13:01:45');

-- --------------------------------------------------------

--
-- Struktur dari tabel `simpanan`
--

CREATE TABLE `simpanan` (
  `id` int(11) NOT NULL,
  `username` varchar(256) NOT NULL,
  `jenis` enum('Pokok','Wajib') NOT NULL,
  `nominal` varchar(256) NOT NULL,
  `tipe` enum('Belum Dibayar','Cash','Transfer') NOT NULL,
  `status` enum('Belum Dibayar','Dibayar','Terlambat') NOT NULL,
  `bulan` varchar(256) NOT NULL,
  `tenggat` varchar(256) NOT NULL,
  `notifikasi_tanggal` varchar(256) NOT NULL,
  `notifikasi_status` enum('Belum','Sudah') NOT NULL,
  `dibayarkan` varchar(256) NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `simpanan`
--

INSERT INTO `simpanan` (`id`, `username`, `jenis`, `nominal`, `tipe`, `status`, `bulan`, `tenggat`, `notifikasi_tanggal`, `notifikasi_status`, `dibayarkan`, `datetime`) VALUES
(1, 'tes2', 'Pokok', '200000', 'Cash', 'Dibayar', '2024-05', '2024-05-25', '2024-05-20', 'Belum', '2024-05-01 11:43:21', '2024-05-01 09:36:23'),
(2, 'tes2', 'Wajib', '100000', 'Cash', 'Dibayar', '2024-05', '2024-05-25', '2024-05-20', 'Sudah', '2024-05-03 18:06:44', '2024-05-01 09:36:23'),
(7, 'anggota', 'Wajib', '100000', 'Transfer', 'Dibayar', '2024-05', '2024-05-25', '2024-05-03', 'Sudah', '2024-05-03 19:59:28', '2024-05-03 18:45:08'),
(8, 'tes1', 'Wajib', '100000', 'Transfer', 'Dibayar', '2024-05', '2024-05-25', '2024-05-03', 'Sudah', '2024-05-03 20:00:42', '2024-05-03 18:45:08'),
(9, 'tes3', 'Pokok', '200000', 'Belum Dibayar', 'Belum Dibayar', '2024-05', '2024-05-25', '2024-05-20', 'Belum', '', '2024-05-03 22:57:18'),
(10, 'tes3', 'Wajib', '100000', 'Belum Dibayar', 'Belum Dibayar', '2024-05', '2024-05-25', '2024-05-20', 'Belum', '', '2024-05-03 22:57:18'),
(11, 'tes3', 'Pokok', '200000', 'Belum Dibayar', 'Belum Dibayar', '2024-05', '2024-05-25', '2024-05-20', 'Belum', '', '2024-05-03 22:58:56'),
(12, 'tes3', 'Wajib', '100000', 'Belum Dibayar', 'Belum Dibayar', '2024-05', '2024-05-25', '2024-05-20', 'Belum', '', '2024-05-03 22:58:56'),
(13, 'siti', 'Pokok', '200000', 'Cash', 'Dibayar', '2024-05', '2024-05-25', '2024-05-20', 'Sudah', '2024-05-07 13:20:39', '2024-05-07 13:19:22'),
(14, 'siti', 'Wajib', '100000', 'Transfer', 'Dibayar', '2024-05', '2024-05-25', '2024-05-20', 'Sudah', '2024-05-07 13:20:42', '2024-05-07 13:19:22'),
(15, 'ekapuspasari', 'Pokok', '200000', 'Cash', 'Dibayar', '2024-05', '2024-05-25', '2024-05-20', 'Sudah', '2024-05-12 12:58:21', '2024-05-12 12:55:48'),
(16, 'ekapuspasari', 'Wajib', '100000', 'Cash', 'Dibayar', '2024-05', '2024-05-25', '2024-05-20', 'Sudah', '2024-05-12 12:58:31', '2024-05-12 12:55:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `nama` varchar(256) NOT NULL,
  `tempat_lahir` varchar(256) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `pekerjaan` varchar(256) NOT NULL,
  `alamat` varchar(256) NOT NULL,
  `whatsapp` varchar(256) NOT NULL,
  `status` enum('Anggota','Bendahara','Ketua') NOT NULL,
  `keanggotaan` enum('Aktif','Nonaktif','Keluar') NOT NULL,
  `pinjaman` enum('Belum Tersedia','Pengecekan','Disetujui') NOT NULL,
  `limit_pinjam` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `nama`, `tempat_lahir`, `tanggal_lahir`, `pekerjaan`, `alamat`, `whatsapp`, `status`, `keanggotaan`, `pinjaman`, `limit_pinjam`) VALUES
(1, 'ketua', '00719910bb805741e4b7f28527ecb3ad', 'KETUA', 'Website', '2024-05-01', 'Ketua Koperasi', 'Website', '6281213539307', 'Ketua', 'Aktif', 'Belum Tersedia', '0'),
(2, 'bendahara', 'c9ccd7f3c1145515a9d3f7415d5bcbea', 'BENDAHARA', 'Website', '2024-05-01', 'Bendahara Koperasi', 'Website', '6281806993369', 'Bendahara', 'Aktif', 'Belum Tersedia', '0'),
(3, 'anggota', 'dfb9e85bc0da607ff76e0559c62537e8', 'ANGGOTA', 'Website', '2024-05-01', 'Anggota Koperasi', 'Website', '6285156493669', 'Anggota', 'Aktif', 'Disetujui', '45000000'),
(4, 'tes1', '202cb962ac59075b964b07152d234b70', 'ANGGOTA 1', 'Tes', '2024-05-01', 'Tes', 'Tes', '6285156493669', 'Anggota', 'Aktif', 'Disetujui', '45000000'),
(5, 'tes2', '202cb962ac59075b964b07152d234b70', 'TES 2', 'Tes', '2024-05-01', 'Tes 2', 'tes 2', '6285156493669', 'Anggota', 'Aktif', 'Disetujui', '40000000'),
(6, 'bendahara2', '202cb962ac59075b964b07152d234b70', 'BENDAHARA 2', 'bekasiiii', '2024-05-03', 'jandkja', 'asda', '6288822', 'Bendahara', 'Aktif', 'Belum Tersedia', '0'),
(7, 'tes3', '202cb962ac59075b964b07152d234b70', 'TES 3', 'tes 3', '2024-05-03', 'tes 3', 'tes3', '62823852', 'Anggota', 'Aktif', 'Belum Tersedia', '0'),
(8, 'siti', '4e8daf0bc5014c2286af8d30fb26bc04', 'SITI', 'Bekasi', '2024-05-07', 'Jualan', 'Tambun', '6285156492093', 'Anggota', 'Aktif', 'Disetujui', '45000000'),
(9, 'ekapuspasari', '416dc9cbc47271bfbe3bf10e3ed10460', 'EKAPUSPASARI', 'Bekasi', '2001-04-04', 'pegawai', 'kp. rawabanteng', '6285850505032', 'Anggota', 'Aktif', 'Disetujui', '48000000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `website`
--

CREATE TABLE `website` (
  `id` int(11) NOT NULL,
  `config` text NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `website`
--

INSERT INTO `website` (`id`, `config`, `content`) VALUES
(1, 'nama', 'KMW'),
(2, 'url', 'http://koperasikmw.my.id/'),
(3, 'logo', 'http://koperasikmw.my.id/assets/img/logo/LOGO.PNG'),
(4, 'path', '/home/u156341823/domains/koperasikmw.my.id/public_html/'),
(5, 'whatsapp', '6281213539307'),
(6, 'whatsapp_api', '68172c4edaca837ea3c2ff948a57ccc28c9db3a8'),
(7, 'whatsapp_url', 'https://whatsapp.webhook.my.id/send-message'),
(8, 'email', 'kmw@gmail.com'),
(9, 'alamat', 'Bekasi'),
(10, 'description', 'Koperasi Mekarwangi');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `angsuran`
--
ALTER TABLE `angsuran`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ketentuan`
--
ALTER TABLE `ketentuan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `nominal`
--
ALTER TABLE `nominal`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pinjaman`
--
ALTER TABLE `pinjaman`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `simpanan`
--
ALTER TABLE `simpanan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `website`
--
ALTER TABLE `website`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `angsuran`
--
ALTER TABLE `angsuran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT untuk tabel `ketentuan`
--
ALTER TABLE `ketentuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `nominal`
--
ALTER TABLE `nominal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `pinjaman`
--
ALTER TABLE `pinjaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `simpanan`
--
ALTER TABLE `simpanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `website`
--
ALTER TABLE `website`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
