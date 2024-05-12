<?
include '../../libs/main/config.php';
$update = mysqli_query($db, "UPDATE simpanan SET tipe = '".$_GET['2']."', status = 'Dibayar', notifikasi_status = 'Sudah', dibayarkan = '".date("Y-m-d H:i:s")."' WHERE id = '".$_GET['1']."'");
$data_simpanan = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM simpanan WHERE id = '".$_GET['1']."'"));
$data_pengguna = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM users WHERE username = '".$data_simpanan['username']."'"));
if ($data_pengguna['pinjaman'] != 'Disetujui') {
    $update = mysqli_query($db, "UPDATE users SET pinjaman = 'Pengecekan' WHERE username = '".$data_simpanan['username']."'");
}
header("Location: ".cfg(url)."bendahara/simpanan/rincian?1=".$data_pengguna['username']);