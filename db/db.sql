-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 12 Bulan Mei 2024 pada 13.08
-- Versi server: 10.6.16-MariaDB-cll-lve
-- Versi PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u1574150_haji`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian`
--

CREATE TABLE `pembelian` (
  `id` int(11) NOT NULL,
  `id_produk` varchar(256) NOT NULL,
  `produk` varchar(256) NOT NULL,
  `username` varchar(256) NOT NULL,
  `harga` varchar(256) NOT NULL,
  `bukti` varchar(256) NOT NULL,
  `status` enum('Belum Dibayar','Sudah Dibayar','Pembayaran Dikonfirmasi','Pembayaran Ditolak','Dibatalkan') NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `pembelian`
--

INSERT INTO `pembelian` (`id`, `id_produk`, `produk`, `username`, `harga`, `bukti`, `status`, `datetime`) VALUES
(1, '1', 'Paket 1', 'davin', '27000000', '', 'Dibatalkan', '0000-00-00 00:00:00'),
(2, '1', 'Paket 1', 'wahyu', '27000000', 'https://tmssistem.my.id/other/haji/img/pembelian/belakang.jpg', 'Pembayaran Dikonfirmasi', '2024-04-30 15:32:17'),
(3, '1', 'Paket 1', 'wahyu', '27000000', '', 'Belum Dibayar', '2024-04-30 16:17:19'),
(4, '1', 'Paket 1', 'aji', '27000000', 'http://aisjannahfirdaus.my.id/img/pembelian/1200px-Schedule_or_Calendar_Flat_Icon.svg.png', 'Belum Dibayar', '2024-05-08 11:00:10'),
(5, '1', 'Paket 1', 'aji', '27000000', '', 'Belum Dibayar', '2024-05-08 11:01:55'),
(6, '1', 'Paket 1', 'aji', '27000000', '', 'Belum Dibayar', '2024-05-08 11:17:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `nama` text NOT NULL,
  `gambar` text NOT NULL,
  `harga` text NOT NULL,
  `rencana` text NOT NULL,
  `fasilitas` text NOT NULL,
  `persyaratan` text NOT NULL,
  `syarat` text NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id`, `nama`, `gambar`, `harga`, `rencana`, `fasilitas`, `persyaratan`, `syarat`, `datetime`) VALUES
(1, 'Paket 1', 'https://i.ibb.co/Kh1vjbY/Whats-App-Image-2024-04-27-at-11-14-24.jpg', '27000000', 'Hari Ke : 1, Rute / Lokasi : JAKARTA\r\n- Jamaah berkumpul di Hotel Anara Terminal 3 Bandara International Soekarno Hatta\r\n- Manasik Umrah dan Sosialisasi Umrah, Proses check in pesawat\r\n- Dengan mengucap Bismillah Tawakkaltu Alallahi, take off menuju Jeddah \r\n- Tiba di Jeddah Airport\r\n- Check in hotel\r\n \r\nHari Ke : 2, Rute / Lokasi : MADINAH\r\n- Shalat subuh di Masjid\r\nZiarah Raudah dan Pengenalan sekitar Masjid Nabawi (Maqam Baqi, Masjid Ghamamah, Masjid Ali dan Bani Tsaqifah).\r\n- Memperbanyak ibadah di Masjid\r\n- Istirahat dan jaga stamina.\r\n \r\nHari Ke : 3, Rute / Lokasi : MADINAH\r\n- Shalat Subuh di Masjid\r\n- Tausiyah yang di pimpin oleh Muthawif\r\n- Memperbanyak ibadah di Masjid\r\n- Istirahat dan jaga stamina.\r\n \r\nHari Ke : 4, Rute / Lokasi : MADINAH\r\n- Shalat subuh di Masjid\r\n- Ziarah kota Madinah ( Masjid Quba, Jabal Uhud, Masjid Qiblatain,Masjid Tujuh,kebun kurma ) * optional\r\n- Tausiyah yang di pimpin oleh Muthawif\r\n- Memperbanyak ibadah di Masjid\r\n- Istirahat dan jaga stamina.\r\n \r\nHari Ke : 5, Rute / Lokasi : MADINAH\r\n- Shalat Subuh di Masjid\r\n- Tausiyah yang di pimpin oleh Muthawif\r\n- Persiapan manasik yang di Pimpin Oleh Ustadz dan Muthowif\r\n- Istirahat dan jaga stamina.\r\n \r\nHari Ke : 6, Rute / Lokasi : MADINAH - MAKKAH\r\n- Sebelum sholat Dzuhur, koper sudah diletakkan di depan kamar masing-masing \r\n- Disunnahkan mandi ihram & menggunakan pakaian ihram di hotel untuk mengambil miqat atau niat ihram\r\n- Jama’ah menuju Bir ‘Ali dan langsung ke kota Mekkah dengan bus AC.\r\n- Tiba di Mekkah langsung check in hotel beristirahat sejenak.\r\n- Jama’ah melaksanakan Umrah ke – 1 (Thawaf, Sa’i, dan Tahallul) yang di bimbing oleh Ustadz dan Muthawif.\r\n- Selesai Umrah jama’ah kembali ke hotel untuk beristirahat.\r\n \r\nHari Ke : 7, Rute / Lokasi : MAKKAH\r\n- Shalat Subuh di Masjidil Haram\r\n- Tausiyah yang di pimpin oleh Muthawif\r\n- Memperbanyak ibadah di Masjidil Haram.\r\n- Istirahat dan jaga stamina.\r\n \r\nHari Ke : 8, Rute / Lokasi : MAKKAH\r\n- Shalat Subuh di Masjidil Haram\r\n- Setelah Sarapan Pagi , bersiap untuk melaksanakan Ziarah Makkah (Jabal Tsur, - Padang Arafah, Jabal Rahmah, Muzdhalifah, Mina, Jabal Nur dan Ji’rona) ( Jika diperbolehkan )\r\n- Jama’ah melaksanakan Umrah ke – 2 (Thawaf, Sa’i, dan Tahallul) yang di bimbing oleh Ustadz dan Muthawif.\r\n- Memperbanyak ibadah di Masjidil Haram.\r\n- Istirahat dan jaga stamina.\r\n \r\nHari Ke : 9, Rute / Lokasi : MAKKAH\r\n- Shalat Subuh di Masjidil Haram\r\n- Tausiyah yang di pimpin oleh Muthawif\r\n- Memperbanyak ibadah di Masjidil Haram.\r\n- Istirahat dan jaga stamina.\r\n \r\nHari Ke : 10, Rute / Lokasi : MAKKAH\r\n- Persiapan Perjalanan ke Thaif \r\n- Mengambil miqat untuk umrah yg ke 3 di Qornul Manaazil ( Optional bagi yang ingin melaksanakan umrah ke 3 )\r\n- Memperbanyak ibadah di masjid\r\n- Istirahat dan jaga stamina.\r\n \r\nHari Ke : 11, Rute / Lokasi : MAKKAH - JEDDAH\r\n- Shalat Subuh di Masjidil Haram\r\n- Koper di letakkan di depan kamar masing-masing, check out hotel\r\n- Tawaf wada’ di pimpin sama Ustadz dan Muthowif.\r\n- Perjalanan menuju airport Jeddah\r\n- Proses Check in dan Bagasi\r\n- Penerbangan menuju Jakarta\r\n \r\nHari Ke : 12, Rute / Lokasi : JAKARTA\r\nTiba di tanah air \r\n- Selesai perjalanan Umrah anda bersama Jannah Firdaus, terima kasih.\r\n- Semoga Umrah anda Maqbullah. Aamiin yaRabb.', 'HARGA TERMASUK\r\n- Ticket Pesawat Ekonomi (Jakarta - Saudi PP)\r\n- Visa Umrah\r\n- Hotel Makkah dan Madinah\r\n- Manasik\r\n- Tour Leader\r\n- Makan 3x Sehari\r\n- Ziarah Makkah dan Madinah\r\n- Muthawif Berbahasa Indonesia\r\n- Bus full AC 2022 - 2023\r\n- Handling Bandara & Hotel (INA & SAUDI)\r\n- Perlengkapan Umrah Exclusive\r\n- Sertifikat Umrah\r\n- Air Zam-Zam (Apabila diperbolehkan)\r\n\r\nHARGA TIDAK TERMASUK\r\n- Ticket Domestik\r\n- Kelebihan Bagasi\r\n- Biaya pembuatan / perpanjangan paspor\r\n- Pengeluaran yang bersifat pribadi', '1. Melunasi Biaya Perjalanan sesuai ketentuan yang berlaku.\r\n\r\n2. Foto copy KTP \r\n\r\n3. Pas Foto berwarna dengan latar belakang putih 4×6 sebanyak 6 lembar. Khusus wanita menggunakan jilbab.\r\n\r\n4. Foto copy Akta kelahiran bagi anak di bawah 12 tahun\r\n\r\n5. Foto copy Buku nikah dan kartu keluarga bagi suami istri.\r\n\r\n6. Paspor asli yang terdiri dari 3 suku kata yang masih berlaku minimal 8 bulan pada saat keberangkatan.', 'Pembayaran :\r\n\r\n- Pembayaran DP minimal Rp 5.000.000 perpax.\r\n- Pelunasan maximal H-30 Hari sebelum tanggal keberangkatan.\r\n- Pembayaran bisa dilakukan melalui Rekening PT.JANNAH FIRDAUS TOUR & TRAVEL\r\n- MANDIRI : 118.0011133351\r\n- BCA : 7015777761\r\n- BSI : 7098988232\r\n\r\nPembatalan :\r\n\r\n- 45-30 hari sebelum tanggal keberangkatan, dikenakan biaya pembatalan sebesar 75% dari harga paket.\r\n- 30-15 hari sebelum tanggal keberangkatan, dikenakan biaya pembatalan sebesar 100% dari harga paket.\r\n\r\nNilai Tukar Kurs :\r\n\r\n- Biaya dalam mata uang USD yang akan dikonversikan pada saat pembayaran / pada saat dana diterima di rekening kami dengan mengacu nilai tukar yang berlaku pada saat itu, yang ditentukan oleh pihak keuangan travel terlebih dahulu.\r\n- Biaya dalam mata uang Rupiah / IDR dengan mengacu kurs setinggi-tingginya USD 1 = Rp. 16.000. Biaya berubah sesuai kenaikan nilai kurs USD terhadap Rupiah.', '2024-04-28 00:30:18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `testimoni`
--

CREATE TABLE `testimoni` (
  `id` int(11) NOT NULL,
  `nama` text NOT NULL,
  `gambar` text NOT NULL,
  `konten` text NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `testimoni`
--

INSERT INTO `testimoni` (`id`, `nama`, `gambar`, `konten`, `datetime`) VALUES
(1, 'Davin', 'https://bb71d2eac085c69b0.s3-jak01.storageraya.com/1683114547-768713/17090087201293-gMBHVWXaDugPeyu6tXtPR3h2CcgTCwL4cEWHaOSU.jpg', 'Bagus banget hajinya', '2024-04-27 22:10:55'),
(2, 'Wahyu', 'https://bb71d2eac085c69b0.s3-jak01.storageraya.com/1683114547-768713/17090087805760-lkXel6SrTuiUSs9CAQDATuxuyiiDQdD946j3Kp5I.jpg', 'Gak nyesel haji disini', '2024-04-27 22:10:55'),
(3, 'Wardana', 'https://bb71d2eac085c69b0.s3-jak01.storageraya.com/1683114547-768713/17090087926242-MuUC9qwMdvkKJ3AawCbsGcbstz0IlgkzZDDs2Zn0.jpg', 'Baliknya langsung jadi tuhan', '2024-04-27 22:10:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `nama` varchar(256) NOT NULL,
  `whatsapp` varchar(256) NOT NULL,
  `status` enum('User','Admin','Suspended') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `nama`, `whatsapp`, `status`) VALUES
(1, 'davin', '202cb962ac59075b964b07152d234b70', 'Davin Wardana', '6281213539307', 'Admin'),
(2, 'wahyu', '202cb962ac59075b964b07152d234b70', 'Wahyu', '6281806993369', 'User'),
(3, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Admin', '6285156493669', 'Admin'),
(4, 'aji', '8d045450ae16dc81213a75b725ee2760', 'bang aji', '081214262156', 'User');

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
(1, 'nama', 'AIS Jannah Firdaus'),
(2, 'url', 'http://aisjannahfirdaus.my.id/'),
(3, 'logo', 'https://bb71d2eac085c69b0.s3-jak01.storageraya.com/1683114547-768713/16847371263968-rDLQeBFIbISNuriEn1TN6K2JxTgzd6RMAYR5YYQ0.png'),
(4, 'address', 'Jl bbb'),
(5, 'phone', '+6281213539307'),
(6, 'email', 'haji@gmail.com'),
(7, 'brosur1', 'https://bb71d2eac085c69b0.s3-jak01.storageraya.com/1683114547-768713/17090085881399-10KyYSKyJgnzcssH6Ctc4S6oFrhLJSwTU3Ys7lPs.jpg'),
(8, 'brosur2', 'https://bb71d2eac085c69b0.s3-jak01.storageraya.com/1683114547-768713/16868898527599-jus4DbNkrReiuUnvlb5ZlHIQRfHmqXzA0inr5Rqw.png'),
(9, 'banner', 'https://wowjohn.com/wp-content/uploads/2022/05/Free-Makkah-PNG-Image.png'),
(10, 'pembayaran', 'Silahkan bayar ke rekening berikut\r\n\r\nBCA : 723848234\r\na/n DAVIN WAHYU WARDANA');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `testimoni`
--
ALTER TABLE `testimoni`
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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_config` (`config`) USING HASH;

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `testimoni`
--
ALTER TABLE `testimoni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `website`
--
ALTER TABLE `website`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
