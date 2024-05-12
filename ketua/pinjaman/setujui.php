<?php
include '../../libs/main/config.php';
$update = mysqli_query($db, "UPDATE pinjaman SET pengajuan = 'Dikonfirmasi', status = 'Belum Lunas' WHERE id = '".$_GET['1']."'");
$data_pinjaman = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM pinjaman WHERE id = '".$_GET['1']."'"));
$data_pengguna = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM users WHERE username = '".$data_pinjaman['username']."'"));
$tanggal = date("Y-m-d");
$bulan = date("Y-m", strtotime($tanggal));
if (date("d", strtotime($tanggal)) < 20) {
    $bulan = date("Y-m", mktime(0, 0, 0, date("m", strtotime($bulan)) - 1, 1, date("Y", strtotime($bulan))));
}
$notifikasi = date("Y-m-d", strtotime($bulan."-20"));
$tenggat = date("Y-m-d", strtotime($bulan."-25"));
$bulanan = $data_pinjaman['nominal'] / $data_pinjaman['angsuran'];
$pembayaran_ke = 1;
while ($pembayaran_ke <= $data_pinjaman['angsuran']) {
    $bulan = date("Y-m", strtotime($bulan . "+1 month"));
    $notifikasi = date("Y-m-d", strtotime($notifikasi . "+1 month"));
    $tenggat = date("Y-m-d", strtotime($tenggat . "+1 month"));
    $insert_angsuran = mysqli_query($db, "INSERT INTO angsuran (id_pinjaman, username, bulan, nominal, total_pinjaman, pembayaran_ke, tenggat, notifikasi_tanggal, datetime) VALUES ('".$data_pinjaman['id']."', '".$data_pinjaman['username']."', '$bulan', '$bulanan', '".$data_pinjaman['nominal']."', '$pembayaran_ke', '$tenggat', '$notifikasi', '".date("Y-m-d H:i:s")."')");
    $pembayaran_ke++;
}
header("Location: ".cfg(url)."ketua/pinjaman");