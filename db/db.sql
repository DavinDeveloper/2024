-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Waktu pembuatan: 12 Bulan Mei 2024 pada 06.12
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
-- Database: `u404043844_binatama`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `config`
--

CREATE TABLE `config` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `developer` varchar(256) NOT NULL,
  `url` varchar(256) NOT NULL,
  `profile` text NOT NULL,
  `profile_gambar` text NOT NULL,
  `visi` text NOT NULL,
  `visi_gambar` text NOT NULL,
  `fasilitas` text NOT NULL,
  `fasilitas_gambar` text NOT NULL,
  `jurusan` text NOT NULL,
  `jurusan_gambar` text NOT NULL,
  `logo` varchar(256) NOT NULL,
  `rapor` varchar(256) NOT NULL,
  `telepon` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `alamat` varchar(256) NOT NULL,
  `note_transfer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `config`
--

INSERT INTO `config` (`id`, `name`, `developer`, `url`, `profile`, `profile_gambar`, `visi`, `visi_gambar`, `fasilitas`, `fasilitas_gambar`, `jurusan`, `jurusan_gambar`, `logo`, `rapor`, `telepon`, `email`, `alamat`, `note_transfer`) VALUES
(1, 'SMK Binatama', 'Elsha', 'https://binatama.sch.id/', 'Nama Sekolah : SMK BINATAMA\r\nNpsn                : 69992952\r\nAlamat             : Jl. Blk. F. Setu Asri, Cibening, Kec. Setu, Kabupaten Bekasi, Jawa Barat 17320\r\n\r\nKEUNGGULAN\r\n\r\n1. Gedung aman dan nyaman\r\n2. Guru profesional\r\n3. Peralatan praktek semua jurusan\r\n4. Penyaluran kerja\r\n5. Beasiswa\r\n6. Lulusan terampil, mandiri, dan siap kerja\r\n\r\n\r\nEKSTRAKULIKULER\r\n\r\nSelain kegiatan Organisasi Siswa Intra Sekolah ( OSIS ) terdapat beberapa kegiatan ekstrakulikuler :\r\n1. Pramuka\r\n2. Futsal\r\n3. Voli\r\n4. Badminton\r\n5. Kesenian', 'https://binatama.sch.id/assets/img/konten/profile.jpeg', 'VISI\r\n\r\nMEWUJUDKAN DAN TERCIPTANYA LULUSAN YANG MENGUASAI BIDANG KEAHLIANNYA SERTA TERSERAP DI DUNIA INDUSTRI (DUNIA KERJA)\r\n\r\n\r\nMISI\r\n\r\n1. KURIKULUM K 13 PERUBAHAN DAN DIPADUKAN DENGAN KURIKULUM MUATAN LOKAL.\r\n2. MENCIPTAKAN SUASANA BELAJAR YANG NYAMAN DAN AMAN KEPADA SISWA\r\n3. MENGGUNAKAN MOU DENGAN DUNIA INDUSTRI ( DUNIA KERJA ) SEHINGGA PARA LULUSAN DAPAT TERSERAP DI DUNIA KERJA.', 'https://binatama.sch.id/assets/img/konten/visi.jpeg', 'asdsadsada', 'https://binatama.sch.id/assets/img/konten/fasilitas.jpeg', '1. Teknik Kendaraan Ringan Otomotif\r\n2. Teknik Bisnis Sepeda Motor\r\n3. Teknik Komputer Jaringan\r\n4. Multimedia', 'https://binatama.sch.id/assets/img/konten/jurusan.jpeg', 'https://binatama.sch.id/assets/img/logo/9124C217-F5E0-4FBC-A9F9-D348CDD35D65.jpeg', 'https://binatama.sch.id/assets/img/logo/logo.png', '081213643572', 'smkbinatamahost@gmail.com', 'Bekasi', 'Silahkan bayar sejumlah Rp 350.000,- ke rekening dibawah ini :\r\nBNI 1417411105\r\na/n SMK BINATAMA');

-- --------------------------------------------------------

--
-- Struktur dari tabel `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `nama` varchar(256) NOT NULL,
  `icon` varchar(256) NOT NULL,
  `url` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `contact`
--

INSERT INTO `contact` (`id`, `nama`, `icon`, `url`) VALUES
(1, 'Instagram', 'instagram', 'https://instagram.com/smk_binatama'),
(2, 'WhatsApp', 'whatsapp', 'https://wa.me/6281213643572');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jurusan`
--

CREATE TABLE `jurusan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(256) NOT NULL,
  `kompetensi` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `jurusan`
--

INSERT INTO `jurusan` (`id`, `nama`, `kompetensi`) VALUES
(1, 'Multimedia', 'Multimedia'),
(2, 'Teknik dan Bisnis Sepeda Motor', 'Teknik dan Bisnis Sepeda Motor'),
(3, 'Teknik Kendaraan Ringan', 'Teknik Kendaraan Ringan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kegiatan`
--

CREATE TABLE `kegiatan` (
  `id` int(11) NOT NULL,
  `gambar` varchar(256) NOT NULL,
  `datetime` datetime NOT NULL,
  `status` enum('show','hide') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kegiatan`
--

INSERT INTO `kegiatan` (`id`, `gambar`, `datetime`, `status`) VALUES
(1, 'https://binatama.sch.id/assets/img/kegiatan/2024-05-02-10-55-11-D393BD32-9816-45A0-9FA7-328405098823.jpeg', '2024-05-02 10:55:11', 'show'),
(2, 'https://binatama.sch.id/assets/img/kegiatan/2024-05-02-10-55-11-D393BD32-9816-45A0-9FA7-328405098823.jpeg', '2024-05-02 10:55:11', 'show'),
(3, 'https://binatama.sch.id/assets/img/kegiatan/2024-05-02-10-55-11-D393BD32-9816-45A0-9FA7-328405098823.jpeg', '2024-05-02 10:55:11', 'show'),
(4, 'https://binatama.sch.id/assets/img/kegiatan/2024-05-02-10-55-11-D393BD32-9816-45A0-9FA7-328405098823.jpeg', '2024-05-02 10:55:11', 'show'),
(5, 'https://binatama.sch.id/assets/img/kegiatan/2024-05-02-10-55-11-D393BD32-9816-45A0-9FA7-328405098823.jpeg', '2024-05-02 10:55:11', 'show'),
(6, 'https://binatama.sch.id/assets/img/kegiatan/2024-05-02-10-55-11-D393BD32-9816-45A0-9FA7-328405098823.jpeg', '2024-05-02 10:55:11', 'show'),
(7, 'https://binatama.sch.id/assets/img/kegiatan/2024-05-02-10-55-11-D393BD32-9816-45A0-9FA7-328405098823.jpeg', '2024-05-02 10:55:11', 'show'),
(8, 'https://binatama.sch.id/assets/img/kegiatan/2024-05-02-10-55-11-D393BD32-9816-45A0-9FA7-328405098823.jpeg', '2024-05-02 10:55:11', 'show'),
(9, 'https://binatama.sch.id/assets/img/kegiatan/2024-05-02-10-55-11-D393BD32-9816-45A0-9FA7-328405098823.jpeg', '2024-05-02 10:55:11', 'show'),
(10, 'https://binatama.sch.id/assets/img/kegiatan/2024-05-02-10-55-11-D393BD32-9816-45A0-9FA7-328405098823.jpeg', '2024-05-02 10:55:11', 'show'),
(11, 'https://binatama.sch.id/assets/img/kegiatan/2024-05-02-10-55-11-D393BD32-9816-45A0-9FA7-328405098823.jpeg', '2024-05-02 10:55:11', 'show'),
(12, 'https://binatama.sch.id/assets/img/kegiatan/2024-05-02-10-55-11-D393BD32-9816-45A0-9FA7-328405098823.jpeg', '2024-05-02 10:55:11', 'show');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jurusan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id`, `nama`, `jurusan`) VALUES
(1, 'X TBSM', 'Teknik dan Bisnis Sepeda Motor'),
(2, 'XI TBSM', 'Teknik dan Bisnis Sepeda Motor'),
(3, 'XII TBSM', 'Teknik dan Bisnis Sepeda Motor'),
(4, 'X TKR', 'Teknik Kendaraan Ringan'),
(5, 'XI TKR', 'Teknik Kendaraan Ringan'),
(6, 'XII TKR', 'Teknik Kendaraan Ringan'),
(7, 'X Multimedia', 'Multimedia'),
(8, 'XI Multimedia', 'Multimedia'),
(9, 'XII Multimedia', 'Multimedia');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pas`
--

CREATE TABLE `pas` (
  `id` int(11) NOT NULL,
  `nis` varchar(256) NOT NULL,
  `nama` varchar(256) NOT NULL,
  `s1_a1_p` text DEFAULT NULL,
  `s1_a1_k` text DEFAULT NULL,
  `s1_a1_s` text DEFAULT NULL,
  `s2_a1_p` text DEFAULT NULL,
  `s2_a1_k` text DEFAULT NULL,
  `s2_a1_s` text DEFAULT NULL,
  `s3_a1_p` text DEFAULT NULL,
  `s3_a1_k` text DEFAULT NULL,
  `s3_a1_s` text DEFAULT NULL,
  `s4_a1_p` text DEFAULT NULL,
  `s4_a1_k` text DEFAULT NULL,
  `s4_a1_s` text DEFAULT NULL,
  `s5_a1_p` text DEFAULT NULL,
  `s5_a1_k` text DEFAULT NULL,
  `s5_a1_s` text DEFAULT NULL,
  `s6_a1_p` text DEFAULT NULL,
  `s6_a1_k` text DEFAULT NULL,
  `s6_a1_s` text DEFAULT NULL,
  `s1_a2_p` text DEFAULT NULL,
  `s1_a2_k` text DEFAULT NULL,
  `s1_a2_s` text DEFAULT NULL,
  `s2_a2_p` text DEFAULT NULL,
  `s2_a2_k` text DEFAULT NULL,
  `s2_a2_s` text DEFAULT NULL,
  `s3_a2_p` text DEFAULT NULL,
  `s3_a2_k` text DEFAULT NULL,
  `s3_a2_s` text DEFAULT NULL,
  `s4_a2_p` text DEFAULT NULL,
  `s4_a2_k` text DEFAULT NULL,
  `s4_a2_s` text DEFAULT NULL,
  `s5_a2_p` text DEFAULT NULL,
  `s5_a2_k` text DEFAULT NULL,
  `s5_a2_s` text DEFAULT NULL,
  `s6_a2_p` text DEFAULT NULL,
  `s6_a2_k` text DEFAULT NULL,
  `s6_a2_s` text DEFAULT NULL,
  `s1_a3_p` text DEFAULT NULL,
  `s1_a3_k` text DEFAULT NULL,
  `s1_a3_s` text DEFAULT NULL,
  `s2_a3_p` text DEFAULT NULL,
  `s2_a3_k` text DEFAULT NULL,
  `s2_a3_s` text DEFAULT NULL,
  `s3_a3_p` text DEFAULT NULL,
  `s3_a3_k` text DEFAULT NULL,
  `s3_a3_s` text DEFAULT NULL,
  `s4_a3_p` text DEFAULT NULL,
  `s4_a3_k` text DEFAULT NULL,
  `s4_a3_s` text DEFAULT NULL,
  `s5_a3_p` text DEFAULT NULL,
  `s5_a3_k` text DEFAULT NULL,
  `s5_a3_s` text DEFAULT NULL,
  `s6_a3_p` text DEFAULT NULL,
  `s6_a3_k` text DEFAULT NULL,
  `s6_a3_s` text DEFAULT NULL,
  `s1_a4_p` text DEFAULT NULL,
  `s1_a4_k` text DEFAULT NULL,
  `s1_a4_s` text DEFAULT NULL,
  `s2_a4_p` text DEFAULT NULL,
  `s2_a4_k` text DEFAULT NULL,
  `s2_a4_s` text DEFAULT NULL,
  `s3_a4_p` text DEFAULT NULL,
  `s3_a4_k` text DEFAULT NULL,
  `s3_a4_s` text DEFAULT NULL,
  `s4_a4_p` text DEFAULT NULL,
  `s4_a4_k` text DEFAULT NULL,
  `s4_a4_s` text DEFAULT NULL,
  `s5_a4_p` text DEFAULT NULL,
  `s5_a4_k` text DEFAULT NULL,
  `s5_a4_s` text DEFAULT NULL,
  `s6_a4_p` text DEFAULT NULL,
  `s6_a4_k` text DEFAULT NULL,
  `s6_a4_s` text DEFAULT NULL,
  `s1_a5_p` text DEFAULT NULL,
  `s1_a5_k` text DEFAULT NULL,
  `s1_a5_s` text DEFAULT NULL,
  `s2_a5_p` text DEFAULT NULL,
  `s2_a5_k` text DEFAULT NULL,
  `s2_a5_s` text DEFAULT NULL,
  `s3_a5_p` text DEFAULT NULL,
  `s3_a5_k` text DEFAULT NULL,
  `s3_a5_s` text DEFAULT NULL,
  `s4_a5_p` text DEFAULT NULL,
  `s4_a5_k` text DEFAULT NULL,
  `s4_a5_s` text DEFAULT NULL,
  `s5_a5_p` text DEFAULT NULL,
  `s5_a5_k` text DEFAULT NULL,
  `s5_a5_s` text DEFAULT NULL,
  `s6_a5_p` text DEFAULT NULL,
  `s6_a5_k` text DEFAULT NULL,
  `s6_a5_s` text DEFAULT NULL,
  `s1_b1_p` text DEFAULT NULL,
  `s1_b1_k` text DEFAULT NULL,
  `s1_b1_s` text DEFAULT NULL,
  `s2_b1_p` text DEFAULT NULL,
  `s2_b1_k` text DEFAULT NULL,
  `s2_b1_s` text DEFAULT NULL,
  `s3_b1_p` text DEFAULT NULL,
  `s3_b1_k` text DEFAULT NULL,
  `s3_b1_s` text DEFAULT NULL,
  `s4_b1_p` text DEFAULT NULL,
  `s4_b1_k` text DEFAULT NULL,
  `s4_b1_s` text DEFAULT NULL,
  `s5_b1_p` text DEFAULT NULL,
  `s5_b1_k` text DEFAULT NULL,
  `s5_b1_s` text DEFAULT NULL,
  `s6_b1_p` text DEFAULT NULL,
  `s6_b1_k` text DEFAULT NULL,
  `s6_b1_s` text DEFAULT NULL,
  `s1_c1_p` text DEFAULT NULL,
  `s1_c1_k` text DEFAULT NULL,
  `s1_c1_s` text DEFAULT NULL,
  `s2_c1_p` text DEFAULT NULL,
  `s2_c1_k` text DEFAULT NULL,
  `s2_c1_s` text DEFAULT NULL,
  `s3_c1_p` text DEFAULT NULL,
  `s3_c1_k` text DEFAULT NULL,
  `s3_c1_s` text DEFAULT NULL,
  `s4_c1_p` text DEFAULT NULL,
  `s4_c1_k` text DEFAULT NULL,
  `s4_c1_s` text DEFAULT NULL,
  `s5_c1_p` text DEFAULT NULL,
  `s5_c1_k` text DEFAULT NULL,
  `s5_c1_s` text DEFAULT NULL,
  `s6_c1_p` text DEFAULT NULL,
  `s6_c1_k` text DEFAULT NULL,
  `s6_c1_s` text DEFAULT NULL,
  `s1_c2_p` text DEFAULT NULL,
  `s1_c2_k` text DEFAULT NULL,
  `s1_c2_s` text DEFAULT NULL,
  `s2_c2_p` text DEFAULT NULL,
  `s2_c2_k` text DEFAULT NULL,
  `s2_c2_s` text DEFAULT NULL,
  `s3_c2_p` text DEFAULT NULL,
  `s3_c2_k` text DEFAULT NULL,
  `s3_c2_s` text DEFAULT NULL,
  `s4_c2_p` text DEFAULT NULL,
  `s4_c2_k` text DEFAULT NULL,
  `s4_c2_s` text DEFAULT NULL,
  `s5_c2_p` text DEFAULT NULL,
  `s5_c2_k` text DEFAULT NULL,
  `s5_c2_s` text DEFAULT NULL,
  `s6_c2_p` text DEFAULT NULL,
  `s6_c2_k` text DEFAULT NULL,
  `s6_c2_s` text DEFAULT NULL,
  `s1_c3_p` text DEFAULT NULL,
  `s1_c3_k` text DEFAULT NULL,
  `s1_c3_s` text DEFAULT NULL,
  `s2_c3_p` text DEFAULT NULL,
  `s2_c3_k` text DEFAULT NULL,
  `s2_c3_s` text DEFAULT NULL,
  `s3_c3_p` text DEFAULT NULL,
  `s3_c3_k` text DEFAULT NULL,
  `s3_c3_s` text DEFAULT NULL,
  `s4_c3_p` text DEFAULT NULL,
  `s4_c3_k` text DEFAULT NULL,
  `s4_c3_s` text DEFAULT NULL,
  `s5_c3_p` text DEFAULT NULL,
  `s5_c3_k` text DEFAULT NULL,
  `s5_c3_s` text DEFAULT NULL,
  `s6_c3_p` text DEFAULT NULL,
  `s6_c3_k` text DEFAULT NULL,
  `s6_c3_s` text DEFAULT NULL,
  `s1_c4_p` text DEFAULT NULL,
  `s1_c4_k` text DEFAULT NULL,
  `s1_c4_s` text DEFAULT NULL,
  `s2_c4_p` text DEFAULT NULL,
  `s2_c4_k` text DEFAULT NULL,
  `s2_c4_s` text DEFAULT NULL,
  `s3_c4_p` text DEFAULT NULL,
  `s3_c4_k` text DEFAULT NULL,
  `s3_c4_s` text DEFAULT NULL,
  `s4_c4_p` text DEFAULT NULL,
  `s4_c4_k` text DEFAULT NULL,
  `s4_c4_s` text DEFAULT NULL,
  `s5_c4_p` text DEFAULT NULL,
  `s5_c4_k` text DEFAULT NULL,
  `s5_c4_s` text DEFAULT NULL,
  `s6_c4_p` text DEFAULT NULL,
  `s6_c4_k` text DEFAULT NULL,
  `s6_c4_s` text DEFAULT NULL,
  `s1_c5_p` text DEFAULT NULL,
  `s1_c5_k` text DEFAULT NULL,
  `s1_c5_s` text DEFAULT NULL,
  `s2_c5_p` text DEFAULT NULL,
  `s2_c5_k` text DEFAULT NULL,
  `s2_c5_s` text DEFAULT NULL,
  `s3_c5_p` text DEFAULT NULL,
  `s3_c5_k` text DEFAULT NULL,
  `s3_c5_s` text DEFAULT NULL,
  `s4_c5_p` text DEFAULT NULL,
  `s4_c5_k` text DEFAULT NULL,
  `s4_c5_s` text DEFAULT NULL,
  `s5_c5_p` text DEFAULT NULL,
  `s5_c5_k` text DEFAULT NULL,
  `s5_c5_s` text DEFAULT NULL,
  `s6_c5_p` text DEFAULT NULL,
  `s6_c5_k` text DEFAULT NULL,
  `s6_c5_s` text DEFAULT NULL,
  `s1_d1_p` text DEFAULT NULL,
  `s1_d1_k` text DEFAULT NULL,
  `s1_d1_s` text DEFAULT NULL,
  `s2_d1_p` text DEFAULT NULL,
  `s2_d1_k` text DEFAULT NULL,
  `s2_d1_s` text DEFAULT NULL,
  `s3_d1_p` text DEFAULT NULL,
  `s3_d1_k` text DEFAULT NULL,
  `s3_d1_s` text DEFAULT NULL,
  `s4_d1_p` text DEFAULT NULL,
  `s4_d1_k` text DEFAULT NULL,
  `s4_d1_s` text DEFAULT NULL,
  `s5_d1_p` text DEFAULT NULL,
  `s5_d1_k` text DEFAULT NULL,
  `s5_d1_s` text DEFAULT NULL,
  `s6_d1_p` text DEFAULT NULL,
  `s6_d1_k` text DEFAULT NULL,
  `s6_d1_s` text DEFAULT NULL,
  `s1_ca` text DEFAULT NULL,
  `s2_ca` text DEFAULT NULL,
  `s3_ca` text DEFAULT NULL,
  `s4_ca` text DEFAULT NULL,
  `s5_ca` text DEFAULT NULL,
  `s6_ca` text DEFAULT NULL,
  `s1_pkl1_dd` text DEFAULT NULL,
  `s1_pkl1_lks` text DEFAULT NULL,
  `s1_pkl1_bln` text DEFAULT NULL,
  `s1_pkl1_n` text DEFAULT NULL,
  `s1_pkl2_dd` text DEFAULT NULL,
  `s1_pkl2_lks` text DEFAULT NULL,
  `s1_pkl2_bln` text DEFAULT NULL,
  `s1_pkl2_n` text DEFAULT NULL,
  `s1_pkl3_dd` text DEFAULT NULL,
  `s1_pkl3_lks` text DEFAULT NULL,
  `s1_pkl3_bln` text DEFAULT NULL,
  `s1_pkl3_n` text DEFAULT NULL,
  `s2_pkl1_dd` text DEFAULT NULL,
  `s2_pkl1_lks` text DEFAULT NULL,
  `s2_pkl1_bln` text DEFAULT NULL,
  `s2_pkl1_n` text DEFAULT NULL,
  `s2_pkl2_dd` text DEFAULT NULL,
  `s2_pkl2_lks` text DEFAULT NULL,
  `s2_pkl2_bln` text DEFAULT NULL,
  `s2_pkl2_n` text DEFAULT NULL,
  `s2_pkl3_dd` text DEFAULT NULL,
  `s2_pkl3_lks` text DEFAULT NULL,
  `s2_pkl3_bln` text DEFAULT NULL,
  `s2_pkl3_n` text DEFAULT NULL,
  `s3_pkl1_dd` text DEFAULT NULL,
  `s3_pkl1_lks` text DEFAULT NULL,
  `s3_pkl1_bln` text DEFAULT NULL,
  `s3_pkl1_n` text DEFAULT NULL,
  `s3_pkl2_dd` text DEFAULT NULL,
  `s3_pkl2_lks` text DEFAULT NULL,
  `s3_pkl2_bln` text DEFAULT NULL,
  `s3_pkl2_n` text DEFAULT NULL,
  `s3_pkl3_dd` text DEFAULT NULL,
  `s3_pkl3_lks` text DEFAULT NULL,
  `s3_pkl3_bln` text DEFAULT NULL,
  `s3_pkl3_n` text DEFAULT NULL,
  `s4_pkl1_dd` text DEFAULT NULL,
  `s4_pkl1_lks` text DEFAULT NULL,
  `s4_pkl1_bln` text DEFAULT NULL,
  `s4_pkl1_n` text DEFAULT NULL,
  `s4_pkl2_dd` text DEFAULT NULL,
  `s4_pkl2_lks` text DEFAULT NULL,
  `s4_pkl2_bln` text DEFAULT NULL,
  `s4_pkl2_n` text DEFAULT NULL,
  `s4_pkl3_dd` text DEFAULT NULL,
  `s4_pkl3_lks` text DEFAULT NULL,
  `s4_pkl3_bln` text DEFAULT NULL,
  `s4_pkl3_n` text DEFAULT NULL,
  `s5_pkl1_dd` text DEFAULT NULL,
  `s5_pkl1_lks` text DEFAULT NULL,
  `s5_pkl1_bln` text DEFAULT NULL,
  `s5_pkl1_n` text DEFAULT NULL,
  `s5_pkl2_dd` text DEFAULT NULL,
  `s5_pkl2_lks` text DEFAULT NULL,
  `s5_pkl2_bln` text DEFAULT NULL,
  `s5_pkl2_n` text DEFAULT NULL,
  `s5_pkl3_dd` text DEFAULT NULL,
  `s5_pkl3_lks` text DEFAULT NULL,
  `s5_pkl3_bln` text DEFAULT NULL,
  `s5_pkl3_n` text DEFAULT NULL,
  `s6_pkl1_dd` text DEFAULT NULL,
  `s6_pkl1_lks` text DEFAULT NULL,
  `s6_pkl1_bln` text DEFAULT NULL,
  `s6_pkl1_n` text DEFAULT NULL,
  `s6_pkl2_dd` text DEFAULT NULL,
  `s6_pkl2_lks` text DEFAULT NULL,
  `s6_pkl2_bln` text DEFAULT NULL,
  `s6_pkl2_n` text DEFAULT NULL,
  `s6_pkl3_dd` text DEFAULT NULL,
  `s6_pkl3_lks` text DEFAULT NULL,
  `s6_pkl3_bln` text DEFAULT NULL,
  `s6_pkl3_n` text DEFAULT NULL,
  `s1_eks1_eks` text DEFAULT NULL,
  `s1_eks1_n` text DEFAULT NULL,
  `s1_eks2_eks` text DEFAULT NULL,
  `s1_eks2_n` text DEFAULT NULL,
  `s1_eks3_eks` text DEFAULT NULL,
  `s1_eks3_n` text DEFAULT NULL,
  `s2_eks1_eks` text DEFAULT NULL,
  `s2_eks1_n` text DEFAULT NULL,
  `s2_eks2_eks` text DEFAULT NULL,
  `s2_eks2_n` text DEFAULT NULL,
  `s2_eks3_eks` text DEFAULT NULL,
  `s2_eks3_n` text DEFAULT NULL,
  `s3_eks1_eks` text DEFAULT NULL,
  `s3_eks1_n` text DEFAULT NULL,
  `s3_eks2_eks` text DEFAULT NULL,
  `s3_eks2_n` text DEFAULT NULL,
  `s3_eks3_eks` text DEFAULT NULL,
  `s3_eks3_n` text DEFAULT NULL,
  `s4_eks1_eks` text DEFAULT NULL,
  `s4_eks1_n` text DEFAULT NULL,
  `s4_eks2_eks` text DEFAULT NULL,
  `s4_eks2_n` text DEFAULT NULL,
  `s4_eks3_eks` text DEFAULT NULL,
  `s4_eks3_n` text DEFAULT NULL,
  `s5_eks1_eks` text DEFAULT NULL,
  `s5_eks1_n` text DEFAULT NULL,
  `s5_eks2_eks` text DEFAULT NULL,
  `s5_eks2_n` text DEFAULT NULL,
  `s5_eks3_eks` text DEFAULT NULL,
  `s5_eks3_n` text DEFAULT NULL,
  `s6_eks1_eks` text DEFAULT NULL,
  `s6_eks1_n` text DEFAULT NULL,
  `s6_eks2_eks` text DEFAULT NULL,
  `s6_eks2_n` text DEFAULT NULL,
  `s6_eks3_eks` text DEFAULT NULL,
  `s6_eks3_n` text DEFAULT NULL,
  `s1_hdr_s` text DEFAULT NULL,
  `s1_hdr_i` text DEFAULT NULL,
  `s1_hdr_t` text DEFAULT NULL,
  `s2_hdr_s` text DEFAULT NULL,
  `s2_hdr_i` text DEFAULT NULL,
  `s2_hdr_t` text DEFAULT NULL,
  `s3_hdr_s` text DEFAULT NULL,
  `s3_hdr_i` text DEFAULT NULL,
  `s3_hdr_t` text DEFAULT NULL,
  `s4_hdr_s` text DEFAULT NULL,
  `s4_hdr_i` text DEFAULT NULL,
  `s4_hdr_t` text DEFAULT NULL,
  `s5_hdr_s` text DEFAULT NULL,
  `s5_hdr_i` text DEFAULT NULL,
  `s5_hdr_t` text DEFAULT NULL,
  `s6_hdr_s` text DEFAULT NULL,
  `s6_hdr_i` text DEFAULT NULL,
  `s6_hdr_t` text DEFAULT NULL,
  `s1_naik` text DEFAULT NULL,
  `s2_naik` text DEFAULT NULL,
  `s3_naik` text DEFAULT NULL,
  `s4_naik` text DEFAULT NULL,
  `s5_naik` text DEFAULT NULL,
  `s6_naik` text DEFAULT NULL,
  `s1_pk_i` text DEFAULT NULL,
  `s1_pk_r` text DEFAULT NULL,
  `s1_pk_n` text DEFAULT NULL,
  `s1_pk_m` text DEFAULT NULL,
  `s1_pk_g` text DEFAULT NULL,
  `s1_pk_c` text DEFAULT NULL,
  `s2_pk_i` text DEFAULT NULL,
  `s2_pk_r` text DEFAULT NULL,
  `s2_pk_n` text DEFAULT NULL,
  `s2_pk_m` text DEFAULT NULL,
  `s2_pk_g` text DEFAULT NULL,
  `s2_pk_c` text DEFAULT NULL,
  `s3_pk_i` text DEFAULT NULL,
  `s3_pk_r` text DEFAULT NULL,
  `s3_pk_n` text DEFAULT NULL,
  `s3_pk_m` text DEFAULT NULL,
  `s3_pk_g` text DEFAULT NULL,
  `s3_pk_c` text DEFAULT NULL,
  `s4_pk_i` text DEFAULT NULL,
  `s4_pk_r` text DEFAULT NULL,
  `s4_pk_n` text DEFAULT NULL,
  `s4_pk_m` text DEFAULT NULL,
  `s4_pk_g` text DEFAULT NULL,
  `s4_pk_c` text DEFAULT NULL,
  `s5_pk_i` text DEFAULT NULL,
  `s5_pk_r` text DEFAULT NULL,
  `s5_pk_n` text DEFAULT NULL,
  `s5_pk_m` text DEFAULT NULL,
  `s5_pk_g` text DEFAULT NULL,
  `s5_pk_c` text DEFAULT NULL,
  `s6_pk_i` text DEFAULT NULL,
  `s6_pk_r` text DEFAULT NULL,
  `s6_pk_n` text DEFAULT NULL,
  `s6_pk_m` text DEFAULT NULL,
  `s6_pk_g` text DEFAULT NULL,
  `s6_pk_c` text DEFAULT NULL,
  `s1_pres_k1` text DEFAULT NULL,
  `s1_pres_k2` text DEFAULT NULL,
  `s1_pres_k3` text DEFAULT NULL,
  `s1_pres_e1` text DEFAULT NULL,
  `s1_pres_e2` text DEFAULT NULL,
  `s1_pres_e3` text DEFAULT NULL,
  `s1_pres_c1` text DEFAULT NULL,
  `s1_pres_c2` text DEFAULT NULL,
  `s1_pres_c3` text DEFAULT NULL,
  `s2_pres_k1` text DEFAULT NULL,
  `s2_pres_k2` text DEFAULT NULL,
  `s2_pres_k3` text DEFAULT NULL,
  `s2_pres_e1` text DEFAULT NULL,
  `s2_pres_e2` text DEFAULT NULL,
  `s2_pres_e3` text DEFAULT NULL,
  `s2_pres_c1` text DEFAULT NULL,
  `s2_pres_c2` text DEFAULT NULL,
  `s2_pres_c3` text DEFAULT NULL,
  `s3_pres_k1` text DEFAULT NULL,
  `s3_pres_k2` text DEFAULT NULL,
  `s3_pres_k3` text DEFAULT NULL,
  `s3_pres_e1` text DEFAULT NULL,
  `s3_pres_e2` text DEFAULT NULL,
  `s3_pres_e3` text DEFAULT NULL,
  `s3_pres_c1` text DEFAULT NULL,
  `s3_pres_c2` text DEFAULT NULL,
  `s3_pres_c3` text DEFAULT NULL,
  `s4_pres_k1` text DEFAULT NULL,
  `s4_pres_k2` text DEFAULT NULL,
  `s4_pres_k3` text DEFAULT NULL,
  `s4_pres_e1` text DEFAULT NULL,
  `s4_pres_e2` text DEFAULT NULL,
  `s4_pres_e3` text DEFAULT NULL,
  `s4_pres_c1` text DEFAULT NULL,
  `s4_pres_c2` text DEFAULT NULL,
  `s4_pres_c3` text DEFAULT NULL,
  `s5_pres_k1` text DEFAULT NULL,
  `s5_pres_k2` text DEFAULT NULL,
  `s5_pres_k3` text DEFAULT NULL,
  `s5_pres_e1` text DEFAULT NULL,
  `s5_pres_e2` text DEFAULT NULL,
  `s5_pres_e3` text DEFAULT NULL,
  `s5_pres_c1` text DEFAULT NULL,
  `s5_pres_c2` text DEFAULT NULL,
  `s5_pres_c3` text DEFAULT NULL,
  `s6_pres_k1` text DEFAULT NULL,
  `s6_pres_k2` text DEFAULT NULL,
  `s6_pres_k3` text DEFAULT NULL,
  `s6_pres_e1` text DEFAULT NULL,
  `s6_pres_e2` text DEFAULT NULL,
  `s6_pres_e3` text DEFAULT NULL,
  `s6_pres_c1` text DEFAULT NULL,
  `s6_pres_c2` text DEFAULT NULL,
  `s6_pres_c3` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pasc`
--

CREATE TABLE `pasc` (
  `id` int(11) NOT NULL,
  `semester` varchar(256) NOT NULL,
  `kepsek` varchar(256) NOT NULL,
  `nip` varchar(256) NOT NULL,
  `tanggal` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `pasc`
--

INSERT INTO `pasc` (`id`, `semester`, `kepsek`, `nip`, `tanggal`) VALUES
(1, '1', 'Rima Kemala, S.Sos.M.Pd', '', 'Bekasi, 2024'),
(2, '2', 'Rima Kemala, S.Sos.M.Pd', '', 'Bekasi, 2024'),
(3, '3', 'Rima Kemala, S.Sos.M.Pd', '', 'Bekasi, 2024'),
(4, '4', 'Rima Kemala, S.Sos.M.Pd', '', 'Bekasi, 2024'),
(5, '5', 'Rima Kemala, S.Sos.M.Pd', '', 'Bekasi, 2024'),
(6, '6', 'Rima Kemala, S.Sos.M.Pd', '', 'Bekasi, 2024');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelajaran`
--

CREATE TABLE `pelajaran` (
  `id` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `kkm` varchar(256) NOT NULL,
  `code` varchar(256) NOT NULL,
  `jurusan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `pelajaran`
--

INSERT INTO `pelajaran` (`id`, `nama`, `kkm`, `code`, `jurusan`) VALUES
(1, 'Pendidikan Agama dan Budi Pekerti', '70', 'a1', NULL),
(2, 'Pendidikan Pancasila dan Kewarganegaraan', '70', 'a2', NULL),
(3, 'Bahasa Indonesia', '70', 'a3', NULL),
(4, 'Matematika', '70', 'a4', NULL),
(5, 'Bahasa Inggris', '70', 'a5', NULL),
(6, 'Pendidikan Jasmani, Olahraga dan Kesehatan', '70', 'b1', NULL),
(8, 'Pemeliharaan Sasis dan Pemindah Tenaga Kendaraan Ringan', '70', 'c2', 'Teknik dan Bisnis Sepeda Motor'),
(9, 'Pemeliharaan Kelistrikan Sepeda Motor', '70', 'c3', 'Teknik dan Bisnis Sepeda Motor'),
(10, 'Pengelolaan Bengkel Sepeda Motor', '70', 'c4', 'Teknik dan Bisnis Sepeda Motor'),
(11, 'Produk Kreatif dan Kewirausahaan', '70', 'c5', 'Teknik dan Bisnis Sepeda Motor');

-- --------------------------------------------------------

--
-- Struktur dari tabel `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `gambar` varchar(256) NOT NULL,
  `judul` varchar(256) NOT NULL,
  `konten` text NOT NULL,
  `datetime` datetime NOT NULL,
  `status` enum('show','hide') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ppdb`
--

CREATE TABLE `ppdb` (
  `id` int(11) NOT NULL,
  `jenis` enum('Baru','Pindahan') NOT NULL,
  `jalur` enum('Umum','Prestasi') NOT NULL,
  `jurusan` varchar(256) NOT NULL,
  `nama` varchar(256) NOT NULL,
  `kelamin` varchar(256) NOT NULL,
  `tempat_lahir` varchar(256) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `agama` varchar(256) NOT NULL,
  `alamat` varchar(256) NOT NULL,
  `kabupaten` varchar(256) NOT NULL,
  `telepon` varchar(256) NOT NULL,
  `kewarganegaraan` enum('WNI','WNA') NOT NULL,
  `foto` varchar(256) NOT NULL,
  `bukti` varchar(256) NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `ppdb`
--

INSERT INTO `ppdb` (`id`, `jenis`, `jalur`, `jurusan`, `nama`, `kelamin`, `tempat_lahir`, `tanggal_lahir`, `agama`, `alamat`, `kabupaten`, `telepon`, `kewarganegaraan`, `foto`, `bukti`, `datetime`) VALUES
(1, 'Baru', 'Umum', 'Teknik dan Bisnis Sepeda Motor', 'DAVIN', 'Laki-laki', 'Boyolali', '2004-03-06', 'Kristen', 'Bekasi', 'Cikarang Utara', '081213539307', 'WNI', 'https://binatama.sch.id/assets/img/pendaftar/Sat-05-24-12-48-11-logo.png', 'https://binatama.sch.id/assets/img/bukti/Sat-05-24-12-48-11-MedicalSync.drawio.png', '2024-05-11 12:48:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pts`
--

CREATE TABLE `pts` (
  `id` int(11) NOT NULL,
  `nis` varchar(256) NOT NULL,
  `nama` varchar(256) NOT NULL,
  `s1_a1_p` text DEFAULT NULL,
  `s1_a1_k` text DEFAULT NULL,
  `s1_a1_s` text DEFAULT NULL,
  `s2_a1_p` text DEFAULT NULL,
  `s2_a1_k` text DEFAULT NULL,
  `s2_a1_s` text DEFAULT NULL,
  `s3_a1_p` text DEFAULT NULL,
  `s3_a1_k` text DEFAULT NULL,
  `s3_a1_s` text DEFAULT NULL,
  `s4_a1_p` text DEFAULT NULL,
  `s4_a1_k` text DEFAULT NULL,
  `s4_a1_s` text DEFAULT NULL,
  `s5_a1_p` text DEFAULT NULL,
  `s5_a1_k` text DEFAULT NULL,
  `s5_a1_s` text DEFAULT NULL,
  `s6_a1_p` text DEFAULT NULL,
  `s6_a1_k` text DEFAULT NULL,
  `s6_a1_s` text DEFAULT NULL,
  `s1_a2_p` text DEFAULT NULL,
  `s1_a2_k` text DEFAULT NULL,
  `s1_a2_s` text DEFAULT NULL,
  `s2_a2_p` text DEFAULT NULL,
  `s2_a2_k` text DEFAULT NULL,
  `s2_a2_s` text DEFAULT NULL,
  `s3_a2_p` text DEFAULT NULL,
  `s3_a2_k` text DEFAULT NULL,
  `s3_a2_s` text DEFAULT NULL,
  `s4_a2_p` text DEFAULT NULL,
  `s4_a2_k` text DEFAULT NULL,
  `s4_a2_s` text DEFAULT NULL,
  `s5_a2_p` text DEFAULT NULL,
  `s5_a2_k` text DEFAULT NULL,
  `s5_a2_s` text DEFAULT NULL,
  `s6_a2_p` text DEFAULT NULL,
  `s6_a2_k` text DEFAULT NULL,
  `s6_a2_s` text DEFAULT NULL,
  `s1_a3_p` text DEFAULT NULL,
  `s1_a3_k` text DEFAULT NULL,
  `s1_a3_s` text DEFAULT NULL,
  `s2_a3_p` text DEFAULT NULL,
  `s2_a3_k` text DEFAULT NULL,
  `s2_a3_s` text DEFAULT NULL,
  `s3_a3_p` text DEFAULT NULL,
  `s3_a3_k` text DEFAULT NULL,
  `s3_a3_s` text DEFAULT NULL,
  `s4_a3_p` text DEFAULT NULL,
  `s4_a3_k` text DEFAULT NULL,
  `s4_a3_s` text DEFAULT NULL,
  `s5_a3_p` text DEFAULT NULL,
  `s5_a3_k` text DEFAULT NULL,
  `s5_a3_s` text DEFAULT NULL,
  `s6_a3_p` text DEFAULT NULL,
  `s6_a3_k` text DEFAULT NULL,
  `s6_a3_s` text DEFAULT NULL,
  `s1_a4_p` text DEFAULT NULL,
  `s1_a4_k` text DEFAULT NULL,
  `s1_a4_s` text DEFAULT NULL,
  `s2_a4_p` text DEFAULT NULL,
  `s2_a4_k` text DEFAULT NULL,
  `s2_a4_s` text DEFAULT NULL,
  `s3_a4_p` text DEFAULT NULL,
  `s3_a4_k` text DEFAULT NULL,
  `s3_a4_s` text DEFAULT NULL,
  `s4_a4_p` text DEFAULT NULL,
  `s4_a4_k` text DEFAULT NULL,
  `s4_a4_s` text DEFAULT NULL,
  `s5_a4_p` text DEFAULT NULL,
  `s5_a4_k` text DEFAULT NULL,
  `s5_a4_s` text DEFAULT NULL,
  `s6_a4_p` text DEFAULT NULL,
  `s6_a4_k` text DEFAULT NULL,
  `s6_a4_s` text DEFAULT NULL,
  `s1_a5_p` text DEFAULT NULL,
  `s1_a5_k` text DEFAULT NULL,
  `s1_a5_s` text DEFAULT NULL,
  `s2_a5_p` text DEFAULT NULL,
  `s2_a5_k` text DEFAULT NULL,
  `s2_a5_s` text DEFAULT NULL,
  `s3_a5_p` text DEFAULT NULL,
  `s3_a5_k` text DEFAULT NULL,
  `s3_a5_s` text DEFAULT NULL,
  `s4_a5_p` text DEFAULT NULL,
  `s4_a5_k` text DEFAULT NULL,
  `s4_a5_s` text DEFAULT NULL,
  `s5_a5_p` text DEFAULT NULL,
  `s5_a5_k` text DEFAULT NULL,
  `s5_a5_s` text DEFAULT NULL,
  `s6_a5_p` text DEFAULT NULL,
  `s6_a5_k` text DEFAULT NULL,
  `s6_a5_s` text DEFAULT NULL,
  `s1_b1_p` text DEFAULT NULL,
  `s1_b1_k` text DEFAULT NULL,
  `s1_b1_s` text DEFAULT NULL,
  `s2_b1_p` text DEFAULT NULL,
  `s2_b1_k` text DEFAULT NULL,
  `s2_b1_s` text DEFAULT NULL,
  `s3_b1_p` text DEFAULT NULL,
  `s3_b1_k` text DEFAULT NULL,
  `s3_b1_s` text DEFAULT NULL,
  `s4_b1_p` text DEFAULT NULL,
  `s4_b1_k` text DEFAULT NULL,
  `s4_b1_s` text DEFAULT NULL,
  `s5_b1_p` text DEFAULT NULL,
  `s5_b1_k` text DEFAULT NULL,
  `s5_b1_s` text DEFAULT NULL,
  `s6_b1_p` text DEFAULT NULL,
  `s6_b1_k` text DEFAULT NULL,
  `s6_b1_s` text DEFAULT NULL,
  `s1_c1_p` text DEFAULT NULL,
  `s1_c1_k` text DEFAULT NULL,
  `s1_c1_s` text DEFAULT NULL,
  `s2_c1_p` text DEFAULT NULL,
  `s2_c1_k` text DEFAULT NULL,
  `s2_c1_s` text DEFAULT NULL,
  `s3_c1_p` text DEFAULT NULL,
  `s3_c1_k` text DEFAULT NULL,
  `s3_c1_s` text DEFAULT NULL,
  `s4_c1_p` text DEFAULT NULL,
  `s4_c1_k` text DEFAULT NULL,
  `s4_c1_s` text DEFAULT NULL,
  `s5_c1_p` text DEFAULT NULL,
  `s5_c1_k` text DEFAULT NULL,
  `s5_c1_s` text DEFAULT NULL,
  `s6_c1_p` text DEFAULT NULL,
  `s6_c1_k` text DEFAULT NULL,
  `s6_c1_s` text DEFAULT NULL,
  `s1_c2_p` text DEFAULT NULL,
  `s1_c2_k` text DEFAULT NULL,
  `s1_c2_s` text DEFAULT NULL,
  `s2_c2_p` text DEFAULT NULL,
  `s2_c2_k` text DEFAULT NULL,
  `s2_c2_s` text DEFAULT NULL,
  `s3_c2_p` text DEFAULT NULL,
  `s3_c2_k` text DEFAULT NULL,
  `s3_c2_s` text DEFAULT NULL,
  `s4_c2_p` text DEFAULT NULL,
  `s4_c2_k` text DEFAULT NULL,
  `s4_c2_s` text DEFAULT NULL,
  `s5_c2_p` text DEFAULT NULL,
  `s5_c2_k` text DEFAULT NULL,
  `s5_c2_s` text DEFAULT NULL,
  `s6_c2_p` text DEFAULT NULL,
  `s6_c2_k` text DEFAULT NULL,
  `s6_c2_s` text DEFAULT NULL,
  `s1_c3_p` text DEFAULT NULL,
  `s1_c3_k` text DEFAULT NULL,
  `s1_c3_s` text DEFAULT NULL,
  `s2_c3_p` text DEFAULT NULL,
  `s2_c3_k` text DEFAULT NULL,
  `s2_c3_s` text DEFAULT NULL,
  `s3_c3_p` text DEFAULT NULL,
  `s3_c3_k` text DEFAULT NULL,
  `s3_c3_s` text DEFAULT NULL,
  `s4_c3_p` text DEFAULT NULL,
  `s4_c3_k` text DEFAULT NULL,
  `s4_c3_s` text DEFAULT NULL,
  `s5_c3_p` text DEFAULT NULL,
  `s5_c3_k` text DEFAULT NULL,
  `s5_c3_s` text DEFAULT NULL,
  `s6_c3_p` text DEFAULT NULL,
  `s6_c3_k` text DEFAULT NULL,
  `s6_c3_s` text DEFAULT NULL,
  `s1_c4_p` text DEFAULT NULL,
  `s1_c4_k` text DEFAULT NULL,
  `s1_c4_s` text DEFAULT NULL,
  `s2_c4_p` text DEFAULT NULL,
  `s2_c4_k` text DEFAULT NULL,
  `s2_c4_s` text DEFAULT NULL,
  `s3_c4_p` text DEFAULT NULL,
  `s3_c4_k` text DEFAULT NULL,
  `s3_c4_s` text DEFAULT NULL,
  `s4_c4_p` text DEFAULT NULL,
  `s4_c4_k` text DEFAULT NULL,
  `s4_c4_s` text DEFAULT NULL,
  `s5_c4_p` text DEFAULT NULL,
  `s5_c4_k` text DEFAULT NULL,
  `s5_c4_s` text DEFAULT NULL,
  `s6_c4_p` text DEFAULT NULL,
  `s6_c4_k` text DEFAULT NULL,
  `s6_c4_s` text DEFAULT NULL,
  `s1_c5_p` text DEFAULT NULL,
  `s1_c5_k` text DEFAULT NULL,
  `s1_c5_s` text DEFAULT NULL,
  `s2_c5_p` text DEFAULT NULL,
  `s2_c5_k` text DEFAULT NULL,
  `s2_c5_s` text DEFAULT NULL,
  `s3_c5_p` text DEFAULT NULL,
  `s3_c5_k` text DEFAULT NULL,
  `s3_c5_s` text DEFAULT NULL,
  `s4_c5_p` text DEFAULT NULL,
  `s4_c5_k` text DEFAULT NULL,
  `s4_c5_s` text DEFAULT NULL,
  `s5_c5_p` text DEFAULT NULL,
  `s5_c5_k` text DEFAULT NULL,
  `s5_c5_s` text DEFAULT NULL,
  `s6_c5_p` text DEFAULT NULL,
  `s6_c5_k` text DEFAULT NULL,
  `s6_c5_s` text DEFAULT NULL,
  `s1_d1_p` text DEFAULT NULL,
  `s1_d1_k` text DEFAULT NULL,
  `s1_d1_s` text DEFAULT NULL,
  `s2_d1_p` text DEFAULT NULL,
  `s2_d1_k` text DEFAULT NULL,
  `s2_d1_s` text DEFAULT NULL,
  `s3_d1_p` text DEFAULT NULL,
  `s3_d1_k` text DEFAULT NULL,
  `s3_d1_s` text DEFAULT NULL,
  `s4_d1_p` text DEFAULT NULL,
  `s4_d1_k` text DEFAULT NULL,
  `s4_d1_s` text DEFAULT NULL,
  `s5_d1_p` text DEFAULT NULL,
  `s5_d1_k` text DEFAULT NULL,
  `s5_d1_s` text DEFAULT NULL,
  `s6_d1_p` text DEFAULT NULL,
  `s6_d1_k` text DEFAULT NULL,
  `s6_d1_s` text DEFAULT NULL,
  `s1_ca` text DEFAULT NULL,
  `s2_ca` text DEFAULT NULL,
  `s3_ca` text DEFAULT NULL,
  `s4_ca` text DEFAULT NULL,
  `s5_ca` text DEFAULT NULL,
  `s6_ca` text DEFAULT NULL,
  `s1_pkl1_dd` text DEFAULT NULL,
  `s1_pkl1_lks` text DEFAULT NULL,
  `s1_pkl1_bln` text DEFAULT NULL,
  `s1_pkl1_n` text DEFAULT NULL,
  `s1_pkl2_dd` text DEFAULT NULL,
  `s1_pkl2_lks` text DEFAULT NULL,
  `s1_pkl2_bln` text DEFAULT NULL,
  `s1_pkl2_n` text DEFAULT NULL,
  `s1_pkl3_dd` text DEFAULT NULL,
  `s1_pkl3_lks` text DEFAULT NULL,
  `s1_pkl3_bln` text DEFAULT NULL,
  `s1_pkl3_n` text DEFAULT NULL,
  `s2_pkl1_dd` text DEFAULT NULL,
  `s2_pkl1_lks` text DEFAULT NULL,
  `s2_pkl1_bln` text DEFAULT NULL,
  `s2_pkl1_n` text DEFAULT NULL,
  `s2_pkl2_dd` text DEFAULT NULL,
  `s2_pkl2_lks` text DEFAULT NULL,
  `s2_pkl2_bln` text DEFAULT NULL,
  `s2_pkl2_n` text DEFAULT NULL,
  `s2_pkl3_dd` text DEFAULT NULL,
  `s2_pkl3_lks` text DEFAULT NULL,
  `s2_pkl3_bln` text DEFAULT NULL,
  `s2_pkl3_n` text DEFAULT NULL,
  `s3_pkl1_dd` text DEFAULT NULL,
  `s3_pkl1_lks` text DEFAULT NULL,
  `s3_pkl1_bln` text DEFAULT NULL,
  `s3_pkl1_n` text DEFAULT NULL,
  `s3_pkl2_dd` text DEFAULT NULL,
  `s3_pkl2_lks` text DEFAULT NULL,
  `s3_pkl2_bln` text DEFAULT NULL,
  `s3_pkl2_n` text DEFAULT NULL,
  `s3_pkl3_dd` text DEFAULT NULL,
  `s3_pkl3_lks` text DEFAULT NULL,
  `s3_pkl3_bln` text DEFAULT NULL,
  `s3_pkl3_n` text DEFAULT NULL,
  `s4_pkl1_dd` text DEFAULT NULL,
  `s4_pkl1_lks` text DEFAULT NULL,
  `s4_pkl1_bln` text DEFAULT NULL,
  `s4_pkl1_n` text DEFAULT NULL,
  `s4_pkl2_dd` text DEFAULT NULL,
  `s4_pkl2_lks` text DEFAULT NULL,
  `s4_pkl2_bln` text DEFAULT NULL,
  `s4_pkl2_n` text DEFAULT NULL,
  `s4_pkl3_dd` text DEFAULT NULL,
  `s4_pkl3_lks` text DEFAULT NULL,
  `s4_pkl3_bln` text DEFAULT NULL,
  `s4_pkl3_n` text DEFAULT NULL,
  `s5_pkl1_dd` text DEFAULT NULL,
  `s5_pkl1_lks` text DEFAULT NULL,
  `s5_pkl1_bln` text DEFAULT NULL,
  `s5_pkl1_n` text DEFAULT NULL,
  `s5_pkl2_dd` text DEFAULT NULL,
  `s5_pkl2_lks` text DEFAULT NULL,
  `s5_pkl2_bln` text DEFAULT NULL,
  `s5_pkl2_n` text DEFAULT NULL,
  `s5_pkl3_dd` text DEFAULT NULL,
  `s5_pkl3_lks` text DEFAULT NULL,
  `s5_pkl3_bln` text DEFAULT NULL,
  `s5_pkl3_n` text DEFAULT NULL,
  `s6_pkl1_dd` text DEFAULT NULL,
  `s6_pkl1_lks` text DEFAULT NULL,
  `s6_pkl1_bln` text DEFAULT NULL,
  `s6_pkl1_n` text DEFAULT NULL,
  `s6_pkl2_dd` text DEFAULT NULL,
  `s6_pkl2_lks` text DEFAULT NULL,
  `s6_pkl2_bln` text DEFAULT NULL,
  `s6_pkl2_n` text DEFAULT NULL,
  `s6_pkl3_dd` text DEFAULT NULL,
  `s6_pkl3_lks` text DEFAULT NULL,
  `s6_pkl3_bln` text DEFAULT NULL,
  `s6_pkl3_n` text DEFAULT NULL,
  `s1_eks1_eks` text DEFAULT NULL,
  `s1_eks1_n` text DEFAULT NULL,
  `s1_eks2_eks` text DEFAULT NULL,
  `s1_eks2_n` text DEFAULT NULL,
  `s1_eks3_eks` text DEFAULT NULL,
  `s1_eks3_n` text DEFAULT NULL,
  `s2_eks1_eks` text DEFAULT NULL,
  `s2_eks1_n` text DEFAULT NULL,
  `s2_eks2_eks` text DEFAULT NULL,
  `s2_eks2_n` text DEFAULT NULL,
  `s2_eks3_eks` text DEFAULT NULL,
  `s2_eks3_n` text DEFAULT NULL,
  `s3_eks1_eks` text DEFAULT NULL,
  `s3_eks1_n` text DEFAULT NULL,
  `s3_eks2_eks` text DEFAULT NULL,
  `s3_eks2_n` text DEFAULT NULL,
  `s3_eks3_eks` text DEFAULT NULL,
  `s3_eks3_n` text DEFAULT NULL,
  `s4_eks1_eks` text DEFAULT NULL,
  `s4_eks1_n` text DEFAULT NULL,
  `s4_eks2_eks` text DEFAULT NULL,
  `s4_eks2_n` text DEFAULT NULL,
  `s4_eks3_eks` text DEFAULT NULL,
  `s4_eks3_n` text DEFAULT NULL,
  `s5_eks1_eks` text DEFAULT NULL,
  `s5_eks1_n` text DEFAULT NULL,
  `s5_eks2_eks` text DEFAULT NULL,
  `s5_eks2_n` text DEFAULT NULL,
  `s5_eks3_eks` text DEFAULT NULL,
  `s5_eks3_n` text DEFAULT NULL,
  `s6_eks1_eks` text DEFAULT NULL,
  `s6_eks1_n` text DEFAULT NULL,
  `s6_eks2_eks` text DEFAULT NULL,
  `s6_eks2_n` text DEFAULT NULL,
  `s6_eks3_eks` text DEFAULT NULL,
  `s6_eks3_n` text DEFAULT NULL,
  `s1_hdr_s` text DEFAULT NULL,
  `s1_hdr_i` text DEFAULT NULL,
  `s1_hdr_t` text DEFAULT NULL,
  `s2_hdr_s` text DEFAULT NULL,
  `s2_hdr_i` text DEFAULT NULL,
  `s2_hdr_t` text DEFAULT NULL,
  `s3_hdr_s` text DEFAULT NULL,
  `s3_hdr_i` text DEFAULT NULL,
  `s3_hdr_t` text DEFAULT NULL,
  `s4_hdr_s` text DEFAULT NULL,
  `s4_hdr_i` text DEFAULT NULL,
  `s4_hdr_t` text DEFAULT NULL,
  `s5_hdr_s` text DEFAULT NULL,
  `s5_hdr_i` text DEFAULT NULL,
  `s5_hdr_t` text DEFAULT NULL,
  `s6_hdr_s` text DEFAULT NULL,
  `s6_hdr_i` text DEFAULT NULL,
  `s6_hdr_t` text DEFAULT NULL,
  `s1_naik` text DEFAULT NULL,
  `s2_naik` text DEFAULT NULL,
  `s3_naik` text DEFAULT NULL,
  `s4_naik` text DEFAULT NULL,
  `s5_naik` text DEFAULT NULL,
  `s6_naik` text DEFAULT NULL,
  `s1_pk_i` text DEFAULT NULL,
  `s1_pk_r` text DEFAULT NULL,
  `s1_pk_n` text DEFAULT NULL,
  `s1_pk_m` text DEFAULT NULL,
  `s1_pk_g` text DEFAULT NULL,
  `s1_pk_c` text DEFAULT NULL,
  `s2_pk_i` text DEFAULT NULL,
  `s2_pk_r` text DEFAULT NULL,
  `s2_pk_n` text DEFAULT NULL,
  `s2_pk_m` text DEFAULT NULL,
  `s2_pk_g` text DEFAULT NULL,
  `s2_pk_c` text DEFAULT NULL,
  `s3_pk_i` text DEFAULT NULL,
  `s3_pk_r` text DEFAULT NULL,
  `s3_pk_n` text DEFAULT NULL,
  `s3_pk_m` text DEFAULT NULL,
  `s3_pk_g` text DEFAULT NULL,
  `s3_pk_c` text DEFAULT NULL,
  `s4_pk_i` text DEFAULT NULL,
  `s4_pk_r` text DEFAULT NULL,
  `s4_pk_n` text DEFAULT NULL,
  `s4_pk_m` text DEFAULT NULL,
  `s4_pk_g` text DEFAULT NULL,
  `s4_pk_c` text DEFAULT NULL,
  `s5_pk_i` text DEFAULT NULL,
  `s5_pk_r` text DEFAULT NULL,
  `s5_pk_n` text DEFAULT NULL,
  `s5_pk_m` text DEFAULT NULL,
  `s5_pk_g` text DEFAULT NULL,
  `s5_pk_c` text DEFAULT NULL,
  `s6_pk_i` text DEFAULT NULL,
  `s6_pk_r` text DEFAULT NULL,
  `s6_pk_n` text DEFAULT NULL,
  `s6_pk_m` text DEFAULT NULL,
  `s6_pk_g` text DEFAULT NULL,
  `s6_pk_c` text DEFAULT NULL,
  `s1_pres_k1` text DEFAULT NULL,
  `s1_pres_k2` text DEFAULT NULL,
  `s1_pres_k3` text DEFAULT NULL,
  `s1_pres_e1` text DEFAULT NULL,
  `s1_pres_e2` text DEFAULT NULL,
  `s1_pres_e3` text DEFAULT NULL,
  `s1_pres_c1` text DEFAULT NULL,
  `s1_pres_c2` text DEFAULT NULL,
  `s1_pres_c3` text DEFAULT NULL,
  `s2_pres_k1` text DEFAULT NULL,
  `s2_pres_k2` text DEFAULT NULL,
  `s2_pres_k3` text DEFAULT NULL,
  `s2_pres_e1` text DEFAULT NULL,
  `s2_pres_e2` text DEFAULT NULL,
  `s2_pres_e3` text DEFAULT NULL,
  `s2_pres_c1` text DEFAULT NULL,
  `s2_pres_c2` text DEFAULT NULL,
  `s2_pres_c3` text DEFAULT NULL,
  `s3_pres_k1` text DEFAULT NULL,
  `s3_pres_k2` text DEFAULT NULL,
  `s3_pres_k3` text DEFAULT NULL,
  `s3_pres_e1` text DEFAULT NULL,
  `s3_pres_e2` text DEFAULT NULL,
  `s3_pres_e3` text DEFAULT NULL,
  `s3_pres_c1` text DEFAULT NULL,
  `s3_pres_c2` text DEFAULT NULL,
  `s3_pres_c3` text DEFAULT NULL,
  `s4_pres_k1` text DEFAULT NULL,
  `s4_pres_k2` text DEFAULT NULL,
  `s4_pres_k3` text DEFAULT NULL,
  `s4_pres_e1` text DEFAULT NULL,
  `s4_pres_e2` text DEFAULT NULL,
  `s4_pres_e3` text DEFAULT NULL,
  `s4_pres_c1` text DEFAULT NULL,
  `s4_pres_c2` text DEFAULT NULL,
  `s4_pres_c3` text DEFAULT NULL,
  `s5_pres_k1` text DEFAULT NULL,
  `s5_pres_k2` text DEFAULT NULL,
  `s5_pres_k3` text DEFAULT NULL,
  `s5_pres_e1` text DEFAULT NULL,
  `s5_pres_e2` text DEFAULT NULL,
  `s5_pres_e3` text DEFAULT NULL,
  `s5_pres_c1` text DEFAULT NULL,
  `s5_pres_c2` text DEFAULT NULL,
  `s5_pres_c3` text DEFAULT NULL,
  `s6_pres_k1` text DEFAULT NULL,
  `s6_pres_k2` text DEFAULT NULL,
  `s6_pres_k3` text DEFAULT NULL,
  `s6_pres_e1` text DEFAULT NULL,
  `s6_pres_e2` text DEFAULT NULL,
  `s6_pres_e3` text DEFAULT NULL,
  `s6_pres_c1` text DEFAULT NULL,
  `s6_pres_c2` text DEFAULT NULL,
  `s6_pres_c3` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ptsc`
--

CREATE TABLE `ptsc` (
  `id` int(11) NOT NULL,
  `semester` varchar(256) NOT NULL,
  `kepsek` varchar(256) NOT NULL,
  `nip` varchar(256) NOT NULL,
  `tanggal` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `ptsc`
--

INSERT INTO `ptsc` (`id`, `semester`, `kepsek`, `nip`, `tanggal`) VALUES
(1, '1', 'Rima Kemala, S.Sos.M.Pd', '234423', 'Bekasi, 2024'),
(2, '2', 'Rima Kemala, S.Sos.M.Pd', '', 'Bekasi, 2024'),
(3, '3', 'Rima Kemala, S.Sos.M.Pd', '', 'Bekasi, 2024'),
(4, '4', 'Rima Kemala, S.Sos.M.Pd', '', 'Bekasi, 2024'),
(5, '5', 'Rima Kemala, S.Sos.M.Pd', '', 'Bekasi, 2024'),
(6, '6', 'Rima Kemala, S.Sos.M.Pd', '', 'Bekasi, 2024');

-- --------------------------------------------------------

--
-- Struktur dari tabel `slide`
--

CREATE TABLE `slide` (
  `id` int(11) NOT NULL,
  `kecil` varchar(256) NOT NULL,
  `besar` varchar(256) NOT NULL,
  `tombol` varchar(256) NOT NULL,
  `url` varchar(256) NOT NULL,
  `gambar` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `slide`
--

INSERT INTO `slide` (`id`, `kecil`, `besar`, `tombol`, `url`, `gambar`) VALUES
(1, 'SMK Binatama 1', 'SMK BINATAMA BISA', 'Daftar', 'ppdb', 'https://binatama.sch.id/assets/img/slide/slide1.jpeg'),
(2, 'SMK Binatama 2', 'SMK BINATAMA HEBAT', 'Daftar', 'ppdb', 'https://binatama.sch.id/assets/img/slide/slide2.jpeg'),
(3, 'SMK Binatama 3', 'SMK BINATAMA MAJU', 'Daftar', 'ppdb', 'https://binatama.sch.id/assets/img/slide/slide3.jpeg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `nomor` varchar(100) NOT NULL,
  `nisn` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` enum('Admin','Siswa','Guru','Suspended') NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kelas` varchar(100) NOT NULL,
  `pelajaran` varchar(100) NOT NULL,
  `jurusan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `nomor`, `nisn`, `password`, `status`, `nama`, `kelas`, `pelajaran`, `jurusan`) VALUES
(1, '2122104848', '2122104848', '0028291839', '74e549b2ddbfddffafeb65ae6665462e', 'Siswa', 'DAVIN WAHYU WARDANA', 'XI TKR', '', 'Multimedia'),
(2, '2122105042', '2122105042', '2122105042', '77ce57cc80c473fd5190063489d57429', 'Guru', 'GHINA SALSABILLA ZULIN', 'XI TKR', 'Teknik dan Bisnis Sepeda Motor', 'Multimedia'),
(3, 'admin', '8212005', '8212005', '21232f297a57a5a743894a0e4a801fc3', 'Admin', 'ADMIN PANEL', '', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `website`
--

CREATE TABLE `website` (
  `id` int(11) NOT NULL,
  `target` varchar(100) NOT NULL,
  `mt` varchar(100) NOT NULL,
  `webname` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `website`
--

INSERT INTO `website` (`id`, `target`, `mt`, `webname`) VALUES
(1, 'rapor', '0', 'E-Rapor'),
(2, 'admin', '0', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pas`
--
ALTER TABLE `pas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pasc`
--
ALTER TABLE `pasc`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pelajaran`
--
ALTER TABLE `pelajaran`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ppdb`
--
ALTER TABLE `ppdb`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pts`
--
ALTER TABLE `pts`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ptsc`
--
ALTER TABLE `ptsc`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `slide`
--
ALTER TABLE `slide`
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
-- AUTO_INCREMENT untuk tabel `config`
--
ALTER TABLE `config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `pas`
--
ALTER TABLE `pas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pasc`
--
ALTER TABLE `pasc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `pelajaran`
--
ALTER TABLE `pelajaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `ppdb`
--
ALTER TABLE `ppdb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `pts`
--
ALTER TABLE `pts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `ptsc`
--
ALTER TABLE `ptsc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `slide`
--
ALTER TABLE `slide`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `website`
--
ALTER TABLE `website`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
