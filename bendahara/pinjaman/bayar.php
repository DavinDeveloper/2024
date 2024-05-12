<?
include '../../libs/main/config.php';
if ($_GET['3'] == 'Yes') {
    $update = mysqli_query($db, "UPDATE angsuran SET tipe = '".$_GET['2']."', status = 'Dibayar', notifikasi_status = 'Sudah', dibayarkan = '".date("Y-m-d H:i:s")."' WHERE id_pinjaman = '".$_GET['1']."' AND status = 'Belum Dibayar'");
    $update = mysqli_query($db, "UPDATE pinjaman SET status = 'Lunas' WHERE id = '".$_GET['1']."'");
    $data_pinjaman = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM pinjaman WHERE id = '".$_GET['1']."'"));
    $data_pengguna = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM users WHERE username = '".$data_pinjaman['username']."'"));
    header("Location: ".cfg(url)."bendahara/pinjaman");
} else {
    $update = mysqli_query($db, "UPDATE angsuran SET tipe = '".$_GET['2']."', status = 'Dibayar', notifikasi_status = 'Sudah', dibayarkan = '".date("Y-m-d H:i:s")."' WHERE id = '".$_GET['1']."'");
    $data_angsuran = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM angsuran WHERE id = '".$_GET['1']."'"));
    $data_pengguna = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM users WHERE username = '".$data_angsuran['username']."'"));
    header("Location: ".cfg(url)."bendahara/pinjaman/rincian?1=".$data_angsuran['id_pinjaman']);
}