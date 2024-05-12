<?php
include '../../libs/main/config.php';
$query_angsuran = mysqli_query($db, "SELECT * FROM angsuran WHERE notifikasi_status = 'Belum' AND notifikasi_tanggal = '".date("Y-m-d")."'");
while($angsuran = mysqli_fetch_assoc($query_angsuran)) {
    $data_user = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM users WHERE username = '".$angsuran['username']."'"));
    whatsapp($data_user['whatsapp'], "*Koperasi ".cfg(nama)."*

Tagihan anda sudah dekat, mari bayar angsuran pinjaman anda.

Nominal : Rp".$angsuran['nominal']."
Tenggat : ".$angsuran['tenggat']."

Terima kasih.");
    $update = mysqli_query($db, "UPDATE angsuran SET notifikasi_status = 'Sudah' WHERE id = '".$angsuran['id']."'");
    echo "Notifikasi angsuran berhasil dikirim ke ".$data_user['username']."<br><br>";
}
?>
